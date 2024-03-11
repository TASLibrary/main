<x-app-layout>
    <div class="py-2">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-semibold text-3xl">{{$usecase->title}}</h1>
        </div>
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-2">
            <h5 class="text-sm ml-2 font-semibold">ID #{{$usecase->id}}</h5>
        </div>
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <h5 class="text-sm ml-2 font-semibold">
                <div class="relative inline-flex items-center justify-between space-x-2 w-full max-w-sm text-sm">
                    Contributed by:
                    {{$usecase->user->username}}
                    @if($usecase->user->getMedalStatus() != 'NA')
                        <div class="inline group">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="IconChangeColor" height="16" width="16">
                                <path d="M223.7 130.8L149.1 7.77C147.1 2.949 141.9 0 136.3 0H16.03c-12.95 0-20.53 14.58-13.1 25.18l111.3 158.9C143.9 156.4 181.7 137.3 223.7 130.8zM256 160c-97.25 0-176 78.75-176 176S158.8 512 256 512s176-78.75 176-176S353.3 160 256 160zM348.5 317.3l-37.88 37l8.875 52.25c1.625 9.25-8.25 16.5-16.63 12l-46.88-24.62L209.1 418.5c-8.375 4.5-18.25-2.75-16.63-12l8.875-52.25l-37.88-37C156.6 310.6 160.5 299 169.9 297.6l52.38-7.625L245.7 242.5c2-4.25 6.125-6.375 10.25-6.375S264.2 238.3 266.2 242.5l23.5 47.5l52.38 7.625C351.6 299 355.4 310.6 348.5 317.3zM495.1 0H375.7c-5.621 0-10.83 2.949-13.72 7.77l-73.76 122.1c42 6.5 79.88 25.62 109.5 53.38l111.3-158.9C516.5 14.58 508.9 0 495.1 0z" id="mainIconPathAttribute"></path>
                            </svg>
                            <div
                                class="invisible group-hover:visible absolute top-0 left-0 z-10 space-y-1 bg-gray-900 text-gray-50 text-sm rounded px-4 py-2 w-full max-w-xs shadow-md"
                                role="tooltip" aria-hidden="true">
                                <p>{{$usecase->user->getMedalStatus()}} Medal Status</p>
                            </div>
                        </div>
                    @endif
                </div>
            </h5>
        </div>
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-2">
            <h5 class="text-sm ml-2 text-slate-400">
                Characteristics:
            </h5>
            <p class="text-sm ml-2 text-slate-400">
                @foreach($usecase->dimensions() as $dimension)
                    @if(count($dimension->characteristic) > 0)
                        {{$dimension->name}}:
                        @foreach($dimension->characteristic as $characteristic)
                            @if(!$characteristic->public && $usecase->characteristics->pluck('id')->contains($characteristic->id) )
                                {{$characteristic->name}};
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </p>
        </div>
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
            <h2 class="font-semibold text-2xl">Description</h2>
            <p class="text-justify">{{$usecase->description}}</p>
        </div>
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
            <h2 class="font-semibold text-2xl">Standout Characteristics</h2>
            <p class="text-justify">{{$usecase->standout_characteristics}}</p>
        </div>
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
            <h2 class="font-semibold text-2xl">Limitations</h2>
            <p class="text-justify">{{$usecase->limitations}}</p>
        </div>
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
            <h2 class="font-semibold text-2xl">RRI Issues</h2>
            <p class="text-justify">{{$usecase->rri}}</p>
        </div>
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
            <h2 class="font-semibold text-2xl">Source</h2>
            <p class="text-justify">{{$usecase->source}}</p>
        </div>
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
            <h2 class="font-semibold text-2xl">Evaluations by Other Contributors</h2>
            <div x-data="{ open: false }">
                <div class="flex flex-row float-right">
                    <livewire:issue-modal :usecase_id="$usecase->id" :usecase_title="$usecase->title"></livewire:issue-modal>
                    @auth
                        <x-tas-button @click="open = !open">Add Evaluation</x-tas-button>
                    @endauth
                    @guest
                        <x-tas-button @click="$dispatch('initLoginModal')">Add Evaluation</x-tas-button>
                    @endguest
                </div>
                <div class="h-12"></div>
                @auth
                <div class="bg-purple-200 rounded p-4" x-show="open">
                    <livewire:evaluation-block :usecase_id="$usecase->id" :user_id="\Illuminate\Support\Facades\Auth::user()->id"></livewire:evaluation-block>
                </div>
                @endauth
            </div>
            @foreach($evaluations as $evaluation)
                <div class="rounded bg-purple-100 border border-purple-300 mt-1 p-4">
                    <p class="mb-4">
                        <span class="font-bold">{{$evaluation->user->username}}</span> on {{$evaluation->created_at}}
                    </p>
                    @if(strlen($evaluation->positive_points) > 0)
                        <p class="text-sm font-bold">
                            What is good about this usecase?
                        </p>
                        <p class="text-sm mb-2">
                            {{$evaluation->positive_points}}
                        </p>
                    @endif

                    @if(strlen($evaluation->negative_points) > 0)
                        <p class="text-sm font-bold">
                            What is not so good about this usecase?
                        </p>
                        <p class="text-sm mb-2">
                            {{$evaluation->negative_points}}
                        </p>
                    @endif

                    <p class="text-sm font-bold">
                        How likely are you to use it yourself?
                    </p>
                    <p class="text-sm mb-2">
                        {{$evaluation->usage_likelihood_rating}}
                    </p>

                    @if(strlen($evaluation->usage_likelihood_reason) > 0)
                        <p class="text-sm font-bold">
                            Tell us why / why not?
                        </p>
                        <p class="text-sm mb-2">
                            {{$evaluation->usage_likelihood_reason}}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
            {{$evaluations->links()}}
        </div>
    </div>

</x-app-layout>
