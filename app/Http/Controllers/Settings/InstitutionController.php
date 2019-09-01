<?php

namespace App\Http\Controllers\Settings;

use App\Models\Setting\Institution;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class InstitutionController extends Controller
{
    /**
     * @var institution $institution
     */

    protected  $institution;

    /**
     * InstitutionController constructor.
     * @param Institution $institution
     */
    public function __construct(Institution $institution)
    {
        $this->institution = $institution;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(Auth::user()->systemUser){
            $institutions = $this->institution->paginate();

            return view('settings.institution.index')->with('data',$institutions);
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
        if(Auth::user()->systemUser){
            return view('settings.institution.forms.create');
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
                'name_en' => 'required',
                'name_ar' => 'required',
            ]);

            $this->institution->create($request->all());

            return Redirect()->route('institution.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsg']);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if(Auth::user()->systemUser){
            $institution = $this->institution->find($id);

            if ($institution) {
                return view('settings.institution.forms.edit')->with('data', $institution);
            }

            return Redirect()->route('home')->with('message',['type'=>'success','text' => 'settings.institutionDoesNotExist']);
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
        if (Auth::user()->systemUser) {
             $institution = $this->institution->find($id);

             if ($institution) {

                 $request->validate([
                     'name_en' => 'required',
                     'name_ar' => 'required',
                 ]);

                 $institution->update($request->all());

                 return Redirect()->route('institution.index')->with('message', ['type' => 'success', 'text' => 'common.updateSuccessfully']);
             }

             return Redirect()->route('home')->with('message', ['type' => 'success', 'text' => 'settings.institutionDoesNotExist']);
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
        if (Auth::user()->systemUser) {
            $institution = $this->institution->find($id);

            if ($institution) {
                $institution->delete($institution->all());

                return Redirect()->route('institution.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsgRemove']);
            } else {

                return Redirect()->route('institution.index')->with('message', ['type' => 'error', 'text' => 'common.errorMsgRemove']);
            }


        }
        return Redirect()->route('home')->with('message',['type'=>'error','text'=> 'common.permission']);

    }

}
