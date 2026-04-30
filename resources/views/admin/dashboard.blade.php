<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-tachometer-alt text-indigo-500 mr-2"></i>
                {{ __('Tableau de bord administrateur') }}
            </h2>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                <i class="fas fa-calendar-day mr-1"></i> {{ now()->format('d/m/Y') }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cartes statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Carte : Soumissions du jour -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Soumissions du jour</p>
                                <p class="text-3xl font-bold text-indigo-600 mt-2">{{ $submissionsToday }} <span class="text-gray-400 text-base font-normal">/ {{ $totalChefs }}</span></p>
                            </div>
                            <div class="p-3 bg-indigo-100 rounded-full">
                                <i class="fas fa-check-double text-indigo-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                @php $percent = $totalChefs > 0 ? ($submissionsToday / $totalChefs) * 100 : 0; @endphp
                                <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $percent }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte : Taux d'absentéisme (calcul simple) -->
                @php
                    // Exemple : tu peux affiner avec des données réelles
                    $totalAbsences = \App\Models\Attendance::where('status', 'absent')->count();
                    $totalRetards = \App\Models\Attendance::where('status', 'retard')->count();
                @endphp
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Absences / Retards</p>
                                <p class="text-3xl font-bold text-red-500 mt-2">{{ $totalAbsences }} <span class="text-gray-400 text-base font-normal">absences</span></p>
                                <p class="text-lg text-yellow-500 mt-1">{{ $totalRetards }} retards</p>
                            </div>
                            <div class="p-3 bg-red-100 rounded-full">
                                <i class="fas fa-user-slash text-red-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte : Total utilisateurs -->
                @php
                    $totalUsers = \App\Models\User::where('role', 'user')->count();
                @endphp
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Utilisateurs actifs</p>
                                <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalUsers }}</p>
                            </div>
                            <div class="p-3 bg-green-100 rounded-full">
                                <i class="fas fa-users text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions principales -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-cog text-indigo-500 mr-2"></i> Actions rapides
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="{{ route('admin.absences') }}" class="flex items-center justify-center p-4 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition border border-red-200">
                            <i class="fas fa-user-clock mr-2 text-lg"></i> Consulter les absences & retards
                        </a>
                        <a href="{{ route('admin.reports') }}" class="flex items-center justify-center p-4 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition border border-green-200">
                            <i class="fas fa-chart-line mr-2 text-lg"></i> Historique des soumissions
                        </a>
                        <!-- Tu peux ajouter d'autres actions ici -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>