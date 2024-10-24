<x-app-layout>
    <div class="">
        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
        </form>
    </div>
</x-app-layout>
