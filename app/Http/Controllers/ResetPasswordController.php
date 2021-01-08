<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\resetpassword;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{

    public function index(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        // dd($user);
        if ($user != null) {
            $passwordToken = md5(uniqid(rand(), true));

            $user->update([
                'password_token' => $passwordToken
            ]);
            // Mail::to($user)->send(new ResetPassword());

            return back()->with('success', 'An email has been sent to the specific email.');
        }
        // User doesnt exists
        return back()->with('danger', 'Email couldnt be found!');
    }
}
