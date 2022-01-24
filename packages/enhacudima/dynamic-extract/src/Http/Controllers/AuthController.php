<?php

namespace Enhacudima\DynamicExtract\Http\Controllers;

use Illuminate\Routing\Controller;
use Enhacudima\DynamicExtract\DataBase\Model\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function __construct()
    {
    }

    public function signIn(Request $request, $user)
    {
        // Check if the URL is valid
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        // Authenticate the user
        $user = User::findOrFail($request->user);
        Auth::login($user);

        // Redirect to homepage
        return redirect(config('dynamic-extract.prefix').'/report/index');
    }

    public function logout(Request $request)
    {
        // logout
        Auth::logout();

        // Redirect to homepage
        return view('extract-view::welcome');
    }

}
