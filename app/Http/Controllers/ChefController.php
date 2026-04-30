<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DepartmentReport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChefController extends Controller
{
    // Dashboard du chef (formulaire de pointage + bouton soumettre)
    public function dashboard()
    {
        $chef = Auth::user();
        $department = $chef->department;
        $today = now()->toDateString();

        // Vérifie si le chef a déjà soumis le rapport pour aujourd'hui
        $alreadySubmitted = DepartmentReport::where('department_id', $department->id)
            ->whereDate('submitted_at', $today)
            ->exists();

        // Liste des utilisateurs du département (rôle 'user')
        $users = User::where('department_id', $department->id)
            ->where('role', 'user')
            ->get();

        // Pointages déjà enregistrés aujourd'hui pour ces utilisateurs
        $pointagesAujourdhui = Attendance::whereIn('user_id', $users->pluck('id'))
            ->whereDate('date', $today)
            ->get()
            ->keyBy('user_id');

        return view('chef.dashboard', compact('department', 'alreadySubmitted', 'users', 'pointagesAujourdhui'));
    }

    // Enregistrer les pointages (sans soumettre)
    public function storePointage(Request $request)
    {
        $chef = Auth::user();
        $department = $chef->department;
        $today = now()->toDateString();

        // Vérifier si déjà soumis aujourd'hui
        $alreadySubmitted = DepartmentReport::where('department_id', $department->id)
            ->whereDate('submitted_at', $today)
            ->exists();

        if ($alreadySubmitted) {
            return back()->with('error', 'Vous avez déjà soumis le rapport du jour. Modification impossible.');
        }

        $request->validate([
            'status' => 'required|array',
            'status.*' => 'in:present,absent,retard',
        ]);

        foreach ($request->status as $userId => $status) {
            Attendance::updateOrCreate(
                ['user_id' => $userId, 'date' => $today],
                ['status' => $status, 'chef_id' => $chef->id]
            );
        }

        return redirect()->route('chef.dashboard')->with('success', 'Pointages enregistrés. N\'oubliez pas de soumettre le rapport !');
    }

    // Soumission définitive du rapport du jour
    public function submitReport()
    {
        $chef = Auth::user();
        $department = $chef->department;
        $today = now()->toDateString();

        // Vérifier qu'au moins un pointage a été fait pour aujourd'hui
        $usersIds = User::where('department_id', $department->id)->where('role', 'user')->pluck('id');
        $hasPointages = Attendance::whereIn('user_id', $usersIds)->whereDate('date', $today)->exists();

        if (!$hasPointages) {
            return back()->with('error', 'Vous devez d\'abord enregistrer les pointages avant de soumettre.');
        }

        // Créer ou mettre à jour le rapport
        DepartmentReport::updateOrCreate(
            ['department_id' => $department->id, 'date' => $today],
            ['chef_id' => $chef->id, 'submitted_at' => now()]
        );

        return redirect()->route('chef.dashboard')->with('success', 'Rapport soumis avec succès !');
    }
}