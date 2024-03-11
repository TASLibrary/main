<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('user.list')}}" class="text-blue-300 hover:text-blue-400">Users</a> / User Details
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            User Details
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="columns-1">
            <div class="columns-1">
                <div class="columns-1 text-purple-600">
                    Name
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$user->name}}
                </div>
            </div>
            <div class="columns-1 mt-4">
                <div class="columns-1 text-purple-600">
                    Username
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$user->username}}
                </div>
            </div>
            <div class="columns-1 mt-4">
                <div class="columns-1 text-purple-600">
                    Email
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$user->email}}
                </div>
            </div>
        </div>

        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Affiliation
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$user->affiliation}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Date Registered
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$user->created_at}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Role
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{\App\Enum\UserRole::getName(\App\Enum\UserRole::from($user->role))}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4 mb-3 text-center">
            <x-tas-secondary-button-link href="{{route('user.list')}}">View Users</x-tas-secondary-button-link>
            <x-button-link-warning href="{{route('user.update', [$user->id])}}">Update</x-button-link-warning>
            @if($user->active)
                <x-button-link-danger href="{{route('user.ban', [$user->id])}}">Ban</x-button-link-danger>
            @else
                <x-button-link-info href="{{route('user.activate', [$user->id])}}">Activate</x-button-link-info>
            @endif
        </div>
    </div>
</x-app-layout>
