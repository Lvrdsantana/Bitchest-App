<form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Nom :</label>
    <input type="text" name="name" id="name" value="{{ $user->name }}" required>

    <label for="email">E-mail :</label>
    <input type="email" name="email" id="email" value="{{ $user->email }}" required>

    <button type="submit">Enregistrer les modifications</button>
</form>
<script>
    // Après soumission du formulaire, rediriger vers la page admin après un court délai
    document.getElementById('updateForm').addEventListener('submit', function(event) {
        // Empêcher la soumission du formulaire par défaut
        event.preventDefault();

        // Attendre 1 seconde avant de rediriger
        setTimeout(function() {
            window.location.href = "{{ route('admin') }}";
        }, 1000); // ajustez le délai selon vos besoins
    });
</script>