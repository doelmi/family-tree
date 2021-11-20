<?php

namespace App\Http\Controllers;

use App\Person;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $contentTitle = 'Dasbor';
        $countUsers = User::all()->count();
        $countPeople = Person::all()->count();
        return view('content.bfr-dashboard', compact('contentTitle', 'countUsers', 'countPeople'));
    }
}
