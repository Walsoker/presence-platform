<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-history text-indigo-500 mr-2"></i>
                {{ __('Mon historique de pointage') }}
            </h2>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                <i class="fas fa-user-circle mr-1"></i> {{ Auth::user()->name }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Carte récapitulative rapide -->
            @if(!$attendances->isEmpty())
                @php
                    $totalPresent = $attendances->where('status', 'present')->count();
                    $totalAbsent = $attendances->where('status', 'absent')->count();
                    $totalLate = $attendances->where('status', 'retard')->count();
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 uppercase">Présent</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $totalPresent }}</p>
                                </div>
                                <div class="p-2 bg-green-100 rounded-full">
                                    <i class="fas fa-check-circle text-green-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 uppercase">Absent</p>
                                    <p class="text-2xl font-bold text-red-600">{{ $totalAbsent }}</p>
                                </div>
                                <div class="p-2 bg-red-100 rounded-full">
                                    <i class="fas fa-times-circle text-red-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                        <div class="p-5">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 uppercase">Retard</p>
                                    <p class="text-2xl font-bold text-yellow-600">{{ $totalLate }}</p>
                                </div>
                                <div class="p-2 bg-yellow-100 rounded-full">
                                    <i class="fas fa-clock text-yellow-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tableau des pointages -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-list-ul text-indigo-500 mr-2"></i> Détail des pointages
                    </h3>
                    @if($attendances->isEmpty())
                        <div class="text-center py-8">
                            <i class="fas fa-folder-open text-gray-300 text-5xl mb-3"></i>
                            <p class="text-gray-500">Aucun pointage enregistré pour vous.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <i class="fas fa-calendar-alt mr-1"></i> Date
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <i class="fas fa-tag mr-1"></i> Statut
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <i class="fas fa-user-check mr-1"></i> Pointé par
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($attendances as $attendance)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <i class="far fa-calendar-alt text-indigo-400 mr-2"></i> {{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($attendance->status === 'present')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <i class="fas fa-check-circle mr-1 text-green-500"></i> Présent
                                                    </span>
                                                @elseif($attendance->status === 'absent')
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <i class="fas fa-times-circle mr-1 text-red-500"></i> Absent
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <i class="fas fa-clock mr-1 text-yellow-500"></i> Retard
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                <i class="fas fa-user-tie text-indigo-400 mr-1"></i> {{ $attendance->chef->name ?? 'N/A' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>