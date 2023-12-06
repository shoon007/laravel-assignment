<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    //login page
    public function loginPage()
    {
        return view('loginPage');
    }

    //CUSTOM LOGOUT
    public function logout()
    {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }

    //Custom 404 errror page
    public function errorPage()
    {
        return view('errors.404');
    }
}
