<x-guest-layout>
    <div class="mb-6 text-sm text-muted">
        Vérifiez votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer. Vous ne l'avez pas reçu ? Demandez-en un nouveau.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert-success">
            Un nouveau lien de vérification vient d'être envoyé à votre adresse e-mail.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    Renvoyer l'e-mail de vérification
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="text-sm link">
                Se déconnecter
            </button>
        </form>
    </div>
</x-guest-layout>
