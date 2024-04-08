<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.0.2/tailwind.min.css'>

</head>

<body>
    <!-- partial:index.partial.html -->

    <body class="bg-gray-100 h-screen antialiased leading-none">
        <div id="app" class="h-full">
            <div class="flex flex-col h-full">

                <div class="flex h-full">

                    <div class="w-0 md:w-64 p-0 md:p-4 bg-gray-200 overflow-hidden">
                        <div class="flex items-center mb-4">
                            <h3 class="text-xl font-bold mr-2">Dashboard</h3>
                            <p class="px-2 py-1 text-xs text-white bg-gray-800 rounded-full">Owners</p>
                        </div>
                        <nav>
                            <ul>
                                <li class="font-bold py-2 hover:underline">
                                    <a href="/dashboard/chefs" class="">
                                        Chefs
                                    </a>
                                </li>
                                <li class="font-bold py-2 hover:underline">
                                    <a href="{{ route('editadmin') }}" class="">
                                        profil
                                    </a>
                                </li>
                                <li class="font-bold py-2 hover:underline">
                                    <a href="/dashboard/sets" class="text-green-400">Sets</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="flex-1 w-full">

                        <nav class="bg-blue-900 shadow py-6">
                            <div class="px-6">
                                <div class="flex items-center justify-center">
                                    <div class="mr-6">
                                        <a href="http://localhost:8000" class="text-lg font-semibold text-gray-100 mr-3">
                                            Laravel
                                        </a>
                                        <a href="/admin/users" class="text-lg text-gray-100 hover:underline">
                                            Dashboard Admin
                                        </a>
                                    </div>
                                    <div class="flex-1 text-right">
                                        <a class="text-white" href="/">Back to website</a>
                                        <span class="text-gray-300 text-sm pr-4"></span>

                                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hover:underline text-gray-300 text-sm p-3">>Disconnect</a>
                                        <<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                            @csrf
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </nav>

                        <div class="p-4">

                            <div class="flex items-center mb-6">
                                <h1 class="text-xl font-bold mr-4">Your sets</h1>
                                <!-- Link to create a new user -->
                                <a href="#" id="createUserLink" class="bg-green-400 rounded py-2 px-4 text-white">Create new user</a>

                                <!-- Form for creating a new user (initially hidden) -->
                                <form id="createUserForm" action="{{ route('createUser') }}" method="POST" style="display: none;">
                                    @csrf
                                    <label for="name">User Name:</label>
                                    <input type="text" name="name" id="name" required>

                                    <label for="email">User Email:</label>
                                    <input type="email" name="email" id="email" required>

                                    <button type="submit">Create User</button>
                                    <button type="button" id="cancelCreateUser">Cancel</button> <!-- Button to cancel -->
                                </form>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Target the "Create new user" link
                                        const createUserLink = document.getElementById('createUserLink');

                                        // Target the form for creating a new user
                                        const createUserForm = document.getElementById('createUserForm');

                                        // Add an event listener for click on the link
                                        createUserLink.addEventListener('click', function(event) {
                                            event.preventDefault(); // Prevent the default behavior of the link

                                            // Display or hide the form depending on its current state
                                            if (createUserForm.style.display === 'none') {
                                                createUserForm.style.display = 'block';
                                            } else {
                                                createUserForm.style.display = 'none';
                                            }
                                        });

                                        // Target the "Cancel" button
                                        const cancelCreateUserButton = document.getElementById('cancelCreateUser');

                                        // Add an event listener for click on the "Cancel" button
                                        cancelCreateUserButton.addEventListener('click', function(event) {
                                            event.preventDefault(); // Prevent the default behavior of the button

                                            // Hide the form when "Cancel" button is clicked
                                            createUserForm.style.display = 'none';
                                        });
                                    });
                                </script>

                            </div>

                            <div class="block w-full overflow-x-auto">
                                <table class="w-full text-left shadow-md bg-white rounded-lg">
                                    <thead>
                                        <tr>
                                            <th class="py-4 px-6 bg-gray-800 font-bold uppercase text-sm text-gray-100 border-r border-white">
                                                Type
                                            </th>
                                            <th class="py-4 px-6 bg-gray-800 font-bold uppercase text-sm text-gray-100 border-r border-white">
                                                Name
                                            </th>
                                            <th class="py-4 px-6 bg-gray-800 font-bold uppercase text-sm text-gray-100 border-r border-white">
                                                Email
                                            </th>
                                            <th class="py-4 px-6 bg-gray-800 font-bold uppercase text-sm text-gray-100 border-r border-white">
                                                Temporary Password
                                            </th>
                                            <th class="py-4 px-6 bg-gray-800 font-bold uppercase text-sm text-gray-100">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($users)
                                        @foreach($users as $user)
                                        <tr class="hover:bg-gray-300">
                                            <td class="py-4 px-6 border-b border-gray-200">
                                                <svg class="fill-current w-4" viewBox="0 0 20 20">
                                                    <path d="M5 5a5 5 0 0 1 10 0v2A5 5 0 0 1 5 7V5zM0 16.68A19.9 19.9 0 0 1 10 14c3.64 0 7.06.97 10 2.68V20H0v-3.32z" />
                                                </svg>
                                            </td>
                                            <td class="py-4 px-6 border-b border-gray-200">
                                                {{ $user->name }}
                                            </td>
                                            <td class="py-4 px-6 border-b border-gray-200">
                                                {{ $user->email }}
                                            </td>
                                            <td class="py-4 px-6 border-b border-gray-200">
                                                {{ $user->temporary_password }}
                                            </td>
                                            <td class="py-4 px-6 border-b border-gray-200">
                                                <div class="flex items-center">
                                                    <a href="{{ route('adminedit', ['user' => $user->id]) }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                                                    <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete</button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </body>
    <!-- partial -->
</body>

</html>