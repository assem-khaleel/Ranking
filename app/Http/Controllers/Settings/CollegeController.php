<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

use App\Models\Setting\Institution;
use App\Models\Settings\College;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CollegeController extends Controller
{

    /**
     * @var College $college
     */

    protected $college;

    protected $institution;

    /**
     * CollegeController constructor.
     * @param College $college
     * @param Institution $institution
     */
    public function __construct(College $college, Institution $institution)
    {
        $this->college = $college;
        $this->institution = $institution;
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
                $colleges = $this->college->where('institution_id', Auth::user()->institutionUser->institution_id)->paginate();
            }

            if (Auth::user()->systemUser) {
                $colleges = $this->college->paginate();
            }
            return view('settings.college.index')->with('data', $colleges);
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

            return view('settings.college.create');
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

            $institutionId = Auth::user()->institutionUser->institution_id;
            $request->merge(['institution_id' => $institutionId]);

            $request->validate([
                'name_en' => "required|unique:colleges,name_en,0,id,institution_id," . $institutionId,
                'name_ar' => "required|unique:colleges,name_ar,0,id,institution_id," . $institutionId,
            ]);

            $this->college->create($request->all());

            return Redirect()->route('college.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsg']);
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
                return response()->json($this->college->find($id));
            }

        }
        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function edit($id)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $college = $this->college->find($id);

            if (!empty($college)) {
                if (Auth::user()->institutionUser) {

                    if (!in_array($college->id, Auth::user()->institutionUser->institution->colleges->pluck('id')->toArray())) {
                        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.collegeDoesNotExist']);
                    }
                }

                return view('settings.college.edit')->with('data', $college);
            }

            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.collegeDoesNotExist']);
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

            $college = $this->college->find($id);

            if (!empty($college)) {

                $request->validate([
                    'name_en' => "required|unique:colleges,name_en,$id,id,institution_id," . $college->institution_id,
                    'name_ar' => "required|unique:colleges,name_ar,$id,id,institution_id," . $college->institution_id,
                ]);

                $college->update($request->all());

                $redirect = Redirect()->route('college.index');

                if ($request->get('is_orgchart', 0)) {
                    $redirect = Redirect()->route('org-chart');
                }

                return $redirect->with('message', ['type' => 'success', 'text' => 'common.updateSuccessfully']);
            }

            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.collegeDoesNotExist']);
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

            $college = $this->college->find($id);
            $redirect = Redirect()->route('college.index');

            if ($request->get('is_orgchart', 0)) {
                $redirect = Redirect()->route('org-chart');
            }

            if (Auth::user()->institutionUser) {

                if (!in_array($college->id, Auth::user()->institutionUser->institution->colleges->pluck('id')->toArray())) {
                    return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.collegeDoesNotExist']);
                }
            }

            if ($college) {
                $college->delete($college->all());

                return $redirect->with('message', ['type' => 'error', 'text' => 'common.sucessMsgRemove']);

            } else {

                return $redirect->with('message', ['type' => 'error', 'text' => 'common.errorMsgRemove']);
            }
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

}
