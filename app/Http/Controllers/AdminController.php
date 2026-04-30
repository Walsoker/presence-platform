<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DepartmentReport;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard admin : voir combien de chefs ont soumis aujourd'hui
    public function dashboard()
    {
        $today = now()->toDateString();
        $submissionsToday = DepartmentReport::whereDate('submitted_at', $today)->count();
        $totalChefs = User::where('role', 'chef')->count();

        return view('admin.dashboard', compact('submissionsToday', 'totalChefs'));
    }

    // Liste de tous les absents et retards
    public function absencesRetards()
    {
        $absencesRetards = Attendance::whereIn('status', ['absent', 'retard'])
            ->with(['user', 'chef'])
            ->orderBy('date', 'desc')
            ->get();

        return view('admin.absences', compact('absencesRetards'));
    }

    // Historique des soumissions des chefs
    public function reports()
    {
        $reports = DepartmentReport::with(['department', 'chef'])
            ->orderBy('date', 'desc')
            ->get();

        return view('admin.reports', compact('reports'));
    }
}