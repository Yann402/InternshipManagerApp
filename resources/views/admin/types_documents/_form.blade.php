@php $t = $types_document ?? null; @endphp
<div class="field">
    <label for="libelle" class="label">Nom du document</label>
    <input id="libelle" type="text" name="libelle" value="{{ old('libelle', $t?->libelle) }}" class="input" placeholder="Ex. : Convention de stage">
    @error('libelle') <p class="error">{{ $message }}</p> @enderror
</div>
<div class="grid gap-x-4 sm:grid-cols-2">
    <div class="field">
        <label for="fourni_par" class="label">Fourni par</label>
        <select id="fourni_par" name="fourni_par" class="input">
            <option value="stagiaire" @selected(old('fourni_par', $t?->fourni_par) === 'stagiaire')>Le stagiaire</option>
            <option value="responsable" @selected(old('fourni_par', $t?->fourni_par) === 'responsable')>Le service</option>
        </select>
        @error('fourni_par') <p class="error">{{ $message }}</p> @enderror
    </div>
    @if(! $t)
        <div class="field">
            <label for="type_fichier" class="label">Format attendu</label>
            <select id="type_fichier" name="type_fichier" class="input">
                <option value="pdf" @selected(old('type_fichier') === 'pdf')>PDF</option>
                <option value="image" @selected(old('type_fichier') === 'image')>Image (jpg, jpeg, png)</option>
            </select>
            @error('type_fichier') <p class="error">{{ $message }}</p> @enderror
        </div>
    @endif
</div>
<label class="mb-6 inline-flex items-center gap-2 text-sm">
    <input type="checkbox" name="obligatoire" value="1" class="rounded border-line text-pine-700 focus:ring-pine-600" {{ old('obligatoire', $t?->obligatoire) ? 'checked' : '' }}>
    Document obligatoire
</label>
