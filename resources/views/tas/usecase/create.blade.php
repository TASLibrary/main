<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Usecase') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <form method="POST" action="{{ route('usecase.create') }}">
            @csrf

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-label for="title" value="{{ __('Title') }}" />
                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"  autofocus />
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-label for="description" value="{{ __('description') }}" />
                <textarea id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="description" :value="old('description')" >
                </textarea>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-label for="source" value="{{ __('Source') }}" />
                <x-input id="source" class="block mt-1 w-full" type="text" name="source" :value="old('source')"  autofocus />
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                Above Description is:
                <div class="columns-3">
                    <label for="source_type">
                        <x-input type="radio" name="source_type" value="copied"></x-input>
                        Copied and pasted from original source
                    </label>
                    <label for="source_type">
                        <x-input type="radio" name="source_type" value="summary"></x-input>
                        Summary of original source
                    </label>
                    <label for="source_type">
                        <x-input type="radio" name="source_type" value="invented"></x-input>
                        Invented
                    </label>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-label for="characteristics" value="{{ __('Standout Characteristics') }}" />
                <x-input id="characteristics" class="block mt-1 w-full" type="text" name="characteristics" :value="old('characteristics')"  autofocus />
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-label for="limitations" value="{{ __('Limitations') }}" />
                <x-input id="limitations" class="block mt-1 w-full" type="text" name="limitations" :value="old('limitations')"  autofocus />
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-label for="link" value="{{ __('Link to more information') }}" />
                <x-input id="link" class="block mt-1 w-full" type="text" name="link" :value="old('link')"  autofocus />
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <hr class="mt-5">
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
                <div class="grid grid md:grid-cols-3 gap-4">
                    <div>
                        <div>
                            <select class="rounded-full w-full">
                                <option>Interactions</option>
                            </select>
                        </div>
                        <div>
                            Which item best describes?
                        </div>
                        <div>
                            <div>
                                <label for="interaction">
                                    <x-input type="radio" name="interaction" value="advice"></x-input>
                                    Advice
                                </label>
                            </div>
                            <div>
                                <label for="interaction">
                                    <x-input type="radio" name="interaction" value="collaboration"></x-input>
                                    Collaboration
                                </label>
                            </div>
                            <div>
                                <label for="interaction">
                                    <x-input type="radio" name="interaction" value="competition"></x-input>
                                    Competition
                                </label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <select class="rounded-full w-full">
                                <option>Trust Type</option>
                            </select>
                        </div>
                        <div>
                            <select class="rounded-full w-full">
                                <option>Test Environment</option>
                            </select>
                        </div>
                        <div>
                            <select class="rounded-full w-full">
                                <option>Domain</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <div>
                            <select class="rounded-full w-full">
                                <option>Trust Type</option>
                            </select>
                        </div>
                        <div>
                            <select class="rounded-full w-full">
                                <option>Test Environment</option>
                            </select>
                        </div>
                        <div>
                            <select class="rounded-full w-full">
                                <option>Domain</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <hr class="mt-5">
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
                <p class="mb-6">
                    The TAS Hub aims always to conduct and deliver responsible research and
                    innovation (RRI). Ideally, all usecases that test for trust, test for appropriate
                    trust. When we identify factors that may elicit trust in untrustworthy machines, our
                    research has the potential to be misused.
                </p>
                <x-label for="rri" value="{{ __('Please enter any RRI issues you think might arise in relation to this usecase.') }}" />
                <textarea id="rri" class="block mt-1 w-full" name="rri">
                </textarea>
            </div>

            {{--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
            {{--                <x-label for="" value="{{ __('') }}" />--}}
            {{--                <x-input id="" class="block mt-1 w-full" type="text" name="" :value="old('')"  autofocus />--}}
            {{--            </div>--}}

            <div class="max-w-7xl flex mx-auto items-center mt-4">

                <x-button class="ml-4">
                    {{ __('Add Usecase') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>
