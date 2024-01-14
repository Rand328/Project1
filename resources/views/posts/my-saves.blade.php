<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Saved Posts') }}
        </h2>
    </x-slot>

    @if (!is_null($savedPosts) && count($savedPosts) > 0)
        @foreach ($savedPosts as $savedPost)
            <div class="mx-auto bg-gray-400 bg-transparent-75 mt-8 p-1 rounded-lg w-full md:w-1/2 lg:w-4/7">
                <div class="col-12 bg-slate-500 bg-transparent-75 p-4 rounded-md shadow-md">
                    <h4 class="text-3xl text-white font-bold text-center mb-3 bg-slate-700 py-2 rounded-md">{{ $savedPost->title }}</h4>

                    <div class="flex justify-center bg-slate-700 mb-3 p-3 rounded-md">
                        @if ($savedPost->image)
                            <img class="mx-auto my-4 max-w-full h-auto rounded-md max-h-64" src="{{ asset('storage/' . $savedPost->image) }}" alt="{{ $savedPost->title }}">
                        @endif
                    </div>

                    <p class="text-base text-white mb-2 bg-slate-700 p-4 rounded-md leading-6 overflow-hidden">{!! nl2br(e($savedPost->description)) !!}</p>

                    <p class="text-sm text-gray-300 mb-3">Saved at {{ $savedPost->pivot->created_at->format('Y-m-d H:i:s') }}</p>

                    <div class="flex justify-center mt-4">
                        @auth
                            <button class="btn bg-red-700 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-2xl m-1" onclick="confirmRemoveSavedPost({{ $savedPost->id }})">Remove</button>
                            <form id="remove-saved-post-form-{{ $savedPost->id }}" action="{{ route('posts.remove', $savedPost->id) }}" method="post" style="display: none;">
                                @csrf
                                @method('delete')
                            </form>
                            <script>
                                function confirmRemoveSavedPost(postId) {
                                    var result = window.confirm("Are you sure you want to remove this saved post?");
                                    if (result) {
                                        event.preventDefault();
                                        document.getElementById('remove-saved-post-form-' + postId).submit();
                                    }
                                }
                            </script>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="p-3 text-purple-200 text-sm">No saved posts found. Save posts to keep them here.</p>
    @endif
</x-app-layout>
