<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 mt-16">
        <h1 class="text-gray text-4xl mb-4">Task Form</h1>
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="mb-5">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter the task title" value="{{ old('title') }}">
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Description of your task">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mb-5">
                <label for="priority" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Priority</label>
                <input type="text" id="priority" name="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Priority of the task- Low, Medium or high" value="{{ old('priority') }}">
                <x-input-error :messages="$errors->get('priority')" class="mt-2" />
            </div>
            <div class="mb-2">
                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Due Date</label>
                <input type="text" id="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter the date of task completion in format YYYY-MM-DD" value="{{ old('date') }}">
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>
            <x-primary-button class="mt-4">Save</x-primary-button>
        </form>
    </div>

    <h1 class="ml-16 mr-16 text-gray mt-16 text-4xl">Task List</h1>
    <div class="relative overflow-x-auto ml-16 mr-16 mt-4 pb-16">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Priority
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Due Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action (Edit/Delete)
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $task->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $task->description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $task->priority }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $task->date }}
                    </td>
                    <td class="px-6 py-4">
                        <small class="text-sm text-gray-600">{{ Carbon\Carbon::parse($task->created_at)->format('j M Y, g:i a') }}</small>
                        @unless (Carbon\Carbon::parse($task->created_at)->eq(Carbon\Carbon::parse($task->updated_at)))
                            <small class="text-sm text-gray-600"> &middot; edited </small>
                        @endunless
                    </td>
                    <td class="px-6 py-4">
                        @if ($task->user->is(auth()->user()))
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('tasks.edit', $task)">
                                        Edit
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                                        @csrf
                                        @method('delete')
                                        <x-dropdown-link :href="route('tasks.destroy', $task)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            Delete
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
</x-app-layout>
