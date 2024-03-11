<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('dimension.list')}}" class="text-blue-300 hover:text-blue-400">Dimensions</a> /
            <a href="{{route('user_input.list', [$dimension->id])}}" class="text-blue-300 hover:text-blue-400">User Inputs of '{{ $dimension->name }}' </a> /
            Create New User Input for '{{$dimension->name }}'
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Create New User Input for '{{$dimension->name }}'
        </h2>
    </x-slot>

    <div class="py-6">
        @if ($errors->any())
            <x-alert-danger>
                <ul class="text-red-800">
                    @foreach ($errors->all() as $error)
                        <li class="mt-1">{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert-danger>
        @endif
        <form method="post" action="{{route('user_input.create', [$dimension->id])}}">
            @csrf
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <x-label for="name" value="Name" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autofocus />
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-right mt-5">
                <x-tas-secondary-button-link href="{{route('user_input.list', [$dimension->id])}}">
                    View User Inputs
                </x-tas-secondary-button-link>
                <x-tas-button type="submit">
                    Create User Input
                </x-tas-button>
            </div>
        </form>
    </div>
</x-app-layout>
