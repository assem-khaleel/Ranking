<?php

namespace App\Http\Controllers\Settings;

use App\Models\Settings\RankingCriteria;
use App\Models\Settings\RankingIndicator;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class RankingIndicatorController extends Controller
{

  /**
  * @var RankingIndicator $rankingIndicators
  */
    protected  $rankingIndicators;

    /**
     * @var RankingCriteria $rankingCriteria
     */
    protected $rankingCriteria;

    /**
     * IndicatorsController constructor.
     * @param RankingIndicator $rankingIndicators
     * @param RankingCriteria $rankingCriteria
     */
    public function __construct(RankingIndicator $rankingIndicators, RankingCriteria $rankingCriteria)
    {
        $this->rankingIndicators = $rankingIndicators;
        $this->rankingCriteria = $rankingCriteria;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
         if(Auth::user()->systemUser) {
             $rankingIndicators = $this->rankingIndicators->with('criteria')->whereHas('criteria')->paginate();

             return view('settings.indicators.index')->with('rankingIndicators', $rankingIndicators);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         if(Auth::user()->systemUser) {
             $rankingCriterias = $this->rankingCriteria->all();

             return view('settings.indicators.forms.create')->with('rankingCriterias', $rankingCriterias);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
         if(Auth::user()->systemUser) {
             $request->validate([
                 'name_en' => 'required|string|max:255',
                 'name_ar' => 'required|string|max:255',
                 'criterion_id' => 'required|numeric',
                 'description_en' => 'required|string|max:255',
                 'description_ar' => 'required|string|max:255',
             ]);

             $this->rankingIndicators->create($request->all());

             return redirect()->route('ranking-indicator.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsg']);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
         if(Auth::user()->systemUser) {
             $rankingIndicator = $this->rankingIndicators->with('criteria')->whereHas('criteria')->find($id);

             if (!empty($rankingIndicator)) {
                 return view('settings.indicators.show')->with('rankingIndicator', $rankingIndicator);
             }

             return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'indicators.indicatorDoesNotExist']);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
         if(Auth::user()->systemUser) {
             $rankingCriterias = $this->rankingCriteria->all();
             $rankingIndicator = $this->rankingIndicators->with('criteria')->whereHas('criteria')->find($id);

             if (!empty($rankingIndicator)) {
                 return view('settings.indicators.forms.edit')->with('rankingIndicator', $rankingIndicator)->with('rankingCriterias', $rankingCriterias);

             }

             return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'indicators.indicatorDoesNotExist']);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
         if(Auth::user()->systemUser) {
             $indicator = $this->rankingIndicators->find($id);

             $request->validate([
                 'name_en' => 'required|string|max:255',
                 'name_ar' => 'required|string|max:255',
                 'criterion_id' => 'required|numeric',
                 'description_en' => 'required|string|max:255',
                 'description_ar' => 'required|string|max:255',
             ]);

             $indicator->update($request->all());

             return redirect()->route('ranking-indicator.index')->with('message', ['type' => 'success', 'text' => 'common.updateSuccessfully']);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     * @throws Exception
     */
    public function destroy($id)
    {
         if(Auth::user()->systemUser) {
             $indicator = $this->rankingIndicators->find($id);
             if ($indicator) {

                 $indicator->delete();

                 return redirect()->route('ranking-indicator.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsgRemove']);
             }

             return redirect()->route('ranking-indicator.index')->with('message', ['type' => 'error', 'text' => 'indicators.indicatorDoesNotExist']);
         }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);
    }
}
