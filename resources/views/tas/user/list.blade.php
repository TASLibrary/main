<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            Users
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Users
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mt-5">
            @if (session('status'))
                <x-alert-info>
                    {{session('status')}}
                </x-alert-info>
            @endif
            <table class="table-fixed border-collapse border slate-400 w-full">
                <thead>
                <tr class="bg-slate-100 text-gray-700">
                    <th class="border border-slate-300 py-3">Username</th>
                    <th class="border border-slate-300 py-3">Email</th>
                    <th class="border border-slate-300 py-3">Rating</th>
                    <th class="border border-slate-300 py-3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="text-center text-gray-500 hover:bg-gray-50">
                        <td class="border border-slate-300 py-2">
                            {{$user->username}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            {{$user->email}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            {{$user->rating}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            <x-tas-button-link href="{{route('user.read', [$user->id])}}">View</x-tas-button-link>
                            <x-button-link-warning href="{{route('user.update', [$user->id])}}">Update</x-button-link-warning>
                            @if($user->active)
                                <x-button-link-danger href="{{route('user.ban', [$user->id])}}">Ban</x-button-link-danger>
                            @else
                                <x-button-link-info href="{{route('user.activate', [$user->id])}}">Activate</x-button-link-info>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{$users->links()}}
        </div>
    </div>
</x-app-layout>
