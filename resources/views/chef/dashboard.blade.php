<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fas fa-clipboard-list text-indigo-500 mr-2"></i>
                {{ __('Pointage du département : ') . $department->name }}
            </h2>
            @if(!$alreadySubmitted)
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                    <i class="fas fa-hourglass-half mr-1"></i> En attente de soumission
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1"></i> Rapport soumis
                </span>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                <div class="p-6 bg-white">
                    <!-- Messages flash -->
                    @if(session('success'))
                        <div class="mb-6 rounded-md bg-green-50 p-4 border-l-4 border-green-400">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-400 mr-3 text-lg"></i>
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-6 rounded-md bg-red-50 p-4 border-l-4 border-red-400">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-400 mr-3 text-lg"></i>
                                <p class="text-sm text-red-700">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    @if($alreadySubmitted)
                        <div class="rounded-md bg-blue-50 p-4 border border-blue-200">
                            <div class="flex">
                                <i class="fas fa-info-circle text-blue-400 mr-3 text-lg"></i>
                                <div class="text-sm text-blue-700">
                                    Vous avez déjà soumis le rapport pour aujourd'hui ({{ now()->toDateString() }}).<br>
                                    Vous ne pouvez plus modifier les pointages. Merci.
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Formulaire de pointage -->
                        <form method="POST" action="{{ route('chef.storePointage') }}">
                            @csrf
                            <div class="overflow-x-auto rounded-lg border border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-user mr-1"></i> Utilisateur
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-tag mr-1"></i> Statut
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($users as $user)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <i class="fas fa-user-circle text-gray-400 mr-2"></i> {{ $user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <select name="status[{{ $user->id }}]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                                    <option value="present" {{ ($pointagesAujourdhui[$user->id]->status ?? '') == 'present' ? 'selected' : '' }}>
                                                        <i class="fas fa-check-circle mr-1"></i> Présent
                                                    </option>
                                                    <option value="absent" {{ ($pointagesAujourdhui[$user->id]->status ?? '') == 'absent' ? 'selected' : '' }}>
                                                        <i class="fas fa-times-circle mr-1"></i> Absent
                                                    </option>
                                                    <option value="retard" {{ ($pointagesAujourdhui[$user->id]->status ?? '') == 'retard' ? 'selected' : '' }}>
                                                        <i class="fas fa-clock mr-1"></i> Retard
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6 flex flex-col sm:flex-row justify-end gap-4">
                                <button type="submit" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                    <i class="fas fa-save mr-2"></i> Enregistrer les pointages
                                </button>
                                <button type="button" onclick="if(confirm('Soumission définitive : après cela, vous ne pourrez plus modifier les pointages du jour. Confirmer ?')) document.getElementById('submitForm').submit();" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                                    <i class="fas fa-paper-plane mr-2"></i> Soumettre le rapport (final)
                                </button>
                            </div>
                        </form>

                        <form id="submitForm" method="POST" action="{{ route('chef.submit') }}" class="hidden">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>