<div>
    <a wire:click="showModal" wire:loading.attr="disabled" href="#" class="m-1 rounded-full border border-purple-700 text-sm px-2 py-2 text-purple-700">
        {{ __('Register') }}
    </a>
    <x-modal maxWidth="md" class="flex items-center" wire:model="showingModal" >
        <div class="px-6 py-4">
            <div class="text-lg font-medium text-gray-900">
                Register
            </div>
        </div>
        @if($registration_completed)
            <div class="px-6 text-sm">
                <x-alert-info>
                    Registration was successful. To confirm your email address, please follow the instructions in the email that you will receive shortly.
                </x-alert-info>
            </div>
            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
                <x-tas-secondary-button wire:click="hideModal" wire:loading.attr="disabled" class="ml-4">
                    Close
                </x-tas-secondary-button>
            </div>
            @else
        <form wire:submit.prevent="register">
            @csrf
            <div class="px-6">
                @if ($errors->any())
                    <x-alert-danger>
                        <ul class="text-red-800">
                            @foreach ($errors->all() as $error)
                                <li class="mt-1">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-alert-danger>
                @endif
                <div class="mt-4 text-sm text-gray-600">
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" wire:model="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Enter your name" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <x-label for="username" value="{{ __('Username') }}" />
                        <x-input id="username" wire:model="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" placeholder="Enter your affiliation" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" wire:model="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Enter your work email address" required autocomplete="email" />
                    </div>

                    <div class="mt-4">
                        <x-label for="affiliation" value="{{ __('Affiliation') }}" />
                        <x-input id="affiliation" wire:model="affiliation" class="block mt-1 w-full" type="text" name="affiliation" :value="old('affiliation')" placeholder="Enter a one-word ID" required autocomplete="affiliation" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" wire:model="password" class="block mt-1 w-full" type="password" name="password" placeholder="Enter a password, at least 8 characters" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" wire:model="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password" />
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
                    @endif
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:click.prevent="switchToLogin">
                            Already registered?
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
                <x-tas-button>
                    Register
                </x-tas-button>
                <x-tas-secondary-button wire:click.prevent="hideModal" wire:loading.attr="disabled" class="ml-4">
                    Cancel
                </x-tas-secondary-button>
            </div>
        </form>
        @endif
    </x-modal>
</div>
