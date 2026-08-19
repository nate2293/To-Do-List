<x-layouts::app>

    {{-- Breadcrumb --}}
    <x-ui::breadcrumb :crumbs="[
        'Tasks' => route('tasks.index'),
        'Edit' => route('tasks.edit', $task),
    ]" class="mb-3" />

    <x-ui::card>

        {{--  Heading --}}
        <x-ui::header class="font-bold mt-2 mb-4">
            <x-ui::heading level="2">Task Details</x-ui::heading>
        </x-ui::header>

        {{-- form --}}
        <form action="{{ route('tasks.update', $task) }}" method="POST" class="mb-6">
            @csrf
            @method('PUT')

            <div class="rounded-lg border border-gray-300 p-4 mb-6 ">

                <x-ui::form.input-group class="mb-6" name="title" label="Title" :value="old('title', $task->title)" />

                <x-ui::form.textarea-group class="mb-6" name="description" label="Description" :value="old('description', $task->description)" />

                <x-ui::form.toggle-group class="mb-6" name="completed" label="Completed" type="checkbox"
                    :checked="old('completed', $task->completed)" />

            </div>

            {{--  Button --}}
            <div class="flex justify-start mb-4">
                <x-ui::button type="submit" icon="edit" variant="oblue">
                    Update
                </x-ui::button>

            </div>

        </form>

    </x-ui::card>




</x-layouts::app>
