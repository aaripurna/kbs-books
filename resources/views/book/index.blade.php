<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
            {{ __('Book') }}
        </h2>

        <a href="{{ route('books.create') }}" class="inline-block ml-10 bg-green-600 text-white font-semibold px-5 py-2 rounded-sm">
            Add New
        </a>
    </x-slot>

    <div class="py-12" x-data="{ selectedPath: 0 }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <th scope="col" class="w-3/12 text-left py-3 px-6">
                            <div class="flex justify-between">
                                <p>Title</p>
                                @if(request()->get("dir") == "desc")
                                <a href="{{ route('books.index', ['dir' => 'asc']) }}">
                                    <img width="15px" src="{{ Vite::asset('resources/images/caret-down-fill.svg') }}">
                                </a>
                                @else
                                <a href="{{ route('books.index', ['dir' => 'desc']) }}">
                                    <img width="15px" src="{{ Vite::asset('resources/images/caret-up-fill.svg') }}">
                                </a>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="w-3/12 text-left py-3 px-6">Year</th>
                        <th scope="col" class="w-2/12  text-left py-3 px-6">Category</th>
                        <th scope="col" class="w-2/12  text-left py-3 px-6">Author</th>
                        <th scope="col" class="w-3/12  px-6 text-center">Action</th>
                    </thead>
                    <tbody class="bg-white border-b ">
                        @foreach($books as $item)
                        <tr">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item->title}}</td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item->year}}</td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item->category->name}}</td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">{{$item->author->name}}</td>
                            <td class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                <a href="{{route('books.edit', ['book' => $item])}}">Edit</a>
                                |
                                <a href="{{route('books.show', ['book' => $item])}}">View</a>
                                |
                                <button type="button"
                                    class="text-red-500"
                                    x-on:click="selectedPath = `{{ route('books.destroy', ['book' => $item]) }}`; $dispatch('open-modal', 'confirm-book-deletion')">Delete</button>

                            </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>

                {{ $books->links() }}
            </div>

            <x-modal name="confirm-book-deletion" focusable>
                <form method="post" class="p-6" x-bind:action="selectedPath">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Are you sure you want to delete this book?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Once your account is book, all of its resources and data will be permanently deleted') }}
                    </p>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('Delete Book') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>