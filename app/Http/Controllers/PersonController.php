<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contentTitle = 'Orang';
        return view('content.bfr-people-list', compact('contentTitle'));
    }

    public function show($id)
    {
        $contentTitle = 'Orang';
        return view('content.bfr-people-list', compact('contentTitle'));
    }

    public function search(Request $request)
    {
        $query = $request->input('term', '');
        if(strlen($query) < 3) {
            return response()->json([]);
        }
        $people = Person::where('name', 'LIKE', "%$query%")->get(['id', 'name as text']);
        return response()->json(['results' => $people]);
    }
}
