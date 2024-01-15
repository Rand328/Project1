<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden p-5 shadow-xl sm:rounded-lg">
                <h2 class="text-2xl font-semibold mb-4 text-slate-300">All Users</h2>

                <ul class="text-slate-200 mx-1">
                    @foreach($users as $user)
                        <li class="mb-2">
                            {{ $user->name }} - Role: {{ $user->role }}

                            <form action="{{ route('admin.updateRole', $user->id) }}" method="post" class="inline text-slate-800 font-semibold mx-2">
                                @csrf
                                @method('patch')
                                <select name="role" class="mr-2 rounded-md">
                                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>user</option>
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                                </select>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-md mx-1">Update Role</button>
                            </form>
                        </li>
                    @endforeach
                </ul>

                <h2 class="text-2xl font-semibold mt-6 mb-2 text-slate-300">Create New Admin</h2><form action="{{ route('admin.createUser') }}" method="post">
                <form action="{{ route('admin.createUser') }}" method="post">
                    @csrf
                    <label for="name" class="text-slate-200 mx-1">Name:</label>
                    <input type="text" name="name" class="rounded-md mx-6 m-1" required>
                    <br/>
                    <label for="email" class="text-slate-200 mx-1">E-mail:</label>
                    <input type="text" name="email" class="rounded-md mx-6 m-1" required>
                    <br/>
                    <label for="password" class="text-slate-200 mx-1">Password:</label>
                    <input type="password" name="pawword" class="rounded-md m-1" required>
                    <br/>
                    
                    <button type="submit" class="bg-teal-700 hover:bg-teal-900 text-white font-bold py-1 px-2 rounded-md mt-3">Create User</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
