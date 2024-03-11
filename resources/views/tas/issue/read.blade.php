<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('issue.list')}}" class="text-blue-300 hover:text-blue-400">Issues</a> / Issue Details
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Issue Details
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="columns-1">
            <div>
                <div class="columns-1 text-purple-600">
                    Usecase
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    <a target="_blank" class="text-sky-600 hover:text-sky-400" href="{{route('usecase.read', [$issue->usecase_id])}}">{{$issue->usecase->title}}</a>
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
                    {{$issue->created_at}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Email
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$issue->email}}
                </div>
            </div>
        </div>

        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Message
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$issue->message}}
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
                    {{\App\Enum\IssueStatus::from($issue->status)->name}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4 mb-3 text-center">
            <x-tas-secondary-button-link href="{{route('issue.list')}}">View Issues</x-tas-secondary-button-link>
            @if($issue->status == \App\Enum\IssueStatus::Pending->value)
                <x-button-link-warning href="{{route('issue.resolve', [$issue->id])}}">
                    Resolve
                </x-button-link-warning>
            @endif
        </div>
    </div>
</x-app-layout>
