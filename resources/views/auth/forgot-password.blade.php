<x-guest-layout>
    <div>
        <div class="max-w-md w-full rounded-2xl shadow-xl overflow-hidden">
            <!-- Bandeau supérieur -->
            <div class="bg-indigo-600 py-4 text-center">
                <h2 class="text-2xl font-bold text-white">Mot de passe oublié ?</h2>
                <p class="text-indigo-100 text-sm">Réinitialisez votre mot de passe</p>
            </div>

            <div class="p-8">
                <!-- Texte d'explication -->
                <div class="mb-6 text-sm text-gray-600 bg-gray-50 p-4 rounded-lg flex items-start">
                    <i class="fas fa-info-circle text-indigo-500 mr-3 mt-0.5"></i>
                    <span>{{ __('Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.') }}</span>
                </div>

                <!-- Session Status (succès) -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2 text-indigo-500"></i> Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                   class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('email') border-red-500 @enderror">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800 transition">
                            <i class="fas fa-arrow-left mr-1"></i> Retour à la connexion
                        </a>

                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-200 flex items-center">
                            <i class="fas fa-paper-plane mr-2"></i> Envoyer le lien
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>