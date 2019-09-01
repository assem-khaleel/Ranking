<?php

namespace App\Http\Controllers\Profiles;

use App\model\File;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting\Users\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{

    /**
     * @var User $user
     */
    protected $user;

    /**
     * @var File $file
     */
    protected $file;

    /**
     * ProfileController constructor.
     * @param User $user
     * @param File $file
     */
    public function __construct(User $user, File $file)
    {
        $this->user = $user;
        $this->file = $file;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user =$this->user->find(Auth()->id());

        return view('profiles.edit')->with('user', $user);
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
        $user = $this->user->find(Auth()->id());

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|exists:users|unique:users,email,'.$user->id,
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
            }else{

                $attributes['local_path'] = 'profile/images';
                $attributes['file'] = $request->file('image');
                $attributes['description'] = User::$PROFILE_IMAGE;
                $attributes['fileable_id'] = $user->id;
                $attributes['fileable_type'] = User::class;

                $attributes['old_file'] = $user->image->path;

                $user->image->updateFile($attributes);
            }
        }
        return redirect()->route('profiles.myProfile')->with('message',['type'=>'success','text'=>'common.updateSuccessfully']);
    }

    /**
     * @return Factory|View
     */
    public function myProfile()
    {
        $user = $this->user->find(Auth()->id());

        return view('profiles.myProfile')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return User
     * @throws ValidationException
     */
    public function changePassword(Request $request)
    {
        if (Auth::Check()) {

            $current_password = Auth::User()->password;

            if (Hash::check($request->get('current-password'), $current_password)) {
                if ($request->get('new-password') == $request->get('new-password_confirmation')):
                    $this->validate($request, [
                        'current-password' => 'required',
                        'new-password' => 'required|string|min:8|confirmed',
                    ]);
                    $user_id = Auth::User()->id;
                    $user = $this->user->find($user_id);
                    $user->password = Hash::make($request->get('new-password'));;
                    $user->save();
                    return redirect()->back()->with('message',['type'=>'success','text' => 'users.passwordChangedSuccessfully']);
                else:
                    return redirect()->back()->with('message',['type'=>'error','text' => 'users.newPasswordCannotBe']);

                endif;
            } else {
                return redirect()->back()->with('message',['type'=>'error','text' => 'users.yourCurrentPasswordDoesNot']);

            }

        } else {
            return redirect()->route('home');
        }
    }
}
