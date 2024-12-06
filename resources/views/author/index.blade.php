<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
            {{ __('Authors') }}
        </h2>

        <a href="{{ route('authors.create') }}" class="inline-block ml-10 bg-green-600 text-white font-semibold px-5 py-2 rounded-sm">
            Add New
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <th scope="col" class="w-3/5 text-left py-3 px-6">Name</th>
                        <th scope="col" class="py-3 px-6 text-center">Action</th>
                    </thead>
                    <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        @foreach($users as $item)
                        <tr">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->name}}</td>
                            <td class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="{{route('authors.edit', ['author' => $item])}}">Edit</a>
                            </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>

                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>