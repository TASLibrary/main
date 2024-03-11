<div>
    <a wire:click.prevent="showModal" wire:loading.attr="disabled" href="#" class="m-1 rounded-full border border-purple-700 text-sm px-2 py-2 text-purple-700">
        Contact Us
    </a>

    <x-modal maxWidth="md" class="flex items-center" id="contactUsModal" wire:model="showingModal">
        <form wire:submit.prevent="send">
            @csrf
            <div class="px-6 py-4">
                <div class="text-lg font-medium text-gray-900">
                    Contact Us
                </div>
                <div class="mt-4 text-sm text-gray-600">
                    @if (session('status'))
                    <x-alert-info>
                        <p class="text-sky-800">
                            {{ session('status') }}
                        </p>
                    </x-alert-info>
                    @endif
                    @if ($errors->any())
                        <x-alert-danger>
                            <ul class="text-red-800">
                                @foreach ($errors->all() as $error)
                                    <li class="mt-1">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </x-alert-danger>
                    @endif
                    @if(!$sent)
                    <div>
                        <x-label for="name" value="Name" />
                        <x-input id="name" wire:model="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>
                    <div class="mt-4">
                        <x-label for="email" value="Email" />
                        <x-input id="email" wire:model="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" autofocus autocomplete="email" />
                    </div>
                    <div class="mt-4">
                        <x-label for="message" value="Message" />
                        <textarea id="message" wire:model="message" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="message">{{old('message')}}</textarea>
                    </div>
                    @endif
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
                @if(!$sent)
                <x-tas-button>
                    Send
                </x-tas-button>
                <x-tas-secondary-button class="ml-2" wire:click.prevent="hideModal" wire:loading.attr="disabled">
                    Cancel
                </x-tas-secondary-button>
                @else
                <x-tas-secondary-button-link href="#" class="ml-2" wire:click.prevent="hideModal" wire:loading.attr="disabled">
                    Close
                </x-tas-secondary-button-link>
                @endif

            </div>
        </form>
    </x-modal>
</div>
