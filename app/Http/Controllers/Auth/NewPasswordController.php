<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request, $token)
    {
        return view('auth.reset-password', compact('request', 'token'));
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password'       => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );
        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        switch ($status) {
            case Password::PASSWORD_RESET; //Autenticacion exitosa
                # code...
                return response()->json([
                    'message' => __('Password change successful. You will be redirected to login')
                ], 200);
            break;
            case Password::INVALID_USER; //Usuario no encontrado
                return response()->json([
                    'message' => __('The data entered does not match our records')
                ], 404);
                # code...
            break;
            case Password::INVALID_TOKEN; //Token invalido
                return response()->json([
                    'message' => __('The token has expired or is invalid')
                ], 400);
            break;
            default:
                return response()->json([
                    'message' => __('Something strange happened').'NPC-01.'
                ], 422);
            break;
        }

    }
}
