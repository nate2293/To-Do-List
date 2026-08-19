<x-ui::modal name="{{ 'task-' . $task->id }}" focusable>
    <x-slot:title>
        Delete Task
    </x-slot:title>

    <p>
        Are you sure you want to delete
        <x-ui::chip variant="sky">
            '{{ $task->title }}'
        </x-ui::chip>?
        This action cannot be undone.
    </p>

    <x-slot:footer>
        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <x-ui::button type="submit" variant="red">Delete</x-ui::button>
        </form>
    </x-slot:footer>
</x-ui::modal>
