<?php

namespace App\Http\Controllers\Settings;

use App\model\File;
use App\Models\Settings\RankingSystem;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Settings\RankingSystem as Ranking;
use Illuminate\Support\Facades\Redirect;
use Storage;
use Illuminate\Support\Facades\Auth;

class RankingSystemController extends Controller
{
    /**
     *
     * @var Ranking $rankingSystem
     *
     */
    protected $rankingSystem;
    /**
     * @var File $file
     */
    protected $file;

    /**
     * RankingSystemController constructor.
     * @param Ranking $ranking
     * @param File $file
     */
    public function __construct(Ranking $ranking, File $file)
    {
        $this->rankingSystem = $ranking;
        $this->file = $file;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user()->systemUser) {
            return view('settings.Ranking.index', [
                'ranking' => $this->rankingSystem->paginate()
            ]);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Auth::user()->systemUser) {
            return view('settings.Ranking.create');
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if (Auth::user()->systemUser) {

            $attributes['owner_id'] = auth()->id();
            $ranking = Ranking::create($attributes + $this->validateRanking($request));

            if ($request->file('logo')) {

                $attributes['local_path'] = 'ranking/logos';
                $attributes['file'] = $request->file('logo');
                $attributes['description'] = RankingSystem::$LOGO;
                $attributes['fileable_id'] = $ranking->id;
                $attributes['fileable_type'] = RankingSystem::class;

                $this->file->createFile($attributes);

            }

            return Redirect::route('ranking-system.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsg']);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        if (Auth::user()->systemUser) {
            $ranking = Ranking::with('criteria')->find($id);

            if (!empty($ranking)) {
                return view('settings.Ranking.show')->with('ranking', $ranking);
            }

            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'COMMON.rankingSystemDoesNotExist']);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        if (Auth::user()->systemUser) {
            $ranking = Ranking::findOrFail($id);
            return view('settings.Ranking.edit')->with('ranking', $ranking);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Ranking $ranking
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, Ranking $ranking, $id)
    {
        if (Auth::user()->systemUser) {
            $ranking = $ranking::findOrFail($id);
            $ranking->update($this->validateRanking($request, $id));

            if ($request->file('logo')) {
                if (empty($ranking->logo)) {
                    $attributes['local_path'] = 'ranking/logos';
                    $attributes['file'] = $request->file('logo');
                    $attributes['description'] = RankingSystem::$LOGO;
                    $attributes['fileable_id'] = $ranking->id;
                    $attributes['fileable_type'] = RankingSystem::class;

                    $this->file->createFile($attributes);
                } else {

                    $attributes['local_path'] = 'ranking/logos';
                    $attributes['file'] = $request->file('logo');
                    $attributes['description'] = RankingSystem::$LOGO;
                    $attributes['fileable_id'] = $ranking->id;
                    $attributes['fileable_type'] = RankingSystem::class;
                    $attributes['old_file'] = $ranking->logo->path;

                    $ranking->logo->updateFile($attributes);
                }
            }
            return Redirect::route('ranking-system.index')->with('message', ['type' => 'success', 'text' => 'common.updateSuccessfully']);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ranking $ranking
     * @param  int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Ranking $ranking, $id)
    {
        if (Auth::user()->systemUser) {
            $ranking = $ranking->findOrFail($id);

            if ($ranking) {

                if (!empty($ranking->logo->path)) {
                    Storage::disk('public')->delete($ranking->logo->path);
                    $ranking->logo->delete();
                }
                $ranking->delete();
            }

            return Redirect::route('ranking-system.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsgRemove']);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function validateRanking(Request $request, $id = 0)
    {
        return $request->validate([
            'name_en' => ['required', 'unique:ranking_systems,name_en,' . $id],
            'name_ar' => ['required', 'max:2000', 'unique:ranking_systems,name_ar,' . $id],
            'url' => ['required', 'unique:ranking_systems,url,' . $id],
            'abbreviation' => ['required'],
            'description_en' => ['required'],
            'description_ar' => ['required'],
            'image' => ['mimes:jpeg,jpg,bmp,png|max:10000']

        ]);
    }
}
