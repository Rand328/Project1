<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Flowers Blog') }}
        </h2>
    </x-slot>

    <!-- Display Create Post button -->
    <div class="flex justify-end">
        @auth
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('posts.create') }}" class="btn bg-blue-500 hover:bg-blue-700 text-lg text-white font-bold py-4 px-8 rounded-2xl mx-6 my-2">Create Post</a>
            @endif
        @endauth
    </div>

    <!-- Pop-up Message if a post is posted successfully -->
    @if ($message = Session::get('success'))
        <div id="success-message" class="top-40 justify-center left-5 m-4 text-purple-300 px-4 py-2 rounded-md">
            <p>{{ $message }}</p>
        </div>
        <script>
            // JavaScript to close the pop-up after 2 seconds
            setTimeout(function(){
                document.getElementById('success-message').style.display = 'none';
            }, 2000);
        </script>
    @endif

    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="mx-auto bg-gray-400 mt-8 p-1 rounded-lg w-full md:w-1/2 lg:w-4/7">
                <div class="col-12 bg-slate-500 p-4 rounded-md shadow-md">
                    <h4 class="text-3xl text-white font-bold text-center mb-3 bg-slate-700 py-2 rounded-md">{{ $post->title }}</h4>

                    <div class="flex justify-center bg-slate-700 mb-3 p-3 rounded-md">
                    @if ($post->image)
                        <img class="mx-auto my-4 max-w-full h-auto rounded-md max-h-64" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                    @endif

                    </div>

                    <p class="text-base text-white mb-2 bg-slate-700 p-4 rounded-md leading-6 overflow-hidden">{!! nl2br(e($post->description)) !!}</p>

                    <p class="text-sm text-gray-300 mb-3">Created at {{ $post->created_at->format('Y-m-d H:i:s') }}</p>

                    <div class="flex justify-center mt-4">
                        @auth
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded-2xl m-1">Edit</a>

                                <!-- Delete Confirmation Pop-up -->
                                <button class="btn bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-2xl m-1" onclick="confirmDelete({{ $post->id }})">Remove</button>
                                <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="post" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                                <script>
                                    function confirmDelete(postId) {
                                        var result = window.confirm("Are you sure you want to delete this post?");
                                        if (result) {
                                            event.preventDefault();
                                            document.getElementById('delete-form-' + postId).submit();
                                        }
                                    }
                                </script>
                            @endif
                            <a href="#" onclick="event.preventDefault(); document.getElementById('save-post-form').submit();" class="btn bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-2xl m-1">Save</a>
                            <form id="save-post-form" action="{{ route('posts.save', $post->id) }}" method="post" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                    </div>
                    
                </div>
            </div>
        @endforeach
    @else
        <p class="p-3 text-purple-200 text-sm">No Posts found</p>
    @endif

</x-app-layout>
