<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
            {{ __('Books') }}
        </h2>

        <button class="inline-block ml-10 bg-green-600 text-white font-semibold px-5 py-2 rounded-sm" type="submit" form="book-form">
            Save
        </button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post" action="{{ route('books.store') }}" class="w-1/2" id="book-form">
                    @csrf
                    @method('post')

                    <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-1">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $book->title)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="col-span-1">
                            <x-input-label for="year" :value="__('Year')" />
                            <x-text-input id="year" name="year" type="text" class="mt-1 block w-full" :value="old('year', $book->year)" required autofocus autocomplete="year" />
                            <x-input-error class="mt-2" :messages="$errors->get('year')" />
                        </div>

                        <div class="col-span-1">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select name="category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        <div class="col-span-1">
                            <x-input-label for="author_id" :value="__('Author')" />
                            <select name="author_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('author_id')" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>