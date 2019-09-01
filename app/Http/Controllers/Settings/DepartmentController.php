<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\College;
use App\Models\Settings\Department;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{

    protected $department;

    protected $college;

    /**
     * DepartmentController constructor.
     * @param Department $department
     * @param College $college
     */
    public function __construct(Department $department, College $college , Request $request)
    {


        $this->department = $department;
        $this->college = $college;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            if (Auth::user()->institutionUser) {
                $departments = $this->department->whereIn('college_id', Auth::user()->institutionUser->institution->colleges->pluck('id'))->paginate();
            }

            if (Auth::user()->systemUser) {
                $departments = $this->department->paginate();
            }

            return view('settings.department.index')->with('data', $departments);
        }
        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            if (Auth::user()->institutionUser) {
                $college = $this->college->where('institution_id', Auth::user()->institutionUser->institution_id)->get();
            }

            if (Auth::user()->systemUser) {
                $college = $this->college->paginate();
            }

            return view('settings.department.create')->with('data', $college)->with('department', $this->department);

        }
        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $request->validate([
                'name_en' => "required|unique:departments,name_en,0,id,college_id," . $request->get('college_id'),
                'name_ar' => "required|unique:departments,name_ar,0,id,college_id," . $request->get('college_id'),
                'college_id' => 'required|numeric',

            ]);

            $this->department->create($request->all());
            $redirect = Redirect()->route('department.index');

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
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $department = $this->department->find($id);

            if (Auth::user()->institutionUser) {
                if (!in_array($department->college_id, Auth::user()->institutionUser->institution->colleges->pluck('id')->toArray())) {
                    return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.departmentDoesNotExist']);
                }
            }

            if ($request->ajax()) {
                return response()->json($this->department->find($id));
            }

        }
        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $department = Department::find($id);

            if (!empty($department)) {

                if (Auth::user()->institutionUser) {
                    if (!in_array($department->college_id, Auth::user()->institutionUser->institution->colleges->pluck('id')->toArray())) {
                        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.departmentDoesNotExist']);

                    } else {
                        $college = $this->college->where('institution_id', Auth::user()->institutionUser->institution_id)->get();
                    }
                }

                if (Auth::user()->systemUser) {
                    $college = $this->college->all();
                }

                return view('settings.department.edit')->with('data', $college)->with('department', $department);
            }

            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.departmentDoesNotExist']);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $department = $this->department->findOrFail($id);

            $request->validate([
                'name_en' => "required|unique:departments,name_en,$id,id,college_id," . $request->get('college_id'),
                'name_ar' => "required|unique:departments,name_ar,$id,id,college_id," . $request->get('college_id'),
                'college_id' => 'required|numeric',
            ]);

            $department->update($request->all());
            $redirect = Redirect()->route('department.index');

            if ($request->get('is_orgchart', 0)) {
                $redirect = Redirect()->route('org-chart');
            }

            return $redirect->with('message', ['type' => 'success', 'text' => 'common.updateSuccessfully']);
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

            $department = $this->department->find($id);

            $redirect = Redirect()->route('department.index');

            if (Auth::user()->institutionUser) {

                if (!in_array($department->college_id, Auth::user()->institutionUser->institution->colleges->pluck('id')->toArray())) {
                    return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'department does not exist']);
                }

            }

            if ($request->get('is_orgchart', 0)) {
                $redirect = Redirect()->route('org-chart');
            }

            if ($department) {
                $department->delete($department->all());

                return $redirect->with('message', ['type' => 'success', 'text' => 'common.sucessMsgRemove']);
            } else {
                return $redirect->with('message', ['type' => 'error', 'text' => 'common.errorMsgRemove']);
            }
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

}
