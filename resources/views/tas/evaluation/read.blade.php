<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('evaluation.list')}}" class="text-blue-300 hover:text-blue-400">Evaluations</a> / Evaluation Details
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Evaluation Details
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="columns-1">
            <div>
                <div class="columns-1 text-purple-600">
                    User
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    <a target="_blank" class="text-sky-600 hover:text-sky-400" href="{{route('user.read', [$evaluation->user_id])}}">
                        {{$evaluation->user->name}}
                    </a>
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Usecase
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    <a target="_blank" class="text-sky-600 hover:text-sky-400" href="{{route('usecase.read', [$evaluation->usecase_id])}}">
                        {{$evaluation->usecase->title}}
                    </a>
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Date Received
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$evaluation->created_at}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    What is good about this usecase?
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$evaluation->positive_points}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    What is not so good about this usecase?
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$evaluation->negative_points}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    How likely are you to use it yourself?
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$evaluation->usage_likelihood_rating}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Tell us why / why not?
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$evaluation->usage_likelihood_reason}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Status
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{\App\Enum\EvaluationStatus::from($evaluation->status)->name}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4 mb-3 text-center">
            <x-tas-secondary-button-link href="{{route('evaluation.list')}}">View Evaluations</x-tas-secondary-button-link>
            <x-button-link-warning href="{{route('evaluation.update', [$evaluation->id])}}">
                Update
            </x-button-link-warning>
            @if($evaluation->status == \App\Enum\EvaluationStatus::Pending->value)
                <x-button-link-info href="{{route('evaluation.approve', [$evaluation->id])}}">
                    Approve
                </x-button-link-info>
                <x-button-link-danger href="{{route('evaluation.reject', [$evaluation->id])}}">
                    Reject
                </x-button-link-danger>
            @endif
            @if($evaluation->status == \App\Enum\EvaluationStatus::Approved->value)
                <x-button-link-danger href="{{route('evaluation.reject', [$evaluation->id])}}">
                    Reject
                </x-button-link-danger>
            @endif
            @if($evaluation->status == \App\Enum\EvaluationStatus::Rejected->value)
                <x-button-link-info href="{{route('evaluation.approve', [$evaluation->id])}}">
                    Approve
                </x-button-link-info>
            @endif
        </div>
    </div>
</x-app-layout>
