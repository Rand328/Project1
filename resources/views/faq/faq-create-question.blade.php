<!-- resources/views/faq/faq-create-question.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Question') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="border bg-slate-700 rounded-md p-4">
                <form action="{{ route('faq.saveQuestion', ['categoryId' => $categoryId]) }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="question" class="text-gray-300 block">Question:</label>
                        <input type="text" id="question" name="question" class="rounded-md p-2 w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="answer" class="text-gray-300 block">Answer:</label>
                        <textarea id="answer" name="answer" class="rounded-md p-2 w-full" required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Question
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
