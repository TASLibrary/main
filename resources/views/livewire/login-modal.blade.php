<div x-data>
    <a id="loginModalBtn" wire:click="showModal" wire:loading.attr="disabled" href="#" class="m-1 rounded-full border border-purple-700 text-sm px-2 py-2 text-purple-700">
        Login
    </a>

    <x-modal maxWidth="md" class="flex items-center" id="loginModal" wire:model="showingModal">
        <form wire:submit.prevent="login">
            @csrf
            <div class="px-6 py-4">
                <div class="text-lg font-medium text-gray-900">
                    Login
                </div>
                <div class="mt-4 text-sm text-gray-600">
                    @if (session('status'))
                        <x-alert-info>
                            <p class="text-sky-800">
                                {{ session('status') }}
                            </p>
                        </x-alert-info>
                    @endif
                    <div>
                        <x-label for="username" value="{{ __('Username') }}" />
                        <x-input id="username" wire:model="username" class="block mt-1 w-full" type="text" name="username" placeholder="Enter your username" :value="old('username')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" wire:model="password" class="block mt-1 w-full" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{route('register')}}" wire:click.prevent="switchToRegister">
                            Not registered?
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
                <x-tas-button>
                    Login
                </x-tas-button>
                <x-tas-secondary-button class="ml-2" wire:click.prevent="hideModal" wire:loading.attr="disabled">
                    Cancel
                </x-tas-secondary-button>
            </div>
        </form>
    </x-modal>
</div>
