<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            Evaluations
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Evaluations
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mt-5">
            @if (session('status'))
                <x-alert-info>
                    {{session('status')}}
                </x-alert-info>
            @endif
            <table class="table-auto border-collapse border slate-400 w-full">
                <thead>
                <tr class="bg-slate-100 text-gray-700">
                    <th class="border border-slate-300 py-3">Submitted By</th>
                    <th class="border border-slate-300 py-3">Usecase</th>
                    <th class="border border-slate-300 py-3">Date Received</th>
                    <th class="border border-slate-300 py-3">Status</th>
                    <th class="border border-slate-300 py-3">Actions</th>
                </tr>
                </thead>
                <tbody class="border">
                @foreach($evaluations as $evaluation)
                    <tr class="text-center text-gray-500 hover:bg-gray-50">
                        <td class="border border-slate-300 py-2">
                            <a target="_blank" class="text-sky-600 hover:text-sky-400" href="{{route('user.read', [$evaluation->user_id])}}">
                                {{$evaluation->user->name}}
                            </a>
                        </td>
                        <td class="border border-slate-300 py-2">
                            <a target="_blank" class="text-sky-600 hover:text-sky-400" href="{{route('usecase.read', [$evaluation->usecase_id])}}">
                                {{strlen($evaluation->usecase->title) > 32 ? substr($evaluation->usecase->title, 0, 32) . '...' : $evaluation->usecase->title}}
                            </a>
                        </td>
                        <td class="border border-slate-300 py-2">
                            {{$evaluation->created_at}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            {{\App\Enum\EvaluationStatus::from($evaluation->status)->name}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            <x-tas-button-link href="{{route('evaluation.read', [$evaluation->id])}}">View</x-tas-button-link>
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{$evaluations->links()}}
        </div>
    </div>
</x-app-layout>
