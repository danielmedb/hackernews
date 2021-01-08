<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\resetpassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{

    public function index(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user != null) {
            $passwordToken = md5(uniqid(rand(), true));

            $user->update([
                'password_token' => $passwordToken
            ]);
            Mail::to($user)->send(new ResetPassword($passwordToken));

            return back()->with('success', 'An email has been sent to the specific email.');
        } else {
            // User doesnt exists
            return back()->with('danger', 'Email couldnt be found!');
        }
        return back();
    }

    public function reset($token)
    {
        $user = User::where('password_token', $token)->first();

        // User matched with token
        if ($user != null) {
            return view('auth.reset')->with('token', $token);
        }
        return view('auth.login');
        // No user found with that token

    }

    public function updatePassword(Request $request, $token)
    {
        $user = User::where('password_token', $token)->first();

        if ($user != null) {

            $this->validate($request, [
                'password' => 'required|min:6'
            ]);

            $user->update([
                'password' => Hash::make($request->password),
                'password_token' => null
            ]);

            return back()->with('success', 'Your password has been updated.');
        } else {
            // User doesnt exists
            return redirect('auth.login')->with('danger', 'Couldnt find any user.');
        }
        return back();
    }
}
