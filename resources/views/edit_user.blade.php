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
<style>
    /* Style pour le formulaire */
form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

/* Style pour les étiquettes */
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

/* Style pour les champs de saisie */
input[type="text"],
input[type="email"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box; /* Pour inclure le padding et le border dans la largeur */
}

/* Style pour le bouton */
button[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}
</style>