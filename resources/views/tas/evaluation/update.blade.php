<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('evaluation.list')}}" class="text-blue-300 hover:text-blue-400">Evaluations</a> / Update Evaluation
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Update Evaluation
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
        <form method="post" action="{{route('evaluation.update', [$evaluation->id])}}">
        @csrf
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <x-label for="positive_points" value="What is good about this usecase?" />
                <textarea id="positive_points" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="positive_points">{{old('positive_points', $evaluation->positive_points)}}</textarea>
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="negative_points" value="What is not so good about this usecase?" />
                <textarea id="negative_points" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="negative_points">{{old('negative_points', $evaluation->negative_points)}}</textarea>
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label value="How likely are you to use it yourself?" />
                <div class="columns-5 text-center">
                    <div>
                        <label for="usage_likelihood_rating">
                            <x-input type="radio" name="usage_likelihood_rating" value="1" :checked="$evaluation->usage_likelihood_rating == 1"></x-input>
                            1
                        </label>
                    </div>
                    <div>
                        <label for="usage_likelihood_rating">
                            <x-input type="radio" name="usage_likelihood_rating" value="2" :checked="$evaluation->usage_likelihood_rating == 2"></x-input>
                            2
                        </label>
                    </div>
                    <div>
                        <label for="usage_likelihood_rating">
                            <x-input type="radio" name="usage_likelihood_rating" value="3" :checked="$evaluation->usage_likelihood_rating == 3"></x-input>
                            3
                        </label>
                    </div>
                    <div>
                        <label for="usage_likelihood_rating">
                            <x-input type="radio" name="usage_likelihood_rating" value="4" :checked="$evaluation->usage_likelihood_rating == 4"></x-input>
                            4
                        </label>
                    </div>
                    <div>
                        <label for="usage_likelihood_rating">
                            <x-input type="radio" name="usage_likelihood_rating" value="5" :checked="$evaluation->usage_likelihood_rating == 5"></x-input>
                            5
                        </label>
                    </div>
                </div>
                <div class="max-w-xl mx-auto sm:px-6 lg:px-8 columns-2">
                    <div class="text-left text-xs">Very Unlikely</div>
                    <div class="text-right text-xs">Very Likely</div>
                </div>
            </div>

            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="usage_likelihood_reason" value="Tell us why / why not?" />
                <textarea id="usage_likelihood_reason" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="usage_likelihood_reason">{{old("usage_likelihood_reason", $evaluation->usage_likelihood_reason)}}</textarea>
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-right mt-5">
                <x-tas-secondary-button-link href="{{route('evaluation.list')}}">
                    View Evaluations
                </x-tas-secondary-button-link>
                <x-tas-button type="submit">
                    Update Evaluation
                </x-tas-button>
            </div>
        </form>
    </div>
</x-app-layout>
