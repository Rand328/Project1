<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add post') }}
        </h2>
    </x-slot>

    <section class="mt-3">
        <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
            <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger text-red-700 p-2">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-slate-700 p-8 rounded-md mx-auto max-w-2xl">
                    <label for="title" class="text-gray-200 block text-xl p-1">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="rounded-md p-2 w-full">

                    <label for="description" class="text-gray-200 block text-xl p-1 mt-4">Description</label>
                    <textarea name="description" class="rounded-md p-2 w-full" cols="30" rows="10">{{ old('description') }}</textarea>

                    <label for="image" class="text-gray-200 block text-xl p-1 mt-4">Add Image</label>
                    <img src="{{ asset('storage/' . $image) }}" alt="" class="img-blog mb-4">
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>

                <button class="bg-purple-600 hover:bg-purple-500 text-white font-bold py-2 px-8 rounded my-8 mx-auto block">
                    Save
                </button>
            </form>
        </div>
    </section>
</x-app-layout>
