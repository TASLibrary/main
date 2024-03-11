<div x-data>
    @auth
        <a id="createUseCaseBtn" wire:click="showModal" wire:loading.attr="disabled" href="#" class="hidden"></a>
    @endauth
    @guest
        <a id="createUseCaseBtn" href="#" @click="$dispatch('initLoginModal')" class="hidden"></a>
    @endguest

    <x-modal maxWidth="2xl" class="flex items-center" id="usecaseModal" wire:model="showingModal">
        <form wire:submit.prevent="next">
            @csrf
            <div class="px-6 py-4">
                <div class="text-lg font-medium text-gray-900">
                    Add a Usecase
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    @if($step == $firstStep)
                        @if ($errors->any())
                            <x-alert-danger>
                                <ul class="text-red-800">
                                    @foreach ($errors->all() as $error)
                                        <li class="mt-1">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </x-alert-danger>
                        @endif
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <x-label for="title" value="Title"/>
                            <x-input id="title" wire:model="title" class="block mt-1 w-full" type="text" name="title"
                                     :value="old('title')" placeholder="e.g. Robot recommends route" autofocus/>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-1">
                            <x-label for="description" value="Description"/>
                            <textarea id="description" wire:model="description"
                                      class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                      name="description" placeholder="e.g. robot recommends route, participant decides whether or not to follow the recommendation">
                                {{old('description')}}
                            </textarea>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-1">
                            <x-label for="source" value="Source"/>
                            <x-input id="source" wire:model="source" class="block mt-1 w-full" type="text" name="source"
                                     :value="old('source')" placeholder="e.g. title of a paper, your name, citation..." autofocus/>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-1">
                            <p class="font-semibold">
                                Above Description is:
                            </p>
                            <div class="columns-2 md:columns-2 xl:columns-2 mt-1">
                                <label for="source_type">
                                    <x-input type="radio" wire:model="origin" name="source_type"
                                             value="{{\App\Enum\UseCaseOrigin::Copied->value}}"></x-input>
                                    Copied and pasted from original source
                                </label>
                                <label for="source_type">
                                    <x-input type="radio" wire:model="origin" name="source_type"
                                             value="{{\App\Enum\UseCaseOrigin::Summary->value}}"></x-input>
                                    Summary of original source
                                </label>
                            </div>
                            <div class="columns-1">
                                <label for="source_type">
                                    <x-input type="radio" wire:model="origin" name="source_type"
                                             value="{{\App\Enum\UseCaseOrigin::Invented->value}}"></x-input>
                                    Invented
                                </label>
                            </div>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-1">
                            <x-label for="characteristics" value="{{ __('Standout Characteristics') }}"/>
                            <x-input id="characteristics" wire:model="standout_characteristics"
                                     class="block mt-1 w-full" type="text" name="characteristics"
                                     :value="old('characteristics')" placeholder="e.g. Easy to implement, can be used to test many different aspects of robot or different types of system" autofocus/>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-1">
                            <x-label for="limitations" value="{{ __('Limitations') }}"/>
                            <x-input id="limitations" wire:model="limitations" class="block mt-1 w-full" type="text"
                                     name="limitations" :value="old('limitations')" placeholder="e.g. Requires a very particular lab set-up" autofocus/>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-1">
                            <x-label for="link" value="{{ __('Link to more information') }}"/>
                            <x-input id="link" wire:model="link" class="block mt-1 w-full" type="text" name="link"
                                     :value="old('link')" placeholder="Enter URL/DOI if available" autofocus/>
                        </div>
                    @endif

                    @if($step == $firstStep + 1)
                        <div class="max-w-7xl mx-auto sm:px-1 lg:px-1 mt-5">
                            <div class="grid md:grid-cols-2 gap-1">
                                @foreach($dimensions as $dimension)
                                    @if(count($dimension->user_inputs) > 0)
                                        <div>
                                            <div wire:ignore>
                                                <div
                                                    class="relative inline-flex items-center justify-between space-x-2 w-full max-w-sm">
                                                    <strong>{{$dimension->name}}</strong>
                                                    <div class="inline group">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" stroke-width="1.5"
                                                                 viewBox="0 0 24 24" fill="none"
                                                                 class="h-4 w-4 group-hover:text-blue-500 transition duration-150">
                                                              <path d="M12 11.5V16.5" stroke="currentColor"
                                                                    stroke-linecap="round" stroke-linejoin="round"/>
                                                              <path d="M12 7.51L12.01 7.49889" stroke="currentColor"
                                                                    stroke-linecap="round" stroke-linejoin="round"/>
                                                              <path
                                                                  d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                                                  stroke="currentColor" stroke-linecap="round"
                                                                  stroke-linejoin="round"/>
                                                            </svg>
                                                        </span>
                                                        <div
                                                            class="invisible group-hover:visible absolute top-0 left-0 z-10 space-y-1 bg-gray-900 text-gray-50 text-sm rounded px-4 py-2 w-full max-w-xs shadow-md"
                                                            role="tooltip" aria-hidden="true">
                                                            <p>{{$dimension->description}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                {{$dimension->question}}
                                                <select class="dimension block w-full"
                                                        name="dim_{{$dimension->id}}_items[]"
                                                    {{$dimension->input_type == \App\Enum\DimensionInputType::MultipleChoice->value ? 'multiple' : ''}}>
                                                    @foreach($dimension->user_inputs as $user_input)
                                                        <option
                                                            value="{{$user_input->id}}">{{$user_input->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($step == $firstStep + 2)
                        @if ($errors->any())
                            <x-alert-danger>
                                <ul class="text-red-800">
                                    @foreach ($errors->all() as $error)
                                        <li class="mt-1">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </x-alert-danger>
                        @endif
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
                            <p class="mb-6">
                                The TAS Hub aims always to conduct and deliver responsible research and
                                innovation (RRI). Ideally, all usecases that test for trust, test for appropriate
                                trust. When we identify factors that may elicit trust in untrustworthy machines, our
                                research has the potential to be misused.
                            </p>
                            <x-label for="rri"
                                     value="{{ __('Please enter any RRI issues you think might arise in relation to this usecase.') }}"/>
                            <textarea id="rri" wire:model="RRI"
                                      class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                      name="RRI">
                            {{old('RRI')}}
                        </textarea>
                        </div>
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                            <p class="font-semibold">
                                I understand that the usecase scenario and other information entered above may be
                                publicly available via the benchmarks library:
                            </p>
                            <div class="columns-1 mt-3">
                                <label for="acknowledgement">
                                    <x-input type="radio" wire:model="acknowledgement" name="acknowledgement"
                                             value="{{\App\Enum\UseCaseAcknowledgement::Public->value}}"></x-input>
                                    The scenario described is publicly available and is submitted under "fair dealing"
                                    for critique/review.
                                </label>
                            </div>
                            <div class="columns-1 mt-2">
                                <label for="acknowledgement">
                                    <x-input type="radio" wire:model="acknowledgement" name="acknowledgement"
                                             value="{{\App\Enum\UseCaseAcknowledgement::Originator->value}}"></x-input>
                                    I am the originator of the scenario OR I have authority to grant permission for its
                                    publication.
                                </label>
                            </div>
                            <div class="columns-1 mt-2">
                                <label for="acknowledgement">
                                    <x-input type="radio" wire:model="acknowledgement" name="acknowledgement"
                                             value="{{\App\Enum\UseCaseAcknowledgement::Consent->value}}"></x-input>
                                    I am uploading the scenario with the informed consent of the copyright holder.
                                </label>
                            </div>
                            <div class="columns-1 mt-4">
                                <p class="font-semibold text-center">
                                    The editorial team reserves the right to edit this submission for length, spelling,
                                    grammar, and classification.
                                </p>
                            </div>
                        </div>
                    @endif

                    @if($step == $firstStep + 3)
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
                            <p class="mb-6">
                                {{$message}}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
                @if($step > $firstStep && $step != $lastStep)
                    <a href="#" class="m-1 rounded-full border border-purple-700 text-sm px-2 py-2 text-purple-700"
                       wire:click="back">
                        Back
                    </a>
                @endif
                @if($step < $lastStep)
                    <button type="submit"
                            class="m-1 rounded-full border border-purple-700 bg-purple-700 text-sm px-2 py-2 text-white">
                        @if($step == $lastStep - 1)
                            Submit Usecase
                        @else
                            Next
                        @endif
                    </button>
                @endif

                <a href="#" class="m-1 rounded-full border border-purple-700 text-sm px-2 py-2 text-purple-700"
                   wire:click="$toggle('showingModal')" wire:loading.attr="disabled">
                    @if($step == $lastStep)
                        Close
                    @else
                        Cancel
                    @endif
                </a>
            </div>

        </form>
    </x-modal>
</div>
@push('scripts')
    <script type="module">
        $(document).ready(function () {
            window.addEventListener('reEnforceSelect2', event => {
                $('.dimension').select2({
                    tags: true,
                    createTag: function (params) {
                        var term = $.trim(params.term);

                        if (term === '') {
                            return null;
                        }

                        return {
                            id: term,
                            text: term,
                            newTag: true
                        }
                    },
                    dropdownParent: $("#usecaseModal")
                });


                $('.dimension').on('change', function (e) {
                    var data = $('.dimension option:selected').map(function () {
                        if($(this).attr('data-select2-tag')){ // New tag
                            var dimension_id = $(this).parent().attr('name').split('_')[1] // Dimension ID
                            return dimension_id + ':::' + this.value
                        }
                        return this.value;
                    }).get();
                @this.set('selected_user_inputs', data);
                });
            });
        });
    </script>
@endpush
