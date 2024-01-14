<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('FAQ') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8" x-data="{ openCategory: null, openQuestion: null }">
        <!-- Create Category Button -->
        @can('admin')
            <div class="mb-4">
                <form action="{{ route('faq.createCategory') }}" method="get">
                    @csrf
                    <button type="submit" class="bg-violet-700 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        Create New Category
                    </button>
                </form>
            </div>
        @endcan

        <!-- FAQ Categories -->
        <div class="grid grid-cols-1 gap-4">
            @foreach ($categories as $category)
                <div class="col-span-1">
                    <div class="border bg-slate-700 w-full min-w-max rounded-md p-4">
                        <button class="collapsible font-bold text-gray-300 text-lg mb-2 focus:outline-none"
                                @click="openCategory === {{ $category->id }} ? openCategory = null : openCategory = {{ $category->id }}"
                                :class="{ 'active': openCategory === {{ $category->id }} }"
                                aria-haspopup="true">
                            {{ $category->name }}
                            <span x-text="openCategory === {{ $category->id }} ? '▲' : '▼'" class="float-right"></span>
                        </button>

                        <!-- + Button for Creating a New Question -->
                        @can('admin')
                            <button class="bg-rose-500 hover:bg-rose-400 text-white font-bold py-0.5 px-2 rounded float-right ml-2"
                                    @click="window.location.href='{{ route('faq.createQuestion', ['categoryId' => $category->id]) }}'">
                                +
                            </button>
                            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-0.5 px-2 rounded float-right ml-2"
                                    @click="window.location.href='{{ route('faq.editCategory', ['id' => $category->id]) }}'">
                                Edit
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-0.5 px-2 rounded float-right ml-2"
                                    @click="if(confirm('Are you sure you want to delete this category?')) { document.getElementById('deleteCategoryForm{{ $category->id }}').submit(); }">
                                Delete
                            </button>
                        @endcan

                        <form id="deleteCategoryForm{{ $category->id }}" action="{{ route('faq.destroyCategory', ['id' => $category->id]) }}" method="post" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>

                        <div x-show="openCategory === {{ $category->id }}" class="content">
                            <!-- FAQ Questions -->
                            @foreach ($category->faqs as $faq)
                                <div class="border bg-slate-900 rounded-md p-2 mb-2 mt-4"> <!-- Increased mt-4 for more margin -->
                                    <button class="collapsible font-medium text-violet-400 hover:text-violet-500 focus:outline-none"
                                            @click="openQuestion === {{ $faq->id }} ? openQuestion = null : openQuestion = {{ $faq->id }}"
                                            :class="{ 'active': openQuestion === {{ $faq->id }} }"
                                            aria-haspopup="true">
                                        {{ $faq->question }}
                                    </button>

                                    <div x-show="openQuestion === {{ $faq->id }}" class="content text-gray-200 px-2 py-1" role="menuitem">
                                        <p>{{ $faq->answer }}</p>
                                    </div>

                                    @can('admin')
                                        <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-0.5 px-2 rounded float-right ml-2"
                                                @click="window.location.href='{{ route('faq.editQuestion', ['id' => $faq->id]) }}'">
                                            Edit
                                        </button>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-0.5 px-2 rounded float-right ml-2"
                                                @click="if(confirm('Are you sure you want to delete this question?')) { document.getElementById('deleteQuestionForm{{ $faq->id }}').submit(); }">
                                            Delete
                                        </button>
                                    @endcan

                                    <form id="deleteQuestionForm{{ $faq->id }}" action="{{ route('faq.destroyQuestion', ['id' => $faq->id]) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
