<?php

namespace App\Http\Controllers\Settings;

use App\Models\Settings\RankingSystem;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\RankingCriteria as Criteria;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class RankingCriteriaController extends Controller
{
    /**
     * @var Criteria $criteriaSystem
     */
    protected $criteriaSystem;
    /**
     * @var RankingSystem $rankingSystem
     */
    private $rankingSystem;

    public function __construct(Criteria $Criteria, RankingSystem $rankingSystem)
    {
        $this->criteriaSystem = $Criteria;
        $this->rankingSystem = $rankingSystem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user()->systemUser) {
            $criteria = $this->criteriaSystem->paginate();
            return view('settings.criteria.index')->with('criteria', $criteria);
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
            $systems = $this->rankingSystem->all();
            return view('settings.criteria.create')->with('systems', $systems);
        }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
         if(Auth::user()->systemUser) {
             $attributes['owner_id'] = auth()->id();
             Criteria::create($attributes + $this->validateCriteria($request));
             return Redirect::route('ranking-criteria.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsg']);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
         if(Auth::user()->systemUser) {
             $criteria = Criteria::findOrFail($id);
             return view('settings.criteria.show')->with('criteria', $criteria);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
         if(Auth::user()->systemUser) {
             $criteria = Criteria::findOrFail($id);
             $systems = $this->rankingSystem->all();

             return view('settings.criteria.edit')->with('criteria', $criteria)->with('systems', $systems);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Criteria $criteria
     * @param  int $id
     * @return RedirectResponse
     */
    public function update(Request $request, Criteria $criteria, $id)
    {
         if(Auth::user()->systemUser) {
             $criteria = $criteria::findOrFail($id);
             $criteria->update($this->validateCriteria($request, $id));

             $criteria->update($request->toArray(['system_id', 'name_en', 'name_ar', 'percentage', 'description_ar', 'description_en']));

             return Redirect::route('ranking-criteria.index')->with('message', ['type' => 'success', 'text' => 'common.updateSuccessfully']);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param Criteria $criteria
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id, Criteria $criteria)
    {
         if(Auth::user()->systemUser) {
             $criteria->findOrFail($id)->delete();
             return Redirect::route('ranking-criteria.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsgRemove']);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }


    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function validateCriteria(Request $request, $id = 0)
    {

        return $request->validate([
            'system_id' => ['required'],
            'name_en' => ['required', 'unique:ranking_criteria,name_en,' . $id],
            'name_ar' => ['required', 'unique:ranking_criteria,name_ar,' . $id],
            'percentage' => ['required', 'numeric'],
            'description_ar' => ['required'],
            'description_en' => ['required'],
        ]);
    }
}
