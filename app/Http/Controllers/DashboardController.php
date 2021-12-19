<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function getHome(Request $request) {

        return view('Dashboard.pages.student.home');
    }
}
