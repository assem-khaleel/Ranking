<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\model\RankingResult;
use App\Models\Setting\Users\InstitutionUser;
use App\Models\Settings\College;
use App\Models\Settings\Department;
use App\Models\Settings\Program;
use App\Models\Settings\RankingIndicator;
use App\Models\Settings\RankingSystem;
use App\Models\Settings\SystemCategory;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProgramController extends Controller
{

    /**
     * @var Program program
     */
    protected $program;
    /**
     * @var Department department
     */
    protected $department;
    /**
     * @var College college
     */
    protected $college;
    /**
     * @var RankingSystem rankingSystem
     */
    protected $rankingSystem;
    /**
     * @var InstitutionUser institutionUser
     */
    private $institutionUser;

    /**
     * ProgramController constructor.
     * @param Program $program
     * @param Department $department
     * @param College $college
     * @param RankingSystem $rankingSystem
     * @param InstitutionUser $institutionUser
     */
    public function __construct(Program $program, Department $department, College $college, RankingSystem $rankingSystem, InstitutionUser $institutionUser)
    {
        $this->program = $program;
        $this->department = $department;
        $this->college = $college;
        $this->rankingSystem = $rankingSystem;
        $this->institutionUser = $institutionUser;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            if (Auth::user()->institutionUser) {
                $departments = $this->department->whereIn('college_id', Auth::user()->institutionUser->institution->colleges->pluck('id'));
//        Department::chunk(2,function ($dept) {
//            foreach ($dept as $d) {
//                dd($d);
//
//            }
//
//        });

//                dd($departments);
                $programs = $this->program->whereIn('department_id', $departments->pluck('id'))->paginate();
            }

            if (Auth::user()->systemUser) {
                $programs = $this->program->paginate();
            }

            return view('settings.program.index')->with('data', $programs);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $systemCategory = SystemCategory::all();

            $users = $this->institutionUser->where('institution_id', Auth::user()->institutionUser->institution_id)->with('user')->whereHas('user', function ($query) {
                $query->where('status', 1);
            })->get();

            $ranking = $this->rankingSystem->with('categories')->get();
            $college = $this->college->where('institution_id', Auth::user()->institutionUser->institution_id)->get();

            return view('settings.program.create')->with('colleges', $college)->with('rankingSystem', $ranking)->with('systemCategory', $systemCategory)->with('users', $users)->with('is_orgchart', $request->get('is_orgchart', false));
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $request->validate([
                'name_en' => "required|unique:programs,name_en,0,id,department_id," . $request->get('department_id'),
                'name_ar' => "required|unique:programs,name_ar,0,id,department_id," . $request->get('department_id'),
                'responsible_id' => 'nullable|numeric',
                'department_id' => 'required|numeric',
            ]);

            $program = $this->program->create($request->all());
            $categories = $request->get('categories', []);
            $program->categories()->sync(array_filter($categories));
            $redirect = Redirect()->route('program.index');

            if ($request->get('is_orgchart', 0)) {
                $redirect = Redirect()->route('org-chart');
            }

            return $redirect->with('message', ['type' => 'success', 'text' => 'common.sucessMsg']);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function show($id, Request $request)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            if ($request->ajax()) {
                return response()->json($this->program->find($id));
            }
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function edit($id, Request $request)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $program = $this->program->find($id);

            if (!empty($program)) {
                $departments = $this->department->whereIn('college_id', Auth::user()->institutionUser->institution->colleges->pluck('id'))->get();

                if (Auth::user()->institutionUser) {

                    if (!in_array($program->department_id, $departments->pluck('id')->toArray())) {
                        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.programDoesNotExist']);
                    }
                }

                $users = $this->institutionUser->where('institution_id', Auth::user()->institutionUser->institution_id)->with('user')->whereHas('user', function ($query) {
                    $query->where('status', 1);
                })->get();

                $college = $this->college->where('institution_id', Auth::user()->institutionUser->institution_id)->get();
                $ranking = $this->rankingSystem->with('categories')->get();

                return view('settings.program.edit')->with('program', $program)->with('colleges', $college)->with('rankingSystem', $ranking)->with('users', $users)->with('is_orgchart', $request->get('is_orgchart', false));
            }

            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.programDoesNotExist']);
        }
        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);

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
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $program = $this->program->find($id);

            if (!empty($program)) {

                $request->validate([
                    'name_en' => "required|unique:programs,name_en,$id,id,department_id," . $program->department_id,
                    'name_ar' => "required|unique:programs,name_ar,$id,id,department_id," . $program->department_id,
                    'responsible_id' => 'nullable|numeric',
                    'department_id' => 'required|numeric',

                ]);

                $departments = $this->department->whereIn('college_id', Auth::user()->institutionUser->institution->colleges->pluck('id'))->get();

                if (Auth::user()->institutionUser) {
                    if (!in_array($program->department_id, $departments->pluck('id')->toArray())) {
                        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.programDoesNotExist']);
                    }
                }

                $program->update($request->all());
                $categories = $request->get('categories', []);
                $program->categories()->sync(array_filter($categories));

                $redirect = Redirect()->route('program.index');

                if ($request->get('is_orgchart', 0)) {
                    $redirect = Redirect()->route('org-chart');
                }

                return $redirect->with('message', ['type' => 'success', 'text' => 'common.updateSuccessfully']);
            }

            return redirect()->route('home')->with('message', ['type' => 'success', 'text' => 'common.programDoesNotExist']);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function destroy($id, Request $request)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $program = $this->program->find($id);
            $redirect = Redirect()->route('program.index');

            if ($request->get('is_orgchart', 0)) {
                $redirect = Redirect()->route('org-chart');
            }

            if ($program) {
                $departments = $this->department->whereIn('college_id', Auth::user()->institutionUser->institution->colleges->pluck('id'))->get();

                if (Auth::user()->institutionUser) {
                    if (!in_array($program->department_id, $departments->pluck('id')->toArray())) {
                        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.programDoesNotExist']);
                    }
                }

                $program->delete($program->all());

                return $redirect->with('message', ['type' => 'success', 'text' => 'common.sucessMsgRemove']);
            } else {

                return $redirect->with('message', ['type' => 'error', 'text' => 'common.errorMsgRemove']);
            }
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * @param $id
     * @param RankingSystem $system
     * @param RankingIndicator $indicator
     * @param RankingResult $result
     * @return RedirectResponse|Collection
     */
    public function progress($id, RankingSystem $system, RankingIndicator $indicator, RankingResult $result)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $program = $this->program->find($id);

            $categories = $program->categories;
            $systemProgress = [];

            foreach ($categories as $category) {

                $indicators = $indicator->whereIn('criterion_id', $category->system->criteria->pluck('id'))->count();

                if ($indicators > 0) {
                    $indicatorsObj = $indicator->whereIn('criterion_id', $category->system->criteria->pluck('id'))->get();
                    $resultIndicator = $result->whereIn('indicator_id', $indicatorsObj->pluck('id'))
                        ->where('rankable_id', $id)
                        ->where('rankable_type', Program::class)
                        ->whereNotNull('value')
                        ->where('year', date('Y'))
                        ->where('month', date('n'))
                        ->count();

                    $progress = ($resultIndicator / $indicators) * 100;

                } else {

                    $results = $result->where('rankable_id', $id)
                        ->where('rankable_type', Program::class)
                        ->where('system_id', $category->system_id)
                        ->whereIn('criteria_id', $category->system->criteria->pluck('id'))
                        ->whereNotNull('value')
                        ->where('year', date('Y'))
                        ->where('month', date('n'))
                        ->count();

                    $progress = $category->system->criteria->count() ? ($results / $category->system->criteria->count()) * 100 : 0;
                }

                $systemProgress[$category->system_id] = $progress;
            }

            $systems = $system->whereIn('id', array_keys($systemProgress))->get()->map(function ($item) use ($systemProgress) {
                $item['progress'] = round($systemProgress[$item->id] ?? 0, 2);
                return $item;
            });

            return $systems;

        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }
}
