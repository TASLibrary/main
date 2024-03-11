<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('message.list')}}" class="text-blue-300 hover:text-blue-400">Messages</a> / Message Details
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Message Details
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="columns-1">
            <div>
                <div class="columns-1 text-purple-600">
                    Name
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$message->name}}
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
                    {{$message->created_at}}
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
                    {{$message->email}}
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
                    {{$message->message}}
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
                    {{\App\Enum\MessageStatus::from($message->status)->name}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4 mb-3 text-center">
            <x-tas-secondary-button-link href="{{route('message.list')}}">View Messages</x-tas-secondary-button-link>
            @if($message->status == \App\Enum\MessageStatus::Pending->value)
                <x-button-link-warning href="{{route('message.resolve', [$message->id])}}">
                    Resolve
                </x-button-link-warning>
            @endif
        </div>
    </div>
</x-app-layout>
