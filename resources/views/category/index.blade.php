<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Category List</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your product categories</p>
                        </div>
                        <div class="flex gap-2">
                            @can('manage-category')
                                <x-add-product :url="route('category.create')" :name="'Category'" />
                            @endcan
                        </div>
                    </div>

                    {{-- Flash Message --}}
                    @if (session('success'))
                        <div
                            class="mb-4 px-4 py-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Table --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider w-8">
                                        #</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nama Category</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Total Product</th>
                                    @can('manage-category')
                                    <th
                                        class="px-6 py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Actions</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($categories as $category)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-100">
                                        <td class="px-6 py-4 text-gray-400 dark:text-gray-500">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-800 dark:text-gray-100">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ $category->products_count > 0 ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300' : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400' }}">
                                                {{ $category->products_count }} product{{ $category->products_count != 1 ? 's' : '' }}
                                            </span>
                                        </td>
                                        @can('manage-category')
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <x-edit-button :url="route('category.edit', $category->id)" />
                                                <x-delete-button :action="route('category.delete', $category->id)" />
                                            </div>
                                        </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-6 py-12 text-center text-gray-400 dark:text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="h-10 w-10 mx-auto mb-3 opacity-40" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                      d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            No categories found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
