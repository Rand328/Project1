<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit post') }}
        </h2>
    </x-slot>
    <div class="container">
        <h1>Edit Post</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ $post->title }}" required>

            <label for="description">Description:</label>
            <textarea name="description" required>{{ $post->description }}</textarea>

            <!-- Add other fields as needed -->

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
</x-app-layout>
