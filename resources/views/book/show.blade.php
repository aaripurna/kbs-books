<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
            {{ __('Book') }}
        </h2>

        <a href="{{ route('books.edit', ['book' => $book]) }}" class="inline-block ml-10 bg-green-600 text-white font-semibold px-5 py-2 rounded-sm">
            Edit
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <x-input-label for="title" :value="__('Title')" />
                        <p>{{ $book->title }}</p>
                    </div>

                    <div class="col-span-1">
                        <x-input-label for="year" :value="__('Year')" />
                        <p>{{ $book->year }}</p>
                    </div>

                    <div class="col-span-1">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <p>{{ $book->category->name }}</p>
                    </div>

                    <div class="col-span-1">
                        <x-input-label for="author_id" :value="__('Author')" />
                        <p>{{ $book->author->name }}</p>
                    </div>
                </div>

                <div class="mt-10">
                    <x-danger-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-book-delete')">{{ __('Delete') }}</x-danger-button>

                    <x-modal name="confirm-book-delete" focusable>
                        <form method="post" class="p-6" action="{{ route('books.destroy', ['book' => $book]) }}">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to delete this author?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Once your account is author, all of its resources and data will be permanently deleted') }}
                            </p>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    {{ __('Delete Author') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>