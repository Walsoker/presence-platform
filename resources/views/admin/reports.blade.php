<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-chart-line text-indigo-500 mr-2"></i>
                {{ __('Historique des soumissions des chefs') }}
            </h2>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                <i class="fas fa-file-alt mr-1"></i> Total : {{ $reports->count() }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Carte récapitulative (par département) -->
            @php
                $departmentsStats = [];
                foreach ($reports as $report) {
                    $deptName = $report->department->name;
                    if (!isset($departmentsStats[$deptName])) {
                        $departmentsStats[$deptName] = 0;
                    }
                    $departmentsStats[$deptName]++;
                }
            @endphp

            @if($reports->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($departmentsStats as $deptName => $count)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
                            <div class="p-5">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500 uppercase">Soumissions</p>
                                        <p class="text-2xl font-bold text-indigo-600">{{ $count }}</p>
                                        <p class="text-xs text-gray-400 mt-1">{{ $deptName }}</p>
                                    </div>
                                    <div class="p-3 bg-indigo-100 rounded-full">
                                        <i class="fas fa-building text-indigo-500 text-xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Tableau des soumissions -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-list-ul text-indigo-500 mr-2"></i> Liste des rapports soumis
                    </h3>

                    @if($reports->isEmpty())
                        <div class="text-center py-8">
                            <i class="fas fa-folder-open text-gray-300 text-5xl mb-3"></i>
                            <p class="text-gray-500">Aucune soumission enregistrée pour le moment.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <i class="fas fa-building mr-1"></i> Département
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <i class="fas fa-user-tie mr-1"></i> Chef
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <i class="fas fa-calendar-alt mr-1"></i> Date du rapport
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <i class="fas fa-clock mr-1"></i> Soumis le
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($reports as $report)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <i class="fas fa-building text-indigo-400 mr-2"></i> {{ $report->department->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                <i class="fas fa-user-tie text-indigo-400 mr-2"></i> {{ $report->chef->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                <i class="far fa-calendar-alt text-indigo-400 mr-1"></i> {{ \Carbon\Carbon::parse($report->date)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                <i class="far fa-clock text-indigo-400 mr-1"></i> {{ $report->submitted_at->format('d/m/Y H:i') }}
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