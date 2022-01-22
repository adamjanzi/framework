<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    /**
     * Welcome!
     *
     * @return \Illuminate\View\View
     */
    public function view()
    {
        return view('welcome');
    }
}
