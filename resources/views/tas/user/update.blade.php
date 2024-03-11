<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('user.list')}}" class="text-blue-300 hover:text-blue-400">Users</a> / Update User
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Update User
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
        <form method="post" action="{{route('user.update', [$user->id])}}">
        @csrf
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <x-label for="name" value="Name" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" autofocus />
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="email" value="Email" />
                <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email', $user->email)" autofocus />
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="affiliation" value="Affiliation" />
                <x-input id="affiliation" class="block mt-1 w-full" type="text" name="affiliation" :value="old('affiliation', $user->affiliation)" autofocus />
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="role" value="Role" />
                <select name="role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                    @foreach(\App\Enum\UserRole::cases() as $user_role)
                        <option value="{{$user_role->value}}" {{$user->role == $user_role->value ? 'selected' : ''}}>{{\App\Enum\UserRole::getName($user_role)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-right mt-5">
                <x-tas-secondary-button-link href="{{route('user.list')}}">
                    View Users
                </x-tas-secondary-button-link>
                <x-tas-button type="submit">
                    Update User
                </x-tas-button>
            </div>
        </form>
    </div>
</x-app-layout>
