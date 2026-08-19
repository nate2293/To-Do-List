<x-layouts::app.sidebar :title="$title ?? null">
    <x-ui::flash position="top-right" timeout="6000" />

    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts::app.sidebar>
