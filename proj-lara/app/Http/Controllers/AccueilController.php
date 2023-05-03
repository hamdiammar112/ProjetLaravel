<?php

namespace App\Http\Controllers;


class AccueilController extends Controller
{
    public function getDashboard()
    {
        $title = "Dashboard";


        return view('/dashboard', compact('title'));
    }
}
