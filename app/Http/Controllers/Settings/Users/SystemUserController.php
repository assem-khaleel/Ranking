<?php

namespace App\Http\Controllers\Settings\Users;

use App\model\File;
use App\Models\Setting\Users\SystemUser;
use App\Models\Setting\Users\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SystemUserController extends Controller
{

    /**
     * @var User $user
     */
    protected $user;


    /**
     * @var systemUser $systemUser
     */
    protected $systemUser;

    /**
     * @var file $file
     */
    protected $file;

    /**
     * /**
     * ProfileController constructor.
     * @param User $user
     * @param systemUser $systemUser
     * @param File $file
     */
    public function __construct(User $user, SystemUser $systemUser, File $file)
    {
        $this->user = $user;
        $this->systemUser = $systemUser;
        $this->file = $file;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user()->systemUser) {

            $users = $this->user->with('systemUser')->whereHas('systemUser')->paginate();

            return view('users.systemUsers.index')->with('users', $users);
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
            return view('users.systemUsers.create');
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->systemUser) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required| string| min:8| confirmed',
                'image' => 'mimes:jpeg,jpg,bmp,png|max:10000',
            ]);

            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => User::$ACTIVE
            ]);

            $user->systemUser()->create(['user_id' => $user->id]);

            if ($request->file('image')) {
                $attributes['local_path'] = 'profile/images';
                $attributes['file'] = $request->file('image');
                $attributes['description'] = User::$PROFILE_IMAGE;
                $attributes['fileable_id'] = $user->id;
                $attributes['fileable_type'] = User::class;
                $this->file->createFile($attributes);

            }

            return redirect()->to('settings/users/system-user')->with('message', ['type' => 'success', 'text' => 'common.sucessMsg']);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        if (Auth::user()->systemUser) {
            $user = $this->user->find($id);

            return view('users.systemUsers.show')->with('user', $user);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        if (Auth::user()->systemUser) {
            $user = $this->user->find($id);

            return view('users.systemUsers.edit')->with('user', $user);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
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
        if (Auth::user()->systemUser) {
            $user = $this->user->find($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'image' => 'mimes:jpeg,jpg,bmp,png|max:10000',
            ]);


            $user->update($request->all());

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

            return redirect()->route('system-user.index')->with('message', ['type' => 'success', 'text' => 'common.updateSuccessfully']);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
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
        if (Auth::user()->systemUser) {
            $user = $this->user->find($id);
            if ($user) {

                if (!empty($user->image->path)) {
                    Storage::disk('public')->delete($user->image->path);
                    $user->image->delete();
                }

                $user->delete();

                return redirect()->route('system-user.index')->with('message', ['type' => 'success', 'text' => 'common.sucessMsgRemove']);
            }
            return redirect()->route('system-user.index')->with('message', ['type' => 'error', 'text' => 'users.userDoesNotExist']);
        }
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);

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
        if (Auth::user()->systemUser) {

            if (Auth::Check()) {

                $user = $this->user->find($userId);
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
        return Redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);

    }
}
