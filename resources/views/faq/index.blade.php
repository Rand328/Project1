<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('FAQ') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8" x-data="{ openCategory: null, openQuestion: null }">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Create Category Button -->
            @can('admin')
                <div>
                    <form action="{{ route('faq.createCategory') }}" method="get">
                        @csrf
                        <button type="submit" class="bg-violet-700 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                            Create New Category
                        </button>
                    </form>
                </div>
            @endcan

            <!-- FAQ Categories -->
            @foreach ($categories as $category)
                <div class="border bg-slate-700 rounded-md p-4">
                    <button class="collapsible font-bold text-gray-300 text-lg mb-2 focus:outline-none"
                            @click="openCategory === {{ $category->id }} ? openCategory = null : openCategory = {{ $category->id }}"
                            :class="{ 'active': openCategory === {{ $category->id }} }"
                            aria-haspopup="true">
                        {{ $category->name }}
                        <span x-text="openCategory === {{ $category->id }} ? '▲' : '▼'" class="float-right"></span>
                    </button>

                    <!-- + Button for Creating a New Question -->
                    <button class="bg-rose-500 hover:bg-rose-400 text-white font-bold py-0.5 px-2 rounded float-right"
                            @click="window.location.href='{{ route('faq.createQuestion', ['categoryId' => $category->id]) }}'">
                        +
                    </button>

                    <div x-show="openCategory === {{ $category->id }}" class="content">
                        <!-- FAQ Questions -->
                        @foreach ($category->faqs as $faq)
                            <div class="border bg-slate-900 rounded-md p-2 mb-2">
                                <button class="collapsible font-medium text-violet-400 hover:text-violet-500 focus:outline-none"
                                        @click="openQuestion === {{ $faq->id }} ? openQuestion = null : openQuestion = {{ $faq->id }}"
                                        :class="{ 'active': openQuestion === {{ $faq->id }} }"
                                        aria-haspopup="true">
                                    {{ $faq->question }}
                                </button>

                                <div x-show="openQuestion === {{ $faq->id }}" class="content text-gray-200 px-2 py-1" role="menuitem">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>