<?php

namespace App\Http\Controllers\Settings;

use App\Models\Settings\Program;
use App\Models\Settings\RankingSystem;
use App\Models\Settings\SystemCategory;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;


class SystemCategoriesController extends Controller
{

    /**
     *
     * @var SystemCategory $systemCategory
     *
     */
    protected $systemCategory;

    protected $programs;

    protected $rankingSystem;

    /**
     * RankingSystemController constructor.
     * @param SystemCategory $systemCategory
     * @param Program $programs
     * @param RankingSystem $ranking
     */
    public function __construct(SystemCategory $systemCategory, Program $programs, RankingSystem $ranking)
    {
        $this->systemCategory = $systemCategory;
        $this->programs = $programs;
        $this->rankingSystem = $ranking;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user()->systemUser) {
            $category = $this->systemCategory->paginate();

            return view('settings.categories.index')->with('categories', $category);
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

            $ranking = $this->rankingSystem->all();

            return view('settings.categories.create')->with('data', $ranking);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->systemUser) {
            $request->validate([
                'system_id' => 'required|numeric',
                'name_en' => 'required',
                'name_ar' => 'required',
            ]);

            $this->systemCategory->create($request->all());

            return Redirect()->route('category.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsg']);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        if (Auth::user()->systemUser) {
            $systemCategories = SystemCategory::find($id);

            if ($systemCategories) {
                $ranking = $this->rankingSystem->all();

                return view('settings.categories.edit')->with('data', $ranking)->with('systemCategory', $systemCategories);
            }

            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.subjectDoesNotExist']);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->systemUser) {
            $category = $this->systemCategory->find($id);

            $request->validate([
                'system_id' => 'required|numeric',
                'name_en' => 'required',
                'name_ar' => 'required',
            ]);

            if ($category) {
                $category->update($request->all());

                return Redirect()->route('category.index')->with('message', ['type' => 'success', 'text' => 'common.updateSuccessfully']);
            }

            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.subjectDoesNotExist']);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function destroy($id)
    {
        if (Auth::user()->systemUser) {
            $category = $this->systemCategory->find($id);

            if ($category) {
                $category->delete($category->all());

                return Redirect()->route('category.index')->with('message', ['type' => 'error', 'text' => 'common.sucessMsgRemove']);
            }

            return Redirect()->route('category.index')->with('message', ['type' => 'error', 'text' => 'common.errorMsgRemove']);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);

    }

}
