<x-layouts::app>

    {{-- Breadcrumb --}}
    <x-ui::breadcrumb :crumbs="[
        'Tasks' => route('tasks.index'),
    ]" class="mb-3" />

    <x-ui::card>

        {{--  Heading --}}
        <x-ui::header class="font-bold mt-2 mb-4">
            <x-ui::heading level="2">Tasks</x-ui::heading>
        </x-ui::header>

        {{-- Card --}}
        <div class="grid grid-cols-2 gap-6">

            @foreach ($tasks as $task)
                <div class="rounded-lg border border-gray-300 p-4 mb-6 ">

                    <x-ui::display label="Title:" value="{{ $task->title }}" />

                    <x-ui::display label="Description:" value="{{ $task->description }}" />

                    <x-ui::display label="Status:">
                        @if ($task->completed)
                            <x-ui::chip variant="emerald" icon="check-circle">
                                Completed
                            </x-ui::chip>
                        @else
                            <x-ui::chip variant="slate">
                                Pending
                            </x-ui::chip>
                        @endif
                    </x-ui::display>

                    <x-ui::display label="Completed On:">
                        <x-ui::chip variant="blue">
                            {{ $task->concluded_at }}
                        </x-ui::chip>
                    </x-ui::display>

                    {{-- Edit and Delete --}}
                    <div class="mt-5 flex gap-4">

                        <x-ui::link href="{{ route('tasks.edit', $task) }}" icon="edit" variant="light">
                            Edit
                        </x-ui::link>

                        <x-ui::modal.trigger variant="ored" for="{{ 'task-' . $task->id }}">
                            Delete
                        </x-ui::modal.trigger>

                    </div>

                </div>

                @include('tasks.delete', ['task' => $task])
            @endforeach
        </div>

        {{-- Button for logging task --}}
        <x-ui::link href="{{ route('tasks.create') }}" variant="oblue" icon="plus">
            Create New Task
        </x-ui::link>

        <x-ui::paginator :items="$tasks" size="4" />

    </x-ui::card>

</x-layouts::app>
