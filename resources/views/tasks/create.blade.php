<x-layouts::app>

    <x-ui::breadcrumb :crumbs="[
        'Tasks' => route('tasks.index'),
        'Create' => route('tasks.create'),
    ]" />

    <x-ui::card>

        <x-ui::heading level="3" class="mt-5 mb-5">
            <b>Create Task</b>
        </x-ui::heading>

        <form action="{{ route('tasks.store') }}" method="POST">

            @csrf

            <div>

                <x-ui::form.input-group class="mb-5" name="title" label="Title" :value="old('title')" />

                <x-ui::form.textarea-group class="mb-5" name="description" label="Description" :value="old('description')" />

                <x-ui::form.datetime name="concluded_at" label="Completed On" value="{{ now()->format('Y-m-d H:i:s') }}"
                    class="w-64 mb-5" />

                <x-ui::form.toggle-group class="mb-5" name="completed" label="Completed"
                    description="Mark this task as completed." :checked="old('completed', false)" />

                <x-ui::button class="mb-5" type="submit" variant="oblue">
                    Create Task
                </x-ui::button>

            </div>

        </form>

    </x-ui::card>

</x-layouts::app>
