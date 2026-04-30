<x-guest-layout>
    <!-- Session Status (succès ou erreur de déconnexion par exemple) -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <div class="ow-hidden">
        <!-- Bandeau décoratif supérieur -->
        <div class="bg-indigo-600 py-4 text-center">
            <h2 class="text-2xl font-bold text-white">Bienvenue</h2>
            <p class="text-indigo-100 text-sm">Connectez-vous à votre compte</p>
        </div>

        <div class="p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Champ Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2 text-indigo-500"></i> Adresse email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('email') border-red-500 @enderror">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-600" />
                </div>

                <!-- Champ Mot de passe -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2 text-indigo-500"></i> Mot de passe
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="pl-10 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm @error('password') border-red-500 @enderror">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-600" />
                </div>

                <!-- Se souvenir de moi -->
                <div class="flex items-center justify-between mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600">
                            <i class="fas fa-check-circle text-indigo-400 mr-1"></i> Se souvenir de moi
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-800 transition">
                        <i class="fas fa-key mr-1"></i> Mot de passe oublié ?
                    </a>
                    @endif
                </div>

                <!-- Bouton de connexion -->
                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 rounded-lg shadow-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
                </button>
            </form>

            <!-- Lien d'inscription (optionnel, à activer si besoin) -->
            @if (Route::has('register'))
            <div class="mt-6 text-center text-sm text-gray-600">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                    <i class="fas fa-user-plus mr-1"></i> Créer un compte
                </a>
            </div>
            @endif
        </div>
    </div>

</x-guest-layout>
