<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
    public function getHomePage()
    {
        $username = Auth::check() ? Auth::user()->username : null;
        return view('page.homepage', compact('username'));
    }
}
