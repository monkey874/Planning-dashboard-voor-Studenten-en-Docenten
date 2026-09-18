<x-layouts::app :title="__('Dashboard')">
    <livewire:planning
        :projection="$projection"
        :result="$result"
        :Times="$Times"
        :crud-right="$crudRight"></livewire:planning>
</x-layouts::app>