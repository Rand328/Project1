<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden p-5 shadow-xl sm:rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">All Users</h2>

                <ul>
                    @foreach($users as $user)
                        <li class="mb-2">
                            {{ $user->name }} - Role: {{ $user->role }}

                            <form action="{{ route('admin.updateRole', $user->id) }}" method="post" class="inline">
                                @csrf
                                @method('patch')
                                <select name="role" class="mr-2">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>user</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Update Role</button>
                            </form>
                        </li>
                    @endforeach
                </ul>

                <h2 class="text-2xl font-semibold mt-4">Create New Admin</h2>
                <form action="{{ route('admin.createUser') }}" method="post">
                    @csrf
                    <label for="name">Name:</label>
                    <input type="text" name="name" required>
                    <!-- Add other form fields as needed -->
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">Create User</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
