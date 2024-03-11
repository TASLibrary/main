<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('usecase.list')}}" class="text-blue-300 hover:text-blue-400">Usecases</a> / Usecase Details
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Usecase Details
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="columns-1">
            <div>
                <div class="columns-1 text-purple-600">
                    Title
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$usecase->title}}
                </div>
            </div>
            <div>
                <div class="columns-1 text-purple-600">
                    Source
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$usecase->source}}
                </div>
            </div>
        </div>

        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Description
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$usecase->description}}
                </div>
            </div>
        </div>

        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Origin
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{\App\Enum\UseCaseOrigin::getMessage(\App\Enum\UseCaseOrigin::from($usecase->origin))}}
                </div>
            </div>
            <div>
                <div class="columns-1 text-purple-600">
                    Standout Characteristics
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$usecase->standout_characteristics}}
                </div>
            </div>
        </div>

        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    Limitations
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$usecase->limitations}}
                </div>
            </div>
            <div>
                <div class="columns-1 text-purple-600">
                    Link to More Information
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$usecase->link}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4">
            <div>
                <div class="columns-1 text-purple-600">
                    RRI Issues
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{$usecase->rri}}
                </div>
            </div>
            <div>
                <div class="columns-1 text-purple-600">
                    Acknowledgement
                </div>
                <hr class="border border-purple-600">
                <div class="columns-1 ml-5">
                    {{\App\Enum\UseCaseAcknowledgement::getMessage(\App\Enum\UseCaseAcknowledgement::from($usecase->acknowledgement))}}
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4 mb-10">
            <div>
                <div class="columns-1 text-purple-600">
                    User Inputs
                </div>
                <hr class="border border-purple-600">
                <div class="grid grid-cols-1 gap-1 mt-4">
                    @foreach($usecase->dimensions() as $dimension)
                        <div class="mb-4">
                            <div class="mb-2">
                                <strong>{{$dimension->name}}</strong>
                                <br>
                                ({{$dimension->question}})
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach($dimension->user_inputs as $user_input)
                                    @if($usecase->user_inputs->find($user_input->id))
                                        <div>
                                            <span class="m-1 p-2 text-sm border rounded border-slate-300 bg-slate-100 text-slate-500">
                                                {{$user_input->name}}
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="columns-1 mt-4 mb-10">
            <div>
                <div class="columns-1 text-purple-600">
                    Characteristics
                </div>
                <hr class="border border-purple-600">
                <div class="grid grid-cols-1 gap-1 mt-4">
                    @foreach($usecase->dimensions() as $dimension)
                        <div class="mb-2">
                            <div class="mb-2">
                                <strong>{{$dimension->name}}</strong>
                                <br>
                                ({{$dimension->description}})
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($dimension->characteristic as $characteristic)
                                    @if($usecase->characteristics->find($characteristic->id))
                                        <div>
                                            <span class="m-1 p-2 text-sm border rounded border-slate-300 bg-slate-100 text-slate-500">
                                                {{$characteristic->name}}
                                            </span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="columns-1 mt-2 mb-3 text-center">
            <x-tas-secondary-button-link href="{{route('usecase.list')}}">View Usecases</x-tas-secondary-button-link>
        </div>
    </div>

</x-app-layout>
