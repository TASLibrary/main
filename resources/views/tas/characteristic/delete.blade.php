<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('dimension.list')}}" class="text-blue-300 hover:text-blue-400">Dimensions</a> /
            <a href="{{route('characteristic.list', [$characteristic->dimension_id])}}" class="text-blue-300 hover:text-blue-400">Characteristics of '{{ $characteristic->dimension->name }}' </a> /
            Delete Characteristic
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Delete Characteristic
        </h2>
    </x-slot>

    <div class="py-6">
        <x-alert-danger>
            <p class="text-red-800">
                Are you sure you want to delete '{{$characteristic->name}}'? This action cannot be undone.
            </p>
        </x-alert-danger>

        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{route('characteristic.delete', $characteristic->id)}}">
                @csrf
                <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-right mt-5">
                    <x-tas-secondary-button-link  href="{{route('characteristic.list', $characteristic->dimension_id)}}">
                        Cancel
                    </x-tas-secondary-button-link>
                    <x-tas-button type="submit">
                        Delete Characteristic
                    </x-tas-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
