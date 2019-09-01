<?php

namespace App\Http\Controllers\Settings\Users;

use App\Mail\UserPassword;
use App\model\File;
use App\Models\Setting\Users\InstitutionUser;
use App\Models\Setting\Users\User;
use App\Notifications\ChangePassword;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting\Institution;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class InstitutionUserController extends Controller
{
    /**
     * @var User $user
     */
    protected $user;

    /**
     * @var institutionUser $institutionUser
     */
    protected $institutionUser;
    /**
     * @var institution $institution
     */
    protected $institution;

    /**
     * @var file $file
     */
    protected $file;

    /**
     * ProfileController constructor.
     * @param User $user
     * @param InstitutionUser $institutionUser
     * @param Institution $institution
     * @param File $file
     */
    public function __construct(User $user, InstitutionUser $institutionUser, Institution $institution, File $file)
    {
        $this->user = $user;
        $this->institutionUser = $institutionUser;
        $this->institution = $institution;
        $this->file = $file;
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
                $institution_id = Auth::user()->institutionUser->institution_id;
                $users = $this->user->with('institutionUser')->whereHas('institutionUser', function ($query) use ($institution_id) {
                    $query->where('institution_id', $institution_id);
                })->paginate();
            }

            if (Auth::user()->systemUser) {
                $users = $this->user->with('institutionUser')->whereHas('institutionUser')->paginate();

            }

            return view('users.InstitutionUsers.index')->with('users', $users);

        } else {
            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
        }

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
                $institutions = $this->institution->where('id', Auth::user()->institutionUser->institution_id)->get();
            }

            if (Auth::user()->systemUser) {
                $institutions = $this->institution->all();
            }

            return view('users.InstitutionUsers.create')->with('institutions', $institutions);

        } else {
            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $clearPassword = str_random(8);
        $password = bcrypt($clearPassword);

        $request->merge(['password' => $password]);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,',
            'institution_id' => 'required|numeric',
            'image' => 'mimes:jpeg,jpg,bmp,png|max:10000',
        ]);

        if (Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            if ($request->institution_id == Auth::user()->institutionUser->institution_id) {
                $institution_id = $request->institution_id;

            } else {
                return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'users.userDoesNotExist']);
            }

        }

        if (Auth::user()->systemUser) {
            $institution_id = $request->institution_id;
        }

        /** @var User $user */
        $user = $this->user->create($request->all());
        if ($request->file('image')) {

            $attributes['local_path'] = 'profile/images';
            $attributes['file'] = $request->file('image');
            $attributes['description'] = User::$PROFILE_IMAGE;
            $attributes['fileable_id'] = $user->id;
            $attributes['fileable_type'] = User::class;

            $this->file->createFile($attributes);

        }

        $this->institutionUser->create(['user_id' => $user->id, 'institution_id' => $institution_id]);
        if ($user) {
            Mail::to($user->email)->send(
                new UserPassword($user, $clearPassword)
            );
            $user->notify(new ChangePassword($user, $clearPassword));

        }
        return Redirect()->route('institution-user.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsg']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            $user = $this->user->find($id);

            if ($user) {

                if (Auth::user()->systemUser) {
                    $institutions = $this->institution->all();

                }

                if (Auth::user()->institutionUser) {
                    $institutions = $this->institution->where('id', Auth::user()->institutionUser->institution_id)->get();
                    $institutionUser = $this->institutionUser->where('institution_id', Auth::user()->institutionUser->institution_id)->get();

                    if (!in_array($id, $institutionUser->pluck('user_id')->toArray())) {
                        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
                    }

                    if (!($user->institutionUser->institution_id == Auth::user()->institutionUser->institution_id)) {
                        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'users.userDoesNotExist']);
                    }

                }

                return view('users.InstitutionUsers.show')->with('user', $user)->with('institutions', $institutions);
            }

            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'users.userDoesNotExist']);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function edit($id)
    {
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            if (Auth::user()->systemUser) {
                $institutions = $this->institution->all();
            }

            $user = $this->user->find($id);
            if ($user) {

                if (Auth::user()->institutionUser) {

                    if ($user->institutionUser->institution_id != Auth::user()->institutionUser->institution_id) {
                        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'users.UserDoesNotExist']);
                    }

                    $institutions = $this->institution->where('id', Auth::user()->institutionUser->institution_id)->get();

                }
                return view('users.InstitutionUsers.edit')->with('user', $user)->with('institutions', $institutions);
            }
            return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'users.userDoesNotExist']);
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
        $user = $this->user->find($id);

        if ($user) {
            $institutionUser = $this->institutionUser->where('user_id', $id);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'institution_id' => 'required|numeric',
                'image' => 'mimes:jpeg,jpg,bmp,png|max:10000',
            ]);

            if (Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

                if ($request->institution_id == Auth::user()->institutionUser->institution_id) {
                    $institution_id = $request->institution_id;

                } else {
                    return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'users.userDoesNotExist']);
                }
            }

            if (Auth::user()->systemUser) {
                $institution_id = $request->institution_id;
            }

            $user->update($request->all());
            $institutionUser->update(['user_id' => $user->id, 'institution_id' => $institution_id]);

            if ($request->file('image')) {
                if (empty($user->image)) {
                    $attributes['local_path'] = 'profile/images';
                    $attributes['file'] = $request->file('image');
                    $attributes['description'] = User::$PROFILE_IMAGE;
                    $attributes['fileable_id'] = $user->id;
                    $attributes['fileable_type'] = User::class;

                    $this->file->createFile($attributes);
                } else {

                    $attributes['local_path'] = 'profile/images';
                    $attributes['file'] = $request->file('image');
                    $attributes['description'] = User::$PROFILE_IMAGE;
                    $attributes['fileable_id'] = $user->id;
                    $attributes['fileable_type'] = User::class;

                    $attributes['old_file'] = $user->image->path;

                    $user->image->updateFile($attributes);
                }
            }

            return redirect()->route('institution-user.index')->with('message', ['type' => 'success', 'text' => 'common.updateSuccessfully']);
        }


        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'users.userDoesNotExist']);
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
        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {
            $user = $this->user->find($id);

            if (Auth::user()->institutionUser) {
                if ($user->institutionUser->institution_id != Auth::user()->institutionUser->institution_id) {
                    return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'users.userDoesNotExist']);
                }
            }

            if ($user) {
                if (!empty($user->image->path)) {
                    Storage::disk('public')->delete($user->image->path);
                    $user->image->delete();
                }

                $user->institutionUser->delete();
                $user->delete();

                return redirect()->route('institution-user.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsgRemove']);
            }

            return redirect()->route('institution-user.index')->with('message', ['type' => 'error', 'text' => 'common.notSuccessfullyRemoved']);
        }
        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function active($id)
    {

        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {
            $user = $this->user->find($id);

            if (Auth::user()->institutionUser) {
                if ($user->institutionUser->institution_id != Auth::user()->institutionUser->institution_id) {

                    return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'users.userDoesNotExist']);
                }
            }

            $user->update(['status' => 1]);

            return redirect()->route('institution-user.index')->with('message', ['type' => 'success', 'text' => 'users.activeUserSuccessfully']);
        }
        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }


    /**
     * @param $id
     * @return RedirectResponse
     */
    public function inactive($id)
    {

        if (Auth::user()->systemUser || Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {
            $user = $this->user->find($id);

            if (Auth::user()->institutionUser) {
                if ($user->institutionUser->institution_id != Auth::user()->institutionUser->institution_id) {

                    return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'users.userDoesNotExist']);
                }
            }

            $user->update(['status' => 0]);

            return redirect()->route('institution-user.index')->with('message', ['type' => 'success', 'text' => 'users.InactiveUserSuccessfully']);
        }
        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $userId
     * @return User
     * @throws ValidationException
     */
    public function changePassword(Request $request, $userId)
    {
        if (Auth::Check()) {
            $user = $this->user->find($userId);

            if (Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {
                $institutionUser = $this->institutionUser->where('institution_id', Auth::user()->institutionUser->institution_id)->get();

                if (!in_array($userId, $institutionUser->pluck('user_id')->toArray())) {
                    return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
                }
            }

            $current_password = $user->password;

            if (Hash::check($request->get('current-password'), $current_password)) {
                if ($request->get('new-password') == $request->get('new-password_confirmation')) {
                    $this->validate($request, [
                        'current-password' => 'required',
                        'new-password' => 'required|string|min:8|confirmed',
                    ]);

                    $user->password = Hash::make($request->get('new-password'));;
                    $user->save();
                    return redirect()->back()->with('message', ['type' => 'success', 'text' => 'users.passwordChangedSuccessfully']);
                } else {
                    return redirect()->back()->with('message', ['type' => 'error', 'text' => 'users.newPasswordCannotBe']);

                }
            } else {
                return redirect()->back()->with('message', ['type' => 'error', 'text' => 'users.yourCurrentPasswordDoesNot']);

            }

        } else {
            return redirect()->route('home');
        }
    }
}
