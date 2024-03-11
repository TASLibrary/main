<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('dimension.list')}}" class="text-blue-300 hover:text-blue-400">Dimensions</a> /
            <a href="{{route('user_input.list', [$user_input->dimension_id])}}" class="text-blue-300 hover:text-blue-400">User Inputs of '{{ $user_input->dimension->name }}' </a> /
            Delete User Input
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Delete User Input
        </h2>
    </x-slot>

    <div class="py-6">
        <x-alert-danger>
            <p class="text-red-800">
                Are you sure you want to delete '{{$user_input->name}}'? This action cannot be undone.
            </p>
        </x-alert-danger>

        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{route('user_input.delete', $user_input->id)}}">
                @csrf
                <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-right mt-5">
                    <x-tas-secondary-button-link  href="{{route('user_input.list', $user_input->dimension_id)}}">
                        Cancel
                    </x-tas-secondary-button-link>
                    <x-tas-button type="submit">
                        Delete User Input
                    </x-tas-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

