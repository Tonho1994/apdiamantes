<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\SettingsEmailRequest;
use App\Http\Requests\Account\SettingsInfoRequest;
use App\Http\Requests\Account\SettingsPasswordRequest;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $info = auth()->user()->info;

        // get the default inner page
        return view('pages.account.settings.settings', compact('info'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingsInfoRequest $request)
    {
        // save user name
        $validated = $request->validated();
        auth()->user()->update($validated);
        // save on user info
        $info = UserInfo::where('user_id', auth()->user()->id)->first();
        if ($info === null) {
            // create new model
            $info = new UserInfo();
        }
        // attach this info to the current user
        $info->user()->associate(auth()->user());
        foreach ($request->safe()->except(['nombre','apellido_paterno', 'apellido_materno']) as $key => $value) {
            if (is_array($value)) {
                $value = serialize($value);
            }
            $info->$key = $value;
        }
        // include to save avatar
        if ($avatar = $this->upload()) {
            $info->avatar = $avatar;
        }
        if ($request->boolean('avatar_remove')) {
            Storage::delete($info->avatar);
            $info->avatar = null;
        }
        $info->save();
        if ($request->expectsJson()) {
            return response()->json(['message' => __('Personal Information Updated')]);
        }
        return redirect()->intended('account/settings');
    }
    /**
     * Function for upload avatar image
     *
     * @param  string  $folder
     * @param  string  $key
     * @param  string  $validation
     *
     * @return false|string|null
     */
    public function upload($folder = 'images', $key = 'avatar', $validation = 'image|mimes:jpeg,png,jpg|max:2048|sometimes')
    {
        request()->validate([$key => $validation]);
        $file = null;
        if (request()->hasFile($key)) {
            $file = Storage::disk('public')->putFile($folder, request()->file($key), 'public');
        }
        return $file;
    }

    /**
     * Function to accept request for change email
     *
     * @param  SettingsEmailRequest  $request
     */
    public function changeEmail(SettingsEmailRequest $request)
    {
        auth()->user()->update(['email' => $request->input('email')]);
        if ($request->expectsJson()) {
            return response()->json(['message' => __('E-Mail Updated')]);
        }
        return redirect()->intended('account/settings');
    }

    /**
     * Function to accept request for change password
     *
     * @param  SettingsPasswordRequest  $request
     */
    public function changePassword(SettingsPasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->input('password'))]);
        if ($request->expectsJson()) {
            return response()->json(['message'=>__('Password Updated')]);
        }
        return redirect()->intended('account/settings');
    }
}
