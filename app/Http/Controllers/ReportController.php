<?php

namespace App\Http\Controllers;

use App\model\RankingResult;
use App\Models\Setting\Institution;
use App\Models\Settings\College;
use App\Models\Settings\Department;
use App\Models\Settings\Program;
use App\Models\Settings\RankingCriteria;
use App\Models\Settings\RankingIndicator;
use App\Models\Settings\RankingSystem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * @var RankingSystem $rankingSystem
     */
    protected $rankingSystem;
    /**
     * @var RankingCriteria $rankingCriteria
     */
    private $rankingCriteria;
    /**
     * @var RankingIndicator $indicator
     */
    private $indicator;
    /**
     * @var RankingResult
     */
    private $rankingResult;
    /**
     * @var Program
     */
    private $program;

    /**
     * ReportController constructor.
     * @param RankingSystem $rankingSystem
     * @param RankingCriteria $rankingCriteria
     * @param RankingIndicator $indicator
     * @param RankingResult $rankingResult
     * @param Program $program
     */
    public function  __construct(RankingSystem $rankingSystem, RankingCriteria $rankingCriteria, RankingIndicator $indicator, RankingResult $rankingResult , Program $program)
    {
        $this->rankingSystem = $rankingSystem;
        $this->rankingCriteria = $rankingCriteria;
        $this->indicator = $indicator;
        $this->rankingResult = $rankingResult;
        $this->program = $program;
    }


    /**
     * @return Factory|View
     */
    public function index()
    {
        if (!Auth::user()->systemUser && Auth::user()->programs->isEmpty()){

            $rankingSystems = $this->rankingSystem->all();

            return view('reports.index')->with('rankingSystems', $rankingSystems);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);

    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function show(Request $request)
    {
        if (!Auth::user()->systemUser && Auth::user()->programs->isEmpty()) {

            $rankingSystems = $this->rankingSystem->all();
            $request->validate([
                'system' => 'required|numeric',
                'year' => 'required|numeric',

            ]);

            $year = $request->year;
            $month = $request->month;
            $system = $this->rankingSystem->find($request->system);

            if (!empty($system)) {
                $criterias = $this->rankingCriteria->where('system_id', $system->id)->with('indicator')->get();
                $indicatorsCount = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->count();

                if ($indicatorsCount > 0) {

                    $indicators = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->get();

                    if (empty($month)) {
                        $resultIndicators = $this->rankingResult->where('system_id', $system->id)
                            ->where('rankable_id', Auth::user()->institutionUser->institution_id)
                            ->whereNotNull('value')
                            ->where('rankable_type', Institution::class)
                            ->whereIn('indicator_id', $indicators->pluck('id'))
                            ->where('year', $year)
                            ->get();
                    } else {
                        $resultIndicators = $this->rankingResult->where('system_id', $system->id)
                            ->where('rankable_id', Auth::user()->institutionUser->institution_id)
                            ->whereNotNull('value')
                            ->where('rankable_type', Institution::class)
                            ->whereIn('indicator_id', $indicators->pluck('id'))
                            ->where('year', $year)
                            ->where('month', $request->month)
                            ->get();
                    }

                    $system['results'] = $resultIndicators;

                } else {
                    if (empty($month)) {
                        $resultsCriterias = $this->rankingResult->where('system_id', $system->id)
                            ->where('rankable_id', Auth::user()->institutionUser->institution_id)
                            ->whereNotNull('value')
                            ->where('rankable_type', Institution::class)
                            ->whereIn('criteria_id', $criterias->pluck('id'))
                            ->where('year', $year)
                            ->get();
                    } else {
                        $resultsCriterias = $this->rankingResult->where('system_id', $system->id)
                            ->where('rankable_id', Auth::user()->institutionUser->institution_id)
                            ->whereNotNull('value')
                            ->where('rankable_type', Institution::class)
                            ->whereIn('criteria_id', $criterias->pluck('id'))
                            ->where('year', $year)
                            ->where('month', $request->month)
                            ->get();
                    }

                    $system['results'] = $resultsCriterias;
                }

                $system['indicatorsCount'] = $indicatorsCount;

                return view('reports.index')->with('rankingSystems', $rankingSystems)->with('system', $system)->with('year', $year)->with('criterias', $criterias)->with('month', $month);

            } else {
                return redirect()->route('report.index')->with('message', ['type' => 'error', 'text' => 'common.theRankingSystemIsIncorrect']);

            }
        }else {
            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
        }
    }

    /**
     * @param Request $request
     * @param College $college
     * @param Department $department
     * @return $this
     */
    public function programShow(Request $request, College $college, Department $department)
    {

        if (Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $colleges = $college->where('institution_id', Auth::user()->institutionUser->institution_id)->get();
            $departments = $department->whereIn('college_id', $colleges->pluck('id'))->get();
            $programs = $this->program->whereIn('department_id', $departments->pluck('id'))->with('categories')
                ->whereHas('categories')->get();

        } elseif (Auth::user()->institutionUser && Auth::user()->programs->isNotEmpty()) {
            $programs = $this->program->where('responsible_id', Auth::id())->with('categories')
                ->whereHas('categories')->get();
        } else {
            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);

        }

        $rankingSystems = $this->rankingSystem->all();

        if ($request->has('program') && $request->has('year') && $request->has('system')) {

            $request->validate([
                'program' => 'required|numeric',
                'system' => 'required|numeric',
                'year' => 'required|numeric',

            ]);

            $year = $request->year;
            $month = $request->month;
            $programCurrent = $this->program->find($request->program);

            if (!empty($programCurrent)) {

                if (in_array($programCurrent->id, $programs->pluck('id')->toArray())) {

                    $system = $this->rankingSystem->find($request->system);

                    if (!empty($system)) {

                        $criterias = $this->rankingCriteria->where('system_id', $system->id)->with('indicator')->get();

                        $indicators = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->count();

                        if ($indicators > 0) {
                            $indicatorsObj = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->get();

                            if (empty($month)) {
                                $resultIndicators = $this->rankingResult->where('system_id', $system->id)
                                    ->where('rankable_id', $programCurrent->id)
                                    ->whereNotNull('value')
                                    ->where('rankable_type', Program::class)
                                    ->whereIn('indicator_id', $indicatorsObj->pluck('id'))
                                    ->where('year', $year)
                                    ->get();
                            } else {
                                $resultIndicators = $this->rankingResult->where('system_id', $system->id)
                                    ->where('rankable_id', $programCurrent->id)
                                    ->whereNotNull('value')
                                    ->where('rankable_type', Program::class)
                                    ->whereIn('indicator_id', $indicatorsObj->pluck('id'))
                                    ->where('year', $year)
                                    ->where('month', $month)
                                    ->get();
                            }

                            $system['results'] = $resultIndicators;

                        } else {
                            if (empty($month)) {
                                $resultsCriterias = $this->rankingResult->where('system_id', $system->id)
                                    ->where('rankable_id', $programCurrent->id)
                                    ->whereNotNull('value')
                                    ->where('rankable_type', Program::class)
                                    ->whereIn('criteria_id', $criterias->pluck('id'))
                                    ->where('year', $year)
                                    ->get();
                            } else {
                                $resultsCriterias = $this->rankingResult->where('system_id', $system->id)
                                    ->where('rankable_id', $programCurrent->id)
                                    ->whereNotNull('value')
                                    ->where('rankable_type', Program::class)
                                    ->whereIn('criteria_id', $criterias->pluck('id'))
                                    ->where('year', $year)
                                    ->where('month', $month)
                                    ->get();
                            }

                            $system['results'] = $resultsCriterias;
                        }

                        $system['indicatorsCount'] = $indicators;

                        return view('reports.program')->with('rankingSystems', $rankingSystems)->with('system', $system)->with('programs', $programs)->with('year', $year)->with('month', $month)->with('criterias', $criterias)->with('programCurrent', $programCurrent);
                    } else {
                        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.rankingSystemDoesNotExist']);

                    }

                } else {
                    return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.programDoesNotExist']);

                }

            } else {
                return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.programDoesNotExist']);

            }
        }
        return view('reports.program')->with('rankingSystems', $rankingSystems)->with('programs', $programs);

    }


}
