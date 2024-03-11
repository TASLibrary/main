<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            Issues
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Issues
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
                        <th class="border border-slate-300 py-3">Usecase</th>
                        <th class="border border-slate-300 py-3">Date Received</th>
                        <th class="border border-slate-300 py-3">Status</th>
                        <th class="border border-slate-300 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="border">
                @foreach($issues as $issue)
                    <tr class="text-center text-gray-500 hover:bg-gray-50">
                        <td class="border border-slate-300 py-2">
                            <a target="_blank" class="text-sky-600 hover:text-sky-400" href="{{route('usecase.read', [$issue->usecase_id])}}">
                                {{strlen($issue->usecase->title) > 32 ? substr($issue->usecase->title, 0, 32) . '...' : $issue->usecase->title}}
                            </a>
                        </td>
                        <td class="border border-slate-300 py-2">
                            {{$issue->created_at}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            {{\App\Enum\IssueStatus::from($issue->status)->name}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            <x-button-link-info href="{{route('issue.read', [$issue->id])}}">
                                Read
                            </x-button-link-info>
                            @if($issue->status == \App\Enum\IssueStatus::Pending->value)
                                <x-button-link-warning href="{{route('issue.resolve', [$issue->id])}}">
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
            {{$issues->links()}}
        </div>
    </div>
</x-app-layout>

