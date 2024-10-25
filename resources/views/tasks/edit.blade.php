<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8 mt-16">
        <h1 class="text-gray text-4xl mb-4">Task Form</h1>
        <form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mb-5">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter the task title" value="{{ old('title', $task->title) }}">
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Description of your task">{{ old('description', $task->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mb-5">
                <label for="priority" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Priority</label>
                <input type="text" id="priority" name="priority" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Priority of the task- Low, Medium or high" value="{{ old('priority', $task->priority) }}">
                <x-input-error :messages="$errors->get('priority')" class="mt-2" />
            </div>
            <div class="mb-2">
                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Due Date</label>
                <input type="text" id="date" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Enter the date of task completion in format YYYY-MM-DD" value="{{ old('date', $task->date) }}">
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>
            <div class="mb-2">
                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">You are changing the current image</label>
                <img src="/images/{{ $task->image }}" width="100px">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="default_size">Upload Image</label>
                <input class="block w-full mb-5 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 text-gray-400 focus:outline-none dark:bg-gray-700 border-gray-600 placeholder-gray-400" id="image" type="file" name="image">
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
            <x-primary-button class="mt-4">Save</x-primary-button>
            <a class="ml-4" href="{{ route('tasks.index') }}">Cancel</a>
        </form>
    </div>
</x-app-layout>