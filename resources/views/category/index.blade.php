<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
            {{ __('Categories') }}
        </h2>

        <a href="{{ route('categories.create') }}" class="inline-block ml-10 bg-green-600 text-white font-semibold px-5 py-2 rounded-sm">
            Add New
        </a>
    </x-slot>

    <div class="py-12" x-data="{ selectedPath: 0 }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <th scope="col" class="w-3/5 text-left py-3 px-6">Name</th>
                        <th scope="col" class="py-3 px-6 text-center">Action</th>
                    </thead>
                    <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        @foreach($categories as $item)
                        <tr">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->name}}</td>
                            <td class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{route('categories.edit', ['category' => $item])}}">Edit</a>
                                |
                                <button type="button"
                                    class="text-red-500"
                                    x-on:click="selectedPath = `{{ route('categories.destroy', ['category' => $item]) }}`; $dispatch('open-modal', 'confirm-category-deletion')">Delete</button>

                            </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>

                {{ $categories->links() }}
            </div>

            <x-modal name="confirm-category-deletion" focusable>
                <form method="post" class="p-6" x-bind:action="selectedPath">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Are you sure you want to delete this category?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Once your account is category, all of its resources and data will be permanently deleted') }}
                    </p>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('Delete Category') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>