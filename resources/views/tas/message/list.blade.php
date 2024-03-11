<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            Messages
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Messages
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mt-5">
            @if (session('status'))
                <x-alert-info>
                    {{session('status')}}
                </x-alert-info>
            @endif
            <table class="table-fixed border-collapse border slate-400 w-full">
                <thead>
                    <tr class="bg-slate-100 text-gray-700">
                        <th class="border border-slate-300 py-3">Name</th>
                        <th class="border border-slate-300 py-3">Date Received</th>
                        <th class="border border-slate-300 py-3">Status</th>
                        <th class="border border-slate-300 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="border">
                    @foreach($messages as $message)
                        <tr class="text-center text-gray-500 hover:bg-gray-50">
                            <td class="border border-slate-300 py-2">
                                {{$message->name}}
                            </td>
                            <td class="border border-slate-300 py-2">
                                {{$message->created_at}}
                            </td>
                            <td class="border border-slate-300 py-2">
                                {{\App\Enum\MessageStatus::from($message->status)->name}}
                            </td>
                            <td class="border border-slate-300 py-2">
                                <x-button-link-info href="{{route('message.read', [$message->id])}}">
                                    Read
                                </x-button-link-info>
                                @if($message->status == \App\Enum\MessageStatus::Pending->value)
                                    <x-button-link-warning href="{{route('message.resolve', [$message->id])}}">
                                        Resolve
                                    </x-button-link-warning>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{$messages->links()}}
        </div>
    </div>
</x-app-layout>
