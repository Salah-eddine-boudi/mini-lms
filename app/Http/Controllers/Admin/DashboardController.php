<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'formations' => 0, 
            'apprenants' => User::where('role', 'apprenant')->count(),
            'quiz' => 0,       
        ];

        return view('admin.dashboard', compact('stats'));
    }
}