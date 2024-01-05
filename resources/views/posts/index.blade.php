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

    <!-- Display Create Post button -->
    <div class="fixed bottom-4 right-4">
        <button onclick="window.location='{{ route('posts.create') }}'" class="btn btn-primary bg-blue-600 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">
            Create Post
        </button>
    </div>



    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="mx-auto bg-lightGray mt-8 p-6 rounded-lg w-full md:w-1/2 lg:w-1/3">
                <div class="col-12">
                    <h4 class="text-3xl text-white font-bold text-center">{{$post->title}}</h4>
                    <p class="text-base text-center text-white mb-3">{{$post->description}}</p>
                    <div class="row">
                        <div class="col-12">
                            <img class="mx-auto my-4 max-w-full" style="max-width:100%;" src="{{ asset('images/'.$post->image)}}" alt="">
                        </div>
                    </div>

                    <div class="flex justify-center mt-4">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 m-1 rounded">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-primary bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 m-1 rounded">Remove</button>
                        </form>
                    </div>

                    <hr>
                </div>
            </div>
        @endforeach
    @else
        <p>No Posts found</p>
    @endif
</x-app-layout>
