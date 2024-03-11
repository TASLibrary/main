<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('dimension.list')}}" class="text-blue-300 hover:text-blue-400">Dimensions</a> / Delete Dimension
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Delete Dimension
        </h2>
    </x-slot>

    <div class="py-6">
        <x-alert-danger>
            <p class="text-red-800">
                Are you sure you want to delete '{{$dimension->name}}'? This action cannot be undone.
            </p>
        </x-alert-danger>

        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{route('dimension.delete', $dimension->id)}}">
            @csrf
                <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-right mt-5">
                    <x-tas-secondary-button-link  href="{{route('dimension.list')}}">
                        Cancel
                    </x-tas-secondary-button-link>
                    <x-tas-button type="submit">
                        Delete Dimension
                    </x-tas-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
