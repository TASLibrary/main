<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('dimension.list')}}" class="text-blue-300 hover:text-blue-400">Dimensions</a> / User Inputs of '{{ $dimension->name }}'
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            User Inputs of '{{ $dimension->name }}'
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-auto text-center">
            <x-tas-secondary-button-link href="{{route('dimension.list')}}">
                View Dimensions
            </x-tas-secondary-button-link>
            <x-tas-button-link href="{{route('user_input.create', [$dimension->id])}}">
                Create New User Input
            </x-tas-button-link>
        </div>
        <div class="mt-5">
            @if (session('status'))
                <x-alert-info>
                    {{session('status')}}
                </x-alert-info>
            @endif
            <table class="table-fixed border-collapse border slate-400 w-full">
                <thead>
                <tr class="bg-slate-100 text-gray-700">
                    <th class="border border-slate-300 py-3">Name</th>
                    <th class="border border-slate-300 py-3">Actions</th>
                </tr>
                </thead>
                <tbody class="border">
                @foreach($user_inputs as $user_input)
                    <tr class="text-center text-gray-500 hover:bg-gray-50">
                        <td class="border border-slate-300 py-2">
                            {{$user_input->name}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            <x-button-link-warning href="{{route('user_input.update', [$user_input->id])}}">
                                Update
                            </x-button-link-warning>
                            <x-button-link-danger href="{{route('user_input.delete', [$user_input->id])}}">
                                Delete
                            </x-button-link-danger>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{$user_inputs->links()}}
        </div>
    </div>
</x-app-layout>

