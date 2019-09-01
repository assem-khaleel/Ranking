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
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Validator;

class RankingResultController extends Controller
{


    /**
     * @var rankingResult $rankingResult
     */
    protected $rankingResult;
    /**
     * @var RankingSystem
     */
    private $rankingSystem;
    /**
     * @var RankingIndicator
     */
    private $rankingIndicator;
    /**
     * @var RankingCriteria
     */
    private $rankingCriteria;
    /**
     * @var Program
     */
    private $program;
    /**
     * @var Department
     */
    private $department;
    /**
     * @var College
     */
    private $college;

    /**
     * InstitutionRankingResultController constructor.
     * @param rankingResult $rankingResult
     * @param RankingIndicator $rankingIndicator
     * @param RankingSystem $rankingSystem
     * @param RankingCriteria $rankingCriteria
     * @param Program $program
     * @param Department $department
     * @param College $college
     */
    public function __construct(RankingResult $rankingResult, RankingIndicator $rankingIndicator, RankingSystem $rankingSystem, RankingCriteria $rankingCriteria, Program $program, Department $department, College $college)
    {
        $this->rankingResult = $rankingResult;
        $this->rankingSystem = $rankingSystem;
        $this->rankingIndicator = $rankingIndicator;
        $this->rankingCriteria = $rankingCriteria;
        $this->program = $program;
        $this->department = $department;
        $this->college = $college;
    }


    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('results.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'value.*' => 'nullable|numeric',
        ]);

        $year = $request->year;

        if ($year == 0 || $year < 2000 || $year > date('Y')) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theYearIsIncorrect']);
        }

        $month = $request->month;

        if ($month == 0 || $month > 12) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theMonthIsIncorrect']);
        }

        $rankingSystemId = $request->rankingSystemId;

        if (empty($this->rankingSystem->find($rankingSystemId))) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theRankingSystemIsIncorrect']);
        }

        $criteria = $request->criteria;

        if (empty($this->rankingCriteria->find($criteria))) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theCriteriaIsIncorrect']);
        }

        $checkbox = $request->checkbox;

        foreach ($request->value as $key => $value_result) {

            $indicator = $request->indicator[$key];
            $value = $value_result;
            if (Auth::user()->programs->isEmpty()) {

                Validator::make($request->all(), [
                    'checkbox' => 'required|numeric',
                ])->validate();

                if ($checkbox == RankingResult::$institution) {
                    $attributes['rankable_id'] = Auth::user()->institutionUser->institution_id;
                    $attributes['rankable_type'] = Institution::class;

                } elseif ($checkbox == RankingResult::$program) {
                    Validator::make($request->all(), [
                        'program' => 'required|numeric',
                    ])->validate();

                    $attributes['rankable_id'] = $request->program;
                    $attributes['rankable_type'] = Program::class;

                } else {
                    return redirect()->route('result.index');
                }
            } else {
                Validator::make($request->all(), [
                    'program' => 'required|numeric',
                ])->validate();
                $attributes['rankable_id'] = $request->program;
                $attributes['rankable_type'] = Program::class;
            }
            $attributes['system_id'] = $rankingSystemId;
            $attributes['criteria_id'] = $criteria;
            $attributes['month'] = $month;
            $attributes['year'] = $year;

            if (!empty($indicator)) {
                $attributes['indicator_id'] = $indicator;
            }

            $item = $this->rankingResult->where('system_id', $rankingSystemId)->where('criteria_id', $criteria)->where('month', $month)->where('year', $year)->firstOrNew($attributes);
            $item->value = $value;
            $item->save();
        }
        return redirect()->route('result.criteria', 'year=' . $year . '&month=' . $month . '&system=' . $rankingSystemId)->with('message', ['type' => 'success', 'text' => 'common.sucessMsg']);

    }

    public function year(Request $request)
    {
        $year = $request->year;
        if ($year == 0 || $year < 2000 || $year > date('Y')) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theYearIsIncorrect']);
        }

        return view('results.index')->with('year', $year);

    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function rankingSystem(Request $request)
    {
        $year = $request->year;
        if ($year == 0 || $year < 2000 || $year > date('Y')) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theYearIsIncorrect']);
        }

        $month = $request->month;

        if ($month == 0 || $month > 12) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theMonthIsIncorrect']);
        }

        $rankingSystems = $this->rankingSystem->all();

        return view('results.index')->with('rankingSystems', $rankingSystems)->with('year', $year)->with('month', $month);

    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function criteria(Request $request)
    {
        $year = $request->year;
        if ($year == 0 || $year < 2000 || $year > date('Y')) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theYearIsIncorrect']);
        }

        $month = $request->month;

        if ($month == 0 || $month > 12) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theMonthIsIncorrect']);
        }

        $rankingSystems = $this->rankingSystem->all();
        $rankingSystemId = $request->system;
        $rankingCriterias = $this->rankingCriteria->where('system_id', $rankingSystemId)->with('system')->get();

        if ($rankingCriterias->isEmpty()) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theRankingSystemIsIncorrect']);
        }

        return view('results.index')->with('rankingCriterias', $rankingCriterias)->with('year', $year)->with('month', $month)->with('rankingSystems', $rankingSystems)->with('rankingSystemId', $rankingSystemId);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function indicator(Request $request)
    {
        $year = $request->year;

        if ($year == 0 || $year < 2000 || $year > date('Y')) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theYearIsIncorrect']);
        }

        $month = $request->month;

        if ($month == 0 || $month > 12) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theMonthIsIncorrect']);
        }

        $rankingSystemId = $request->rankingSystem;
        $criteria_id = $request->criteria;
        $rankingSystems = $this->rankingSystem->all();
        $rankingCriterias = $this->rankingCriteria->where('system_id', $rankingSystemId)->with('system')->get();

        if ($rankingCriterias->isEmpty()) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theRankingSystemIsIncorrect']);
        }

        if (empty($this->rankingCriteria->find($criteria_id))) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theCriteriaIsIncorrect']);
        }

        $rankingIndicators = $this->rankingIndicator->where('criterion_id', $criteria_id)->with('criteria')->get();

        $colleges = $this->college->where('institution_id', Auth::user()->institutionUser->institution_id)->get();

        $departments = $this->department->whereIn('college_id', $colleges->pluck('id')->toArray())->get();

        if (Auth::user()->programs->isEmpty()) {
            $programs = $this->program->whereHas('categories', function ($query) use ($rankingSystemId) {
                $query->where('system_id', $rankingSystemId);
            })->whereIn('department_id', $departments->pluck('id')->toArray())->get();
        } else {
            $programs = Auth::user()->programs()->whereHas('categories', function ($query) use ($rankingSystemId) {
                $query->where('system_id', $rankingSystemId);
            })->get();
        }

        if ($rankingIndicators->isNotEmpty()) {
            return view('results.index')->with('year', $year)->with('month', $month)->with('rankingSystemId', $rankingSystemId)->with('criteria_id', $criteria_id)->with('rankingIndicators', $rankingIndicators)->with('rankingSystems', $rankingSystems)->with('rankingCriterias', $rankingCriterias)->with('programs', $programs);

        } else {
            $opens = true;
            $criteria = $this->rankingCriteria->find($criteria_id);

            return view('results.index')->with('year', $year)->with('month', $month)->with('rankingSystemId', $rankingSystemId)->with('criteria_id', $criteria_id)->with('rankingSystems', $rankingSystems)->with('rankingCriterias', $rankingCriterias)->with('opens', $opens)->with('criteria', $criteria)->with('programs', $programs);
        }

    }

    /**
     * @param $rankingSystem
     * @param $criteria
     * @param $programId
     * @param $year
     * @param $month
     * @return RedirectResponse
     */
    public function valueProgram($rankingSystem, $criteria, $programId, $year, $month)
    {

        if ($year == 0 || $year < 2000 || $year > date('Y')) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theYearIsIncorrect']);
        }

        if ($month == 0 || $month > 12) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theMonthIsIncorrect']);
        }

        $rankingSystemId = $rankingSystem;
        $criteria_id = $criteria;
        $rankingSystems = $this->rankingSystem->all();
        $rankingCriterias = $this->rankingCriteria->where('system_id', $rankingSystemId)->with('system')->get();

        if ($rankingCriterias->isEmpty()) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theRankingSystemIsIncorrect']);
        }

        if (empty($this->rankingCriteria->find($criteria_id))) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theCriteriaIsIncorrect']);
        }

        $rankingIndicators = $this->rankingIndicator->where('criterion_id', $criteria_id)->with('criteria')->get();

        $colleges = $this->college->where('institution_id', Auth::user()->institutionUser->institution_id)->get();

        $departments = $this->department->whereIn('college_id', $colleges->pluck('id')->toArray())->get();

        if (Auth::user()->programs->isEmpty()) {
            $programs = $this->program->whereHas('categories', function ($query) use ($rankingSystemId) {
                $query->where('system_id', $rankingSystemId);
            })->whereIn('department_id', $departments->pluck('id')->toArray())->get();
        } else {
            $programs = Auth::user()->programs()->whereHas('categories', function ($query) use ($rankingSystemId) {
                $query->where('system_id', $rankingSystemId);
            })->get();
        }

        if ($rankingIndicators->isNotEmpty()) {
            $value = $this->rankingResult->where('rankable_id', $programId)->where('rankable_type', Program::class)->where('system_id', $rankingSystemId)->where('criteria_id', $criteria_id)->where('month', $month)->where('year', $year)->whereNotNull('value')->get();

            return view('results.index')->with('year', $year)->with('month', $month)->with('rankingSystemId', $rankingSystemId)->with('criteria_id', $criteria_id)->with('rankingIndicators', $rankingIndicators)->with('rankingSystems', $rankingSystems)->with('rankingCriterias', $rankingCriterias)->with('programs', $programs)->with('programId', $programId)->with('value', $value);

        } else {
            $opens = true;
            $value = $this->rankingResult->where('rankable_id', $programId)->where('rankable_type', Program::class)->where('system_id', $rankingSystemId)->where('criteria_id', $criteria_id)->where('month', $month)->where('year', $year)->whereNotNull('value')->get();
            $criteria = $this->rankingCriteria->find($criteria_id);

            return view('results.index')->with('year', $year)->with('month', $month)->with('rankingSystemId', $rankingSystemId)->with('criteria_id', $criteria_id)->with('rankingSystems', $rankingSystems)->with('rankingCriterias', $rankingCriterias)->with('opens', $opens)->with('criteria', $criteria)->with('programs', $programs)->with('programId', $programId)->with('value', $value);
        }
    }

    /**
     * @param $rankingSystem
     * @param $criteria
     * @param $year
     * @param $month
     * @return RedirectResponse
     */
    public function valueInstitution($rankingSystem, $criteria, $year, $month)
    {

        if ($year == 0 || $year < 2000 || $year > date('Y')) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theYearIsIncorrect']);
        }

        if ($month == 0 || $month > 12) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theMonthIsIncorrect']);
        }

        $rankingSystemId = $rankingSystem;
        $criteria_id = $criteria;
        $rankingSystems = $this->rankingSystem->all();
        $institutionId = Auth::user()->institutionUser->institution_id;
        $rankingCriterias = $this->rankingCriteria->where('system_id', $rankingSystemId)->with('system')->get();

        if ($rankingCriterias->isEmpty()) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theRankingSystemIsIncorrect']);
        }

        if (empty($this->rankingCriteria->find($criteria_id))) {
            return redirect()->route('result.index')->with('message', ['type' => 'error', 'text' => 'common.theCriteriaIsIncorrect']);
        }

        $rankingIndicators = $this->rankingIndicator->where('criterion_id', $criteria_id)->with('criteria')->get();

        $colleges = $this->college->where('institution_id', Auth::user()->institutionUser->institution_id)->get();

        $departments = $this->department->whereIn('college_id', $colleges->pluck('id')->toArray())->get();

        if (Auth::user()->programs->isEmpty()) {
            $programs = $this->program->whereHas('categories', function ($query) use ($rankingSystemId) {
                $query->where('system_id', $rankingSystemId);
            })->whereIn('department_id', $departments->pluck('id')->toArray())->get();
        } else {
            $programs = Auth::user()->programs()->whereHas('categories', function ($query) use ($rankingSystemId) {
                $query->where('system_id', $rankingSystemId);
            })->get();
        }

        if ($rankingIndicators->isNotEmpty()) {
            $value = $this->rankingResult->where('rankable_id', $institutionId)->where('rankable_type', Institution::class)->where('system_id', $rankingSystemId)->where('criteria_id', $criteria_id)->where('month', $month)->where('year', $year)->whereNotNull('value')->get();

            return view('results.index')->with('year', $year)->with('month', $month)->with('rankingSystemId', $rankingSystemId)->with('criteria_id', $criteria_id)->with('rankingIndicators', $rankingIndicators)->with('rankingSystems', $rankingSystems)->with('rankingCriterias', $rankingCriterias)->with('programs', $programs)->with('institutionId', $institutionId)->with('value', $value);

        } else {
            $opens = true;
            $value = $this->rankingResult->where('rankable_id', $institutionId)->where('rankable_type', Institution::class)->where('system_id', $rankingSystemId)->where('criteria_id', $criteria_id)->where('month', $month)->where('year', $year)->whereNotNull('value')->get();
            $criteria = $this->rankingCriteria->find($criteria_id);

            return view('results.index')->with('year', $year)->with('month', $month)->with('rankingSystemId', $rankingSystemId)->with('criteria_id', $criteria_id)->with('rankingSystems', $rankingSystems)->with('rankingCriterias', $rankingCriterias)->with('opens', $opens)->with('criteria', $criteria)->with('programs', $programs)->with('institutionId', $institutionId)->with('value', $value);
        }
    }
}
