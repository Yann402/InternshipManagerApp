@php $s = $service ?? null; @endphp
<div class="grid gap-x-4 sm:grid-cols-2">
    <div class="field sm:col-span-2">
        <label for="nom_service" class="label">Nom du service</label>
        <input id="nom_service" type="text" name="nom_service" value="{{ old('nom_service', $s?->nom_service) }}" class="input" required>
        @error('nom_service') <p class="error">{{ $message }}</p> @enderror
    </div>
    <div class="field">
        <label for="division_id" class="label">Division</label>
        <select id="division_id" name="division_id" class="input" required>
            <option value="">Choisir une division</option>
            @foreach($divisions as $d)
                <option value="{{ $d->id }}" @selected(old('division_id', $s?->division_id ?? request('division_id')) == $d->id)>{{ $d->nom_division }}</option>
            @endforeach
        </select>
    </div>
    <div class="field">
        <label for="responsable_id" class="label">Responsable <span class="font-normal text-muted">(facultatif)</span></label>
        <select id="responsable_id" name="responsable_id" class="input">
            <option value="">Aucun</option>
            @foreach($responsables as $u)
                <option value="{{ $u->id }}" @selected(old('responsable_id', $s?->responsable_id) == $u->id)>{{ $u->nom }} {{ $u->prenom }}</option>
            @endforeach
        </select>
    </div>
</div>
