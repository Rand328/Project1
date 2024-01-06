<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mini post list') }}
        </h2>
    </x-slot>

    <!-- Message if a post is posted successfully -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="mx-auto bg-lightGray mt-8 p-6 rounded-lg w-full md:w-1/2 lg:w-1/3">
                <div class="col-12 bg-gray-800 p-4 rounded-md shadow-md">
                    <div class="flex justify-center">
                        <img class="mx-auto my-4 max-w-full h-auto rounded-md" src="{{ asset('images/'.$post->image) }}" alt="">
                    </div>

                    <h4 class="text-3xl text-white font-bold text-center mb-3">{{ $post->title }}</h4>
                    <p class="text-base text-white mb-3">{{ $post->description }}</p>

                    <div class="flex justify-center mt-4">
                        @auth
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-2xl m-1">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-2xl m-1">Remove</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No Posts found</p>
    @endif

    <!-- Display Create Post button -->
    <div class="flex justify-end">
        @auth
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('posts.create') }}" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-2xl m-4">Create Post</a>
            @endif
        @endauth
    </div>
</x-app-layout>
