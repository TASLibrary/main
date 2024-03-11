<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2">
                <div class="grid">
                    <x-tas-button-link href="{{route('dimension.list')}}">
                       Dimensions
                    </x-tas-button-link>
                </div>
                <div class="grid">
                    <x-tas-button-link href="{{route('usecase.list')}}">
                        Usecases
                    </x-tas-button-link>
                </div>
            </div>
        </div>
        @if(auth()->user()->hasRole('Administrator'))
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2">
                    <div class="grid">
                        <x-tas-button-link href="{{route('user.list')}}">
                            Users
                        </x-tas-button-link>
                    </div>
                    <div class="grid">
                        <x-tas-button-link href="{{route('evaluation.list')}}">
                            Evaluations
                        </x-tas-button-link>
                    </div>
                </div>
            </div>
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2">
                    <div class="grid">
                        <x-tas-button-link href="{{route('message.list')}}">
                            Messages
                        </x-tas-button-link>
                    </div>
                    <div class="grid">
                        <x-tas-button-link href="{{route('issue.list')}}">
                            Issues
                        </x-tas-button-link>
                    </div>
                </div>
            </div>
        @endif
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2">
                    <div class="grid">
                        <x-tas-button-link href="{{route('setting.list')}}">
                            Settings
                        </x-tas-button-link>
                    </div>
                    <div class="grid">
                    </div>
                </div>
            </div>

    </div>
</x-app-layout>
