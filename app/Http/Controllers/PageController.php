<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard');
    }

    public function login()
    {
        return view('pages.auth.login');
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function vehicle()
    {
        return view('pages.vehicles.index');
    }

    public function reservation()
    {
        return view('pages.reservations.index');
    }

    public function log()
    {
        return view('pages.logs.index');
    }

    public function notFound()
    {
        return view('pages.notfound');
    }
}
