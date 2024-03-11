<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            Usecases
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Usecases
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
                    <th class="border border-slate-300 py-3">Title</th>
                    <th class="border border-slate-300 py-3">Created by</th>
                    <th class="border border-slate-300 py-3">Date Received</th>
                    <th class="border border-slate-300 py-3">Status</th>
                    <th class="border border-slate-300 py-3">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usecases as $usecase)
                    <tr class="text-center text-gray-500 hover:bg-gray-50">
                        <td class="border border-slate-300 py-2">
                            {{strlen($usecase->title) > 32 ? substr($usecase->title, 0, 32) . '...' : $usecase->title}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            <a target="_blank" class="text-sky-600 hover:text-sky-400" href="{{route('user.read', [$usecase->user_id])}}">
                                {{$usecase->user->name}}
                            </a>
                        </td>
                        <td class="border border-slate-300 py-2">
                            {{$usecase->created_at}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            {{\App\Enum\UsecaseStatus::from($usecase->status)->name}}
                        </td>
                        <td class="border border-slate-300 py-2">
                            @if(\Illuminate\Support\Facades\Auth::user()->hasRole(\App\Enum\UserRole::Administrator->name))
                                <x-tas-button-link href="{{route('usecase.read', [$usecase->id])}}">View</x-tas-button-link>
                                <x-button-link-warning href="{{route('usecase.update', [$usecase->id])}}">Update</x-button-link-warning>
                                @if($usecase->status == \App\Enum\UsecaseStatus::Pending->value)
                                    <x-button-link-info href="{{route('usecase.approve', [$usecase->id])}}">Approve</x-button-link-info>
                                    <x-button-link-danger href="{{route('usecase.reject', [$usecase->id])}}">Reject</x-button-link-danger>
                                @endif
                                @if($usecase->status == \App\Enum\UsecaseStatus::Rejected->value)
                                    <x-button-link-info href="{{route('usecase.approve', [$usecase->id])}}">Approve</x-button-link-info>
                                @endif
                                @if($usecase->status == \App\Enum\UsecaseStatus::Approved->value)
                                    <x-button-link-danger href="{{route('usecase.reject', [$usecase->id])}}">Reject</x-button-link-danger>
                                @endif
                            @endif

                            @if(!$usecase->featured && $usecase->status == \App\Enum\UsecaseStatus::Approved->value)
                                <x-button-link-info href="{{route('usecase.feature', [$usecase->id])}}">Feature</x-button-link-info>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
        <div class="mt-2">
            {{$usecases->links()}}
        </div>
    </div>
</x-app-layout>
