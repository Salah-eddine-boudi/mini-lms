<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('apprenant.dashboard');
    }
}