<div>
    @if($sent)

        <h3 class="text-xl text-center">Evaluation Submitted!</h3>
        <p class="mt-4">
            Thanks for your evaluation. It's being checked by moderators and will appear soon.
        </p>
    @else
        @if ($errors->any())
            <div>
                <x-alert-danger>
                    <ul class="text-red-800">
                        @foreach ($errors->all() as $error)
                            <li class="mt-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-alert-danger>
            </div>
        @endif
        <form wire:submit.prevent="submit">
            @csrf
            <input type="hidden" name="usecase_id" wire:model="usecase_id" value="{{$usecase_id}}">
            <input type="hidden" name="user_id" wire:model="user_id" value="{{$user_id}}">
            <div>
                <x-label for="positive_points" value="What is good about this usecase?" />
                <textarea id="positive_points" wire:model="positive_points" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="positive_points">{{old('positive_points')}}</textarea>
            </div>
            <div class="mt-4">
                <x-label for="negative_points" value="What is not so good about this usecase?" />
                <textarea id="negative_points" wire:model="negative_points" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="negative_points">{{old('negative_points')}}</textarea>
            </div>
            <div class="mt-4">
                <x-label value="How likely are you to use it yourself?" />
                <div class="columns-5 text-center">
                    <div>
                        <label for="usage_likelihood_rating">
                            <x-input type="radio" wire:model="usage_likelihood_rating" name="usage_likelihood_rating" value="1"></x-input>
                            1
                        </label>
                    </div>
                    <div>
                        <label for="usage_likelihood_rating">
                            <x-input type="radio" wire:model="usage_likelihood_rating" name="usage_likelihood_rating" value="2"></x-input>
                            2
                        </label>
                    </div>
                    <div>
                        <label for="usage_likelihood_rating">
                            <x-input type="radio" wire:model="usage_likelihood_rating" name="usage_likelihood_rating" value="3"></x-input>
                            3
                        </label>
                    </div>
                    <div>
                        <label for="usage_likelihood_rating">
                            <x-input type="radio" wire:model="usage_likelihood_rating" name="usage_likelihood_rating" value="4"></x-input>
                            4
                        </label>
                    </div>
                    <div>
                        <label for="usage_likelihood_rating">
                            <x-input type="radio" wire:model="usage_likelihood_rating" name="usage_likelihood_rating" value="5"></x-input>
                            5
                        </label>
                    </div>
                </div>
                <div class="columns-2">
                    <div class="text-left text-xs">Very Unlikely</div>
                    <div class="text-right text-xs">Very Likely</div>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="usage_likelihood_reason" value="Tell us why / why not?" />
                <textarea id="usage_likelihood_reason" wire:model="usage_likelihood_reason" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="usage_likelihood_reason">{{old('usage_likelihood_reason')}}</textarea>
            </div>

            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-right mt-5">
                <x-tas-secondary-button @click="open = false">
                    Cancel
                </x-tas-secondary-button>
                <x-tas-button type="submit">
                    Submit
                </x-tas-button>
            </div>
        </form>
    @endif
</div>
