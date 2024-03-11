<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-5xl">Library</h1>
    </x-slot>
    <div class="py-2">
        <livewire:search-block :dimensions="$dimensions" :usecases="$usecases"></livewire:search-block>
    </div>
</x-app-layout>
