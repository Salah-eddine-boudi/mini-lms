<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Formation;
use App\Models\Quiz;
use App\Models\Chapitre;
use App\Models\Note;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'formations' => Formation::count(),
            'apprenants' => User::where('role', 'apprenant')->count(),
            'quiz' => Quiz::count(),
            'chapitres' => Chapitre::count(),
        ];

        $dernierApprenants = User::where('role', 'apprenant')
            ->latest()
            ->take(5)
            ->get();

        $dernieresNotes = Note::with('user', 'formation')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'dernierApprenants', 'dernieresNotes'));
    }
}