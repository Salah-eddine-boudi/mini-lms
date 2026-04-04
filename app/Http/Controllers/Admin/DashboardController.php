<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Formation;
use App\Models\Quiz;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'formations' => Formation::count(),
            'apprenants' => User::where('role', 'apprenant')->count(),
            'quiz' => Quiz::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}