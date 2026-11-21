@foreach (['success', 'ok', 'status'] as $key)
    @if (session($key) && ! in_array(session($key), ['verification-link-sent', 'profile-updated', 'password-updated'], true))
        <div class="alert-success" role="status">{{ session($key) }}</div>
    @endif
@endforeach
@if (session('error'))
    <div class="alert-error" role="alert">{{ session('error') }}</div>
@endif
@if ($errors->any())
    <div class="alert-error" role="alert">
        <p class="font-medium">Le formulaire contient des erreurs :</p>
        <ul class="mt-1 list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
