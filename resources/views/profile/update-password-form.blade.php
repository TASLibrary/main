<div class="py-6">
    <form wire:submit.prevent="updatePassword">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <h4 class="text-lg font-bold">Update Password</h4>
            <p class="text-sm">Ensure your account is using a long, random password to stay secure.</p>
        </div>

        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
            <x-label for="current_password" value="Current Password" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
            <x-label for="password" value="New Password" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
            <x-label for="password_confirmation" value="Confirm Password" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>

        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-right mt-4">
            <x-action-message class="mr-3" on="saved">
                Saved.
            </x-action-message>

            <x-tas-button>
                Save
            </x-tas-button>
        </div>
    </form>
</div>
