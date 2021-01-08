<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\resetpassword;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    //

    public function index()
    {
        $user = User::find(301);

        Mail::to($user)->send(new ResetPassword());

        return back();
    }
}
