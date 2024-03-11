<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            Dimensions
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Dimensions
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="w-48 mx-auto">
            <x-tas-button-link href="{{route('dimension.create')}}">
                Create New Dimension
            </x-tas-button-link>
        </div>
        <div class="mt-5">
            @if (session('status'))
                <x-alert-info>
                    {{session('status')}}
                </x-alert-info>
            @endif
            <table class="table-auto border-collapse border slate-400 w-full">
                <thead>
                <tr class="bg-slate-100 text-gray-700">
                    <th class="border border-slate-300 py-3">Name</th>
                    <th class="border border-slate-300 py-3">Question</th>
                    <th class="border border-slate-300 py-3">Actions</th>
                </tr>
                </thead>
                <tbody class="border">
                @foreach($dimensions as $dimension)
                    <tr class="text-center text-gray-500 hover:bg-gray-50">
                        <td class="border border-slate-300 py-2">
                            {{$dimension->name}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            {{$dimension->question}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            <x-tas-button-link href="{{route('characteristic.list', [$dimension->id])}}">
                                Characteristics
                            </x-tas-button-link>
                            <x-tas-button-link href="{{route('user_input.list', [$dimension->id])}}">
                                User Inputs
                            </x-tas-button-link>
                            <x-button-link-warning href="{{route('dimension.update', [$dimension->id])}}">
                                Update
                            </x-button-link-warning>
                            <x-button-link-danger href="{{route('dimension.delete', [$dimension->id])}}">
                                Delete
                            </x-button-link-danger>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{$dimensions->links()}}
        </div>
    </div>
</x-app-layout>
