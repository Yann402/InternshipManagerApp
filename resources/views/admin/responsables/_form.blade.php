@php $r = $responsable ?? null; @endphp
<div class="grid gap-x-4 sm:grid-cols-2">
    <div class="field"><label for="nom" class="label">Nom</label><input id="nom" type="text" name="nom" value="{{ old('nom', $r?->nom) }}" class="input"></div>
    <div class="field"><label for="prenom" class="label">Prénom</label><input id="prenom" type="text" name="prenom" value="{{ old('prenom', $r?->prenom) }}" class="input"></div>
    <div class="field sm:col-span-2"><label for="email" class="label">Adresse e-mail</label><input id="email" type="email" name="email" value="{{ old('email', $r?->email) }}" class="input"></div>
    <div class="field">
        <label for="password" class="label">{{ $r ? 'Nouveau mot de passe' : 'Mot de passe' }} @if($r)<span class="font-normal text-muted">(facultatif)</span>@endif</label>
        <input id="password" type="password" name="password" class="input">
        @if($r) <p class="hint">Laissez vide pour conserver le mot de passe actuel.</p> @endif
    </div>
    <div class="field"><label for="password_confirmation" class="label">Confirmation</label><input id="password_confirmation" type="password" name="password_confirmation" class="input"></div>
    <div class="field"><label for="poste" class="label">Poste</label><input id="poste" type="text" name="poste" value="{{ old('poste', $r?->poste) }}" class="input"></div>
    <div class="field"><label for="specialite" class="label">Spécialité</label><input id="specialite" type="text" name="specialite" value="{{ old('specialite', $r?->specialite) }}" class="input"></div>
    <div class="field sm:col-span-2">
        <label for="service_id" class="label">Service <span class="font-normal text-muted">(facultatif)</span></label>
        <select id="service_id" name="service_id" class="input">
            <option value="">Aucun</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}" @selected(old('service_id', $r?->service_id) == $service->id)>{{ $service->nom_service }}</option>
            @endforeach
        </select>
    </div>
</div>
