<x-guest-layout>
    <div>
        <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Bandeau supérieur -->
            <div class="bg-indigo-600 py-4 text-center">
                <h2 class="text-2xl font-bold text-white">Vérifiez votre email</h2>
                <p class="text-indigo-100 text-sm">Activez votre compte</p>
            </div>

            <div class="p-8">
                <!-- Message d'information -->
                <div class="mb-4 text-sm text-gray-600 bg-blue-50 p-3 rounded-lg">
                    <i class="fas fa-envelope-open-text text-indigo-500 mr-2"></i>
                    {{ __('Merci pour votre inscription ! Avant de commencer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.') }}
                </div>

                <!-- Message de succès quand un nouveau lien a été envoyé -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-3 rounded-lg">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse que vous avez fournie.') }}
                    </div>
                @endif

                <div class="mt-6 space-y-4">
                    <!-- Formulaire renvoyer l'email -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full flex justify-center items-center py-2 px-4 rounded-lg shadow-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                            <i class="fas fa-redo-alt mr-2"></i> Renvoyer l'email de vérification
                        </button>
                    </form>

                    <!-- Formulaire de déconnexion -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex justify-center items-center py-2 px-4 rounded-lg border border-gray-300 shadow-sm text-gray-700 bg-white hover:bg-gray-50 transition">
                            <i class="fas fa-sign-out-alt mr-2"></i> Se déconnecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>