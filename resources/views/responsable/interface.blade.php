<h1>Bienvenue Responsable</h1>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Déconnexion</button>
</form>