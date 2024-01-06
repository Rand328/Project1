<!-- resources/views/faq/edit-category.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="border bg-slate-700 rounded-md p-4">
                <form action="{{ route('faq.updateCategory', ['id' => $category->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-4">
                        <label for="categoryName" class="text-gray-300 block">Category Name:</label>
                        <input type="text" id="categoryName" name="categoryName" class="rounded-md p-2 w-full" value="{{ $category->name }}" required>
                    </div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
