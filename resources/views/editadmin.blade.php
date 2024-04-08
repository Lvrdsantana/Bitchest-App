<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil administrateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-gray-100">

<div class="container mx-auto py-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Modifier le profil administrateur</h2>
        <form action="{{ route('admin.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nom</label>
                <input type="text" id="name" name="name" class="w-full border-gray-300 rounded-md p-2" value="{{ isset($admin) ? $admin->name : '' }}" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full border-gray-300 rounded-md p-2" value="{{ isset($admin) ? $admin->email : '' }}" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Mot de passe</label>
                <input type="password" id="password" name="password" class="w-full border-gray-300 rounded-md p-2" placeholder="Nouveau mot de passe">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Confirmation du mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border-gray-300 rounded-md p-2" placeholder="Confirmez le mot de passe">
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
