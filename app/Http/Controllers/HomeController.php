<?php

namespace App\Http\Controllers;

use App;
use App\model\RankingResult;
use App\Models\Setting\Institution;
use App\Models\Settings\College;
use App\Models\Settings\Department;
use App\Models\Settings\Program;
use App\Models\Settings\RankingCriteria;
use App\Models\Settings\RankingIndicator;
use App\Models\Settings\RankingSystem;
use App\Models\Settings\SystemCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;
use function view;

class HomeController extends Controller
{

    /**
     * @var rankingResult $rankingResult
     */
    protected $year;
    protected $month;
    /**
     * @var RankingResult $rankingResult
     */
    protected $rankingResult;
    /**
     * @var RankingCriteria $criteria
     */
    protected $criteria;
    /**
     * @var RankingSystem $rankingSystem
     */
    protected $rankingSystem;
    /**
     * @var RankingIndicator $indicator
     */
    protected $indicator;
    /**
     * @var Institution $institution
     */
    private $institution;
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
     * @param RankingCriteria $criteria
     * @param RankingSystem $rankingSystem
     * @param RankingIndicator $indicator
     * @param Institution $institution
     * @param College $college
     * @param Department $department
     * @param Program $program
     */
    public function __construct(RankingResult $rankingResult, RankingCriteria $criteria, RankingSystem $rankingSystem, RankingIndicator $indicator, Institution $institution, College $college, Department $department, Program $program)
    {
        $this->rankingResult = $rankingResult;
        $this->criteria = $criteria;
        $this->rankingSystem = $rankingSystem;
        $this->indicator = $indicator;
        $this->institution = $institution;
        $this->program = $program;
        $this->department = $department;
        $this->college = $college;
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {

        if (Auth::user()->systemUser) {

            return $this->systemDashboard($request);

        } elseif (Auth::user()->programs->isNotEmpty()) {
            return $this->programDashboard($request);

        } else {

            $year = $request->get('year', date('Y'));
            $month = $request->get('month', date('n'));
            $systemProgress = [];

            $rankingSystems = $this->rankingSystem->all();
            foreach ($rankingSystems as $system) {

                $rankingCriterias = $system->criteria->count();

                $indicators = $this->indicator->whereHas('criteria', function ($query) use ($system) {
                    $query->where('system_id', $system->id);
                })->count();

                if ($indicators > 0) {

                    $rankingIndicators = $this->indicator->whereIn('criterion_id', $system->criteria->pluck('id'))->get();

                    $resultIndicator = $this->rankingResult
                        ->where('rankable_id', Auth::user()->institutionUser->institution_id)
                        ->where('rankable_type', Institution::class)
                        ->whereIn('indicator_id', $rankingIndicators->pluck('id'))
                        ->whereNotNull('value')
                        ->where('year', $year)
                        ->where('month', $month)
                        ->count();

                    $progress = ($resultIndicator / $indicators) * 100;

                } else {
                    $results = $this->rankingResult
                        ->where('rankable_id', Auth::user()->institutionUser->institution_id)
                        ->where('rankable_type', Institution::class)
                        ->whereIn('criteria_id', $system->criteria->pluck('id'))
                        ->whereNotNull('value')
                        ->where('year', $year)
                        ->where('month', $month)
                        ->count();

                    $progress = $rankingCriterias ? ($results / $rankingCriterias) * 100 : 0;
                }

                $systemProgress[$system->id] = $progress;
            }
            $systems = $this->rankingSystem->get()->map(function ($item) use ($systemProgress) {
                $item['progress'] = round($systemProgress[$item->id] ?? 0, 2);
                return $item;
            });

            return view('home')->with('systems', $systems)->with('year', $year)->with('month', $month)->with('rankingSystems', $rankingSystems);
        }
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function systemDashboard(Request $request)
    {
        if ($request->has('institution')) {
            $request->validate([
                'institution' => 'required|numeric',
            ]);
        }

        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('n'));

        $institutions = $this->institution->all();

        $institutionId = $request->institution;


        if ($request->has('institution')) {
            $currentInstitution = $this->institution->find($institutionId);
            if (!empty($currentInstitution)) {
                $systemProgress = [];

                $rankingSystems = $this->rankingSystem->all();
                foreach ($rankingSystems as $system) {

                    $rankingCriterias = $system->criteria->count();

                    $indicators = $this->indicator->whereHas('criteria', function ($query) use ($system) {
                        $query->where('system_id', $system->id);
                    })->count();

                    if ($indicators > 0) {

                        $rankingIndicators = $this->indicator->whereIn('criterion_id', $system->criteria->pluck('id'))->get();

                        $resultIndicator = $this->rankingResult
                            ->where('rankable_id', $institutionId)
                            ->where('rankable_type', Institution::class)
                            ->whereIn('indicator_id', $rankingIndicators->pluck('id'))
                            ->whereNotNull('value')
                            ->where('year', $year)
                            ->where('month', $month)
                            ->count();

                        $progress = ($resultIndicator / $indicators) * 100;

                    } else {
                        $results = $this->rankingResult
                            ->where('rankable_id', $institutionId)
                            ->where('rankable_type', Institution::class)
                            ->whereIn('criteria_id', $system->criteria->pluck('id'))
                            ->whereNotNull('value')
                            ->where('year', $year)
                            ->where('month', $month)
                            ->count();

                        $progress = $rankingCriterias ? ($results / $rankingCriterias) * 100 : 0;
                    }

                    $systemProgress[$system->id] = $progress;
                }
                $systems = $this->rankingSystem->get()->map(function ($item) use ($systemProgress) {
                    $item['progress'] = round($systemProgress[$item->id] ?? 0, 2);
                    return $item;
                });

                return view('dashboard.system')->with('institutions', $institutions)->with('systems', $systems)->with('year', $year)->with('month', $month)->with('currentInstitution', $currentInstitution);

            }
            return redirect()->to('home')->with('institutions', $institutions)->with('message', ['type' => 'success', 'text' => trans('common.TheInstitutionDoesNotExist')]);
        }
        return view('dashboard.system')->with('institutions', $institutions);

    }


    /**
     * @param Request $request
     * @return Factory|View
     */
    public function programDashboard(Request $request)
    {
        if ($request->has('program')) {
            $request->validate([
                'program' => 'required|numeric',
            ]);
        }

        $year = $request->get('year', date('Y'));

        $programId = $request->program;
        $colleges = $this->college->where('institution_id', Auth::user()->institutionUser->institution_id)->get();
        $departments = $this->department->whereIn('college_id', $colleges->pluck('id'))->get();
        $allProgram = $this->program->whereIn('department_id', $departments->pluck('id'))->with('categories')
            ->whereHas('categories')->get();

        $programs = $this->program->where('responsible_id', Auth::user()->id)->with('categories')->whereHas('categories')->get();

        if (empty($programId)) {
            $firstProgram = $this->program->where('responsible_id', Auth::user()->id)->with('categories')->whereHas('categories')->first();
            $programId = $firstProgram->id;
            $currentProgram = $this->program->find($firstProgram->id);
        } else {
            $currentProgram = $this->program->find($programId);
        }

        if (!empty($currentProgram)) {

            if (in_array($currentProgram->id, $allProgram->pluck('id')->toArray())) {

                $results = array();
                $rankingSystems = $this->rankingSystem->all();

                foreach ($rankingSystems as $rankingSystem) {
                    $criterias = $this->criteria->where('system_id', $rankingSystem->id)->with('indicator')->get();

                    $indicatorsCount = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->count();

                    if ($indicatorsCount > 0) {
                        $indicators = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->get();
                        $resultIndicators = $this->rankingResult->where('system_id', $rankingSystem->id)
                            ->where('rankable_id', $programId)
                            ->whereNotNull('value')
                            ->where('rankable_type', Program::class)
                            ->whereIn('indicator_id', $indicators->pluck('id'))
                            ->where('year', $year)
                            ->count();

                        $total = ($resultIndicators / $indicatorsCount) * 100;
                        $finalTotal = $total / 12;
                        $totalSystem[$rankingSystem->id] = round($finalTotal ?? 0, 2);

                        for ($i = 1; $i <= 12; $i++) {

                            $resultIndicator = $this->rankingResult->where('system_id', $rankingSystem->id)
                                ->where('rankable_id', $programId)
                                ->whereNotNull('value')
                                ->where('rankable_type', Program::class)
                                ->whereIn('indicator_id', $indicators->pluck('id'))
                                ->where('year', $year)
                                ->where('month', $i)
                                ->count();

                            $progress = ($resultIndicator / $indicatorsCount) * 100;
                            $results[$rankingSystem->id][$i] = round($progress ?? 0, 2);

                        }
                    } else {

                        $resultsCriterias = $this->rankingResult->where('system_id', $rankingSystem->id)
                            ->where('rankable_id', $programId)
                            ->whereNotNull('value')
                            ->where('rankable_type', Program::class)
                            ->whereIn('criteria_id', $criterias->pluck('id'))
                            ->where('year', $year)
                            ->count();

                        $total = $criterias->count() ? ($resultsCriterias / $criterias->count()) * 100 : 0;
                        $finalTotal = $total / 12;
                        $totalSystem[$rankingSystem->id] = round($finalTotal ?? 0, 2);

                        for ($i = 1; $i <= 12; $i++) {

                            $resultsCriteria = $this->rankingResult->where('system_id', $rankingSystem->id)
                                ->where('rankable_id', $programId)
                                ->whereNotNull('value')
                                ->where('rankable_type', Program::class)
                                ->whereIn('criteria_id', $criterias->pluck('id'))
                                ->where('year', $year)
                                ->where('month', $i)
                                ->count();
                            $total = $criterias->count() ? ($resultsCriteria / $criterias->count()) * 100 : 0;
                            $results[$rankingSystem->id][$i] = round($total ?? 0, 2);

                        }
                    }
                }

                return view('dashboard.program')->with('programs', $programs)->with('currentProgram', $currentProgram)->with('rankingSystems', $rankingSystems)->with('programId', $programId)->with('year', $year)->with('results', $results)->with('totalSystem', $totalSystem);

            } else {
                return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.programDoesNotExist']);

            }
        }
        return redirect()->to('home')->with('programs', $programs)->with('message', ['type' => 'success', 'text' => trans('program.TheProgramDoesNotExist')]);

    }

    /**
     * @param $program_id
     * @param $system_id
     * @param $month
     * @param $lang
     * @param $year
     * @return array
     * @throws Throwable
     * @p\aram $system_id
     */
    public function showProgramDashboard($program_id, $system_id, $month, $lang, $year = null)
    {
        App::setLocale($lang);

        $systems = $this->rankingSystem->find($system_id);

        if (empty($year)) {
            $year = date('Y');
        }

        $criterias = $this->criteria->where('system_id', $system_id)->with('indicator')->get();

        $indicatorsCount = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->count();

        if ($indicatorsCount > 0) {
            $indicators = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->get();

            $resultIndicator = $this->rankingResult->whereIn('indicator_id', $indicators->pluck('id'))
                ->whereNotNull('value')
                ->where('rankable_id', $program_id)
                ->where('rankable_type', Program::class)
                ->where('system_id', $system_id)
                ->where('year', $year)
                ->where('month', $month)
                ->count();

            $results = $this->rankingResult->where('system_id', $system_id)
                ->where('rankable_id', $program_id)
                ->where('rankable_type', Program::class)
                ->where('year', $year)
                ->where('month', $month)->get();

            $progress = ($resultIndicator / $indicatorsCount) * 100;
            $systems['criterias'] = $criterias;
            $systems['results'] = $results;
            $systems['indicatorsCount'] = $indicatorsCount;

        } else {

            $resultsCriteria = $this->rankingResult->where('rankable_id', $program_id)
                ->whereNotNull('value')
                ->where('rankable_type', Program::class)
                ->where('system_id', $system_id)
                ->whereIn('criteria_id', $criterias->pluck('id'))
                ->where('year', $year)
                ->where('month', $month)
                ->count();

            $results = $this->rankingResult->where('system_id', $system_id)
                ->where('rankable_id', $program_id)
                ->where('rankable_type', Program::class)
                ->where('year', $year)
                ->where('month', $month)->get();

            $progress = $criterias->count() ? ($resultsCriteria / $criterias->count()) * 100 : 0;
            $systems['criterias'] = $criterias;
            $systems['results'] = $results;
            $systems['indicatorsCount'] = $indicatorsCount;

        }

        $systems['progress'] = round($progress ?? 0, 2);
        $systems['year'] = $year;
        $systems['month'] = $month;


        return ['html' => view('dashboard.drawProgram')->with('systems', $systems)->render()];

    }

    /**
     * @param $programId
     * @param null $year
     * @return Factory|View
     */
    public function programHome($programId, $year = null)
    {
        if (empty($year)) {
            $year = date('Y');
        }

        $program = $this->program->find($programId);

        if (!empty($program)) {

            if (!empty(Auth::user()->systemUser)) {
                $institution_id = $program->department->college->institution_id;
            } else {
                $institution_id = Auth::user()->institutionUser->institution_id;
            }

        $colleges = $this->college->where('institution_id', $institution_id)->get();

        $departments = $this->department->whereIn('college_id', $colleges->pluck('id'))->get();
        $programs = $this->program->whereIn('department_id', $departments->pluck('id'))->with('categories')
            ->whereHas('categories')->get();

        $results = array();
        $rankingSystems = $this->rankingSystem->all();

            if (in_array($program->id, $programs->pluck('id')->toArray())) {

                foreach ($rankingSystems as $rankingSystem) {
                    $criterias = $this->criteria->where('system_id', $rankingSystem->id)->with('indicator')->get();

                    $indicatorsCount = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->count();
                    if ($indicatorsCount > 0) {
                        $indicators = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->get();
                        $resultIndicators = $this->rankingResult->where('system_id', $rankingSystem->id)
                            ->where('rankable_id', $program->id)
                            ->whereNotNull('value')
                            ->where('rankable_type', Program::class)
                            ->whereIn('indicator_id', $indicators->pluck('id'))
                            ->where('year', $year)
                            ->count();

                        $total = ($resultIndicators / $indicatorsCount) * 100;
                        $finalTotal = $total / 12;
                        $totalSystem[$rankingSystem->id] = round($finalTotal ?? 0, 2);

                        for ($i = 1; $i <= 12; $i++) {

                            $resultIndicator = $this->rankingResult->where('system_id', $rankingSystem->id)
                                ->where('rankable_id', $program->id)
                                ->whereNotNull('value')
                                ->where('rankable_type', Program::class)
                                ->whereIn('indicator_id', $indicators->pluck('id'))
                                ->where('year', $year)
                                ->where('month', $i)
                                ->count();

                            $progress = ($resultIndicator / $indicatorsCount) * 100;
                            $results[$rankingSystem->id][$i] = round($progress ?? 0, 2);

                        }
                    } else {

                        $resultsCriterias = $this->rankingResult->where('system_id', $rankingSystem->id)
                            ->where('rankable_id', $program->id)
                            ->whereNotNull('value')
                            ->where('rankable_type', Program::class)
                            ->whereIn('criteria_id', $criterias->pluck('id'))
                            ->where('year', $year)
                            ->count();

                        $total = $criterias->count() ? ($resultsCriterias / $criterias->count()) * 100 : 0;
                        $finalTotal = $total / 12;
                        $totalSystem[$rankingSystem->id] = round($finalTotal ?? 0, 2);

                        for ($i = 1; $i <= 12; $i++) {

                            $resultsCriteria = $this->rankingResult->where('system_id', $rankingSystem->id)
                                ->where('rankable_id', $program->id)
                                ->whereNotNull('value')
                                ->where('rankable_type', Program::class)
                                ->whereIn('criteria_id', $criterias->pluck('id'))
                                ->where('year', $year)
                                ->where('month', $i)
                                ->count();
                            $total = $criterias->count() ? ($resultsCriteria / $criterias->count()) * 100 : 0;
                            $results[$rankingSystem->id][$i] = round($total ?? 0, 2);

                        }
                    }
                }

                return view('details_program_progress')->with('rankingSystems', $rankingSystems)->with('programId', $programId)->with('year', $year)->with('results', $results)->with('totalSystem', $totalSystem);

            } else {
                return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.programDoesNotExist']);

            }
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.programDoesNotExist']);

    }

    /**
     * @param $program_id
     * @param $system_id
     * @param $month
     * @param $lang
     * @param $year
     * @return array
     * @throws Throwable
     * @p\aram $system_id
     */
    public function showProgress($program_id, $system_id, $month, $lang, $year = null)
    {
        App::setLocale($lang);

        $systems = $this->rankingSystem->find($system_id);

        if (empty($year)) {
            $year = date('Y');
        }

        $criterias = $this->criteria->where('system_id', $system_id)->with('indicator')->get();

        $indicatorsCount = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->count();

        if ($indicatorsCount > 0) {
            $indicators = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->get();

            $resultIndicator = $this->rankingResult->whereIn('indicator_id', $indicators->pluck('id'))
                ->whereNotNull('value')
                ->where('rankable_id', $program_id)
                ->where('rankable_type', Program::class)
                ->where('system_id', $system_id)
                ->where('year', $year)
                ->where('month', $month)
                ->count();

            $results = $this->rankingResult->where('system_id', $system_id)
                ->where('rankable_id', $program_id)
                ->where('rankable_type', Program::class)
                ->where('year', $year)
                ->where('month', $month)->get();

            $progress = ($resultIndicator / $indicatorsCount) * 100;
            $systems['criterias'] = $criterias;
            $systems['results'] = $results;
            $systems['indicatorsCount'] = $indicatorsCount;

        } else {

            $resultsCriteria = $this->rankingResult->where('rankable_id', $program_id)
                ->whereNotNull('value')
                ->where('rankable_type', Program::class)
                ->where('system_id', $system_id)
                ->whereIn('criteria_id', $criterias->pluck('id'))
                ->where('year', $year)
                ->where('month', $month)
                ->count();

            $results = $this->rankingResult->where('system_id', $system_id)
                ->where('rankable_id', $program_id)
                ->where('rankable_type', Program::class)
                ->where('year', $year)
                ->where('month', $month)->get();

            $progress = $criterias->count() ? ($resultsCriteria / $criterias->count()) * 100 : 0;
            $systems['criterias'] = $criterias;
            $systems['results'] = $results;
            $systems['indicatorsCount'] = $indicatorsCount;


        }

        $systems['progress'] = round($progress ?? 0, 2);
        $systems['year'] = $year;
        $systems['month'] = $month;
        $systems['lang'] = $lang;

        return ['html' => view('drawProgram')->with('systems', $systems)->render()];

    }

    /**
     * @param $categoryId
     * @param SystemCategory $systemCategory
     * @return JsonResponse
     */
    public function getPrograms($categoryId, SystemCategory $systemCategory)
    {
        $programCategory = $systemCategory->find($categoryId);
        $institutionId = Auth::user()->institutionUser->institution_id;
        $programs = $programCategory->programs()->whereHas('department.college', function ($query) use ($institutionId) {
            $query->where('institution_id', $institutionId);
        })->get();

        return response()->json($programs);
    }

    /**
     * @param $categoryId
     * @param $institutionId
     * @param SystemCategory $systemCategory
     * @return JsonResponse
     */
    public function adminGetPrograms($categoryId, $institutionId, SystemCategory $systemCategory)
    {
        $programCategory = $systemCategory->find($categoryId);

        $programs = $programCategory->programs()->whereHas('department.college', function ($query) use ($institutionId) {
            $query->where('institution_id', $institutionId);
        })->get();

        return response()->json($programs);
    }


    public function CriteriaIndicator(Request $request, $systemId, $year, $institutionId=0)
    {
        if (Auth::user()->institutionUser) {
            $institutionId = Auth::user()->institutionUser->institution_id;
            $system = $this->rankingSystem->find($systemId);

            if (!$system) {
                return ['html' => '', 'status' => false];
            }

            $criterias = $this->criteria->where('system_id', $system->id)->with('indicator')->get();
            $indicatorsCount = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->count();
            $indicators = [];

            if ($indicatorsCount > 0) {

                $indicators = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->get();

                    $resultIndicators = $this->rankingResult->where('system_id', $system->id)
                        ->where('rankable_id', $institutionId)
                        ->whereNotNull('value')
                        ->where('rankable_type', Institution::class)
                        ->whereIn('indicator_id', $indicators->pluck('id'))
                        ->where('year', $year)
                        ->get();

                    $system['results'] = $resultIndicators;



                }else {

                    $resultsCriterias = $this->rankingResult->where('system_id', $system->id)
                        ->where('rankable_id', $institutionId)
                        ->whereNotNull('value')
                        ->where('rankable_type', Institution::class)
                        ->whereIn('criteria_id', $criterias->pluck('id'))
                        ->where('year', $year)
                        ->get();

                    $system['results'] = $resultsCriterias;

            }

            $system['indicatorsCount'] = $indicatorsCount;
            return ['status' => true, 'html' => view('dashboard.modals.criteriaTable')->with('system', $system)->with('indicators', $indicators)->with('year', $year)->with('criterias', $criterias)->render()];
        }

        if (!$institutionId) {
            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.TheInstitutionDoesNotExist']);
        }

        if (Auth::user()->systemUser) {


            $currentInstitution = $this->institution->find($institutionId);


                $system = $this->rankingSystem->find($systemId);

            if (!$system) {
                return ['html' => '', 'status' => false];
            }

            $criterias = $this->criteria->where('system_id', $system->id)->with('indicator')->get();
            $indicatorsCount = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->count();
            $indicators = [];

            if ($indicatorsCount > 0) {

                $indicators = $this->indicator->whereIn('criterion_id', $criterias->pluck('id'))->get();

                $resultIndicators = $this->rankingResult->where('system_id', $system->id)
                    ->where('rankable_id', $institutionId)
                    ->whereNotNull('value')
                    ->where('rankable_type', Institution::class)
                    ->whereIn('indicator_id', $indicators->pluck('id'))
                    ->where('year', $year)
                    ->get();

                $system['results'] = $resultIndicators;



            }else {

                $resultsCriterias = $this->rankingResult->where('system_id', $system->id)
                    ->where('rankable_id', $institutionId)
                    ->whereNotNull('value')
                    ->where('rankable_type', Institution::class)
                    ->whereIn('criteria_id', $criterias->pluck('id'))
                    ->where('year', $year)
                    ->get();

                $system['results'] = $resultsCriterias;

            }

            $system['indicatorsCount'] = $indicatorsCount;
            return ['status' => true, 'html' => view('dashboard.modals.criteriaTable')->with('system', $system)->with('indicators', $indicators)->with('year', $year)->with('criterias', $criterias)->with('currentInstitution', $currentInstitution)->render()];
        }
    }
}
