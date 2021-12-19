<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome(Request $request) {

        $books= Book::orderBy('title')->paginate(10);
        $count= Book::orderBy('title')->count();
        
        return view('Home.home-catalog')->with('books',$books)->with('count',$count);
    }
}
