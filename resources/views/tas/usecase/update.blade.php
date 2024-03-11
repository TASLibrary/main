<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('usecase.list')}}" class="text-blue-300 hover:text-blue-400">Usecases</a> / Update Usecase
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Update Usecase
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
        <form method="post" action="{{route('usecase.update', [$usecase->id])}}">
            @csrf
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <x-label for="title" value="Title" />
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $usecase->title)"  autofocus />
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="description" value="Description" />
                <textarea id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="description">{{old('description', $usecase->description)}}</textarea>
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <p class="font-semibold">
                    Above Description is:
                </p>
                <div class="mt-1 text-sm">
                    <label for="origin">
                        <x-input type="radio" name="origin" value="{{\App\Enum\UseCaseOrigin::Copied->value}}" :checked="$usecase->origin == \App\Enum\UseCaseOrigin::Copied->value"></x-input>
                        Copied and pasted from original source
                    </label>
                </div>
                <div class="mt-1 text-sm">
                    <label for="origin">
                        <x-input type="radio" name="origin" value="{{\App\Enum\UseCaseOrigin::Summary->value}}" :checked="$usecase->origin == \App\Enum\UseCaseOrigin::Summary->value"></x-input>
                        Summary of original source
                    </label>
                </div>
                <div class="text-sm">
                    <label for="origin">
                        <x-input type="radio" name="origin" value="{{\App\Enum\UseCaseOrigin::Invented->value}}" :checked="$usecase->origin == \App\Enum\UseCaseOrigin::Invented->value"></x-input>
                        Invented
                    </label>
                </div>
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="Source" value="Source" />
                <x-input id="source" class="block mt-1 w-full" type="text" name="source" :value="old('source', $usecase->source)"  autofocus />
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="limitations" value="Limitations" />
                <x-input id="limitations" class="block mt-1 w-full" type="text" name="limitations" :value="old('limitations', $usecase->limitations)"  autofocus />
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="standout_characteristics" value="Standout Characteristics" />
                <x-input id="standout_characteristics" class="block mt-1 w-full" type="text" name="standout_characteristics" :value="old('standout_characteristics', $usecase->standout_characteristics)"  autofocus />
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="link" value="Link" />
                <x-input id="link" class="block mt-1 w-full" type="text" name="link" :value="old('link', $usecase->link)"  autofocus />
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="rri" value="RRI Issues" />
                <textarea id="rri" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="rri">{{trim(old('rri', $usecase->rri))}}</textarea>
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4 text-sm">
                Acknowledgement
                <div class="columns-1 mt-3">
                    <label for="acknowledgement">
                        <x-input type="radio" name="acknowledgement" value="{{\App\Enum\UseCaseAcknowledgement::Public->value}}" :checked="$usecase->acknowledgement == \App\Enum\UseCaseAcknowledgement::Public->value"></x-input>
                        The scenario described is publicly available and is submitted under "fair dealing" for critique/review.
                    </label>
                </div>
                <div class="columns-1 mt-2">
                    <label for="acknowledgement">
                        <x-input type="radio" name="acknowledgement" value="{{\App\Enum\UseCaseAcknowledgement::Originator->value}}" :checked="$usecase->acknowledgement == \App\Enum\UseCaseAcknowledgement::Originator->value"></x-input>
                        I am the originator of the scenario OR I have authority to grant permission for its publication.
                    </label>
                </div>
                <div class="columns-1 mt-2">
                    <label for="acknowledgement">
                        <x-input type="radio" name="acknowledgement" value="{{\App\Enum\UseCaseAcknowledgement::Consent->value}}" :checked="$usecase->acknowledgement == \App\Enum\UseCaseAcknowledgement::Consent->value"></x-input>
                        I am uploading the scenario with the informed consent of the copyright holder.
                    </label>
                </div>
                <hr>
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4 mb-10">
                <div>
                    <div class="columns-1">
                        User Inputs
                    </div>
                    <div class="grid grid-cols-1 gap-1 mt-1">
                        @foreach($usecase->dimensions() as $dimension)
                            <div class="mt-4">
                                <div class="mb-2">
                                    <strong>{{$dimension->name}}</strong>
                                    <br>
                                    ({{$dimension->question}})
                                </div>
                                <div class="grid grid-cols-1 gap-4">
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
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4 mb-10">
                Dimensions
                <div class="grid grid-cols-1 md:grid-cols-1 gap-1">
                    @foreach($dimensions as $dimension)
                        @if(count($dimension->characteristic->where('public', false)) > 0)
                            <div>
                                <strong>{{$dimension->name}}</strong>: <br>
                                {{$dimension->description}}
                                <select class="dimension block w-full" name="dim_{{$dimension->id}}_items[]">
                                        <option value="0">Please select a characteristic</option>
                                    @foreach($dimension->characteristic->where('public', false) as $characteristic)
                                        <option value="{{$characteristic->id}}" {{$usecase->characteristics->where('id', $characteristic->id)->isEmpty() ? '': 'selected'}}>{{$characteristic->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-right mt-5">
                <x-tas-secondary-button-link href="{{route('usecase.list')}}">
                    View Usecases
                </x-tas-secondary-button-link>
                <x-tas-button type="submit">
                    Update Usecase
                </x-tas-button>
            </div>
        </form>
    </div>
    @push('scripts')
        <script type="module">
            $(document).ready(function () {
                $('.dimension').select2();
            });

            $("form").submit( function(eventObj) {
                var data = $('.dimension option:selected').map(function(){
                    return this.value;
                }).get();

                $("<input />").attr("name", "characteristics")
                    .attr("type", "hidden")
                    .attr("value", data)
                    .appendTo("form");
                return true;
            });
        </script>
    @endpush
</x-app-layout>
