@php $e = $encadrant ?? null; @endphp
<div class="grid gap-x-4 sm:grid-cols-2">
    <div class="field"><label class="label" for="nom">Nom</label><input id="nom" type="text" name="nom" value="{{ old('nom', $e?->nom) }}" class="input" required></div>
    <div class="field"><label class="label" for="prenom">Prénom</label><input id="prenom" type="text" name="prenom" value="{{ old('prenom', $e?->prenom) }}" class="input" required></div>
    <div class="field"><label class="label" for="email">E-mail</label><input id="email" type="email" name="email" value="{{ old('email', $e?->email) }}" class="input"></div>
    <div class="field"><label class="label" for="telephone">Téléphone</label><input id="telephone" type="text" name="telephone" value="{{ old('telephone', $e?->telephone) }}" class="input"></div>
    <div class="field sm:col-span-2"><label class="label" for="specialite">Spécialité</label><input id="specialite" type="text" name="specialite" value="{{ old('specialite', $e?->specialite) }}" class="input"></div>
</div>
