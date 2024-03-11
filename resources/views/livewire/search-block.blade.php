<div>
    <form wire:submit.prevent="search">
        <div class="grid grid-cols-6">
            <div class="col-start-2">
                <div class="max-w-xl mx-auto bg-purple-50 border-2 rounded border-purple-600 p-2">
                    <h3 class="text-xl">Filters</h3>
                    @foreach($dimensions as $dimension)
                        <div class="mt-2">
                            <div class="relative inline-flex items-center justify-between space-x-2 w-full max-w-sm">
                                {{$dimension->name}}
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
                            <div wire:ignore>
                                <select class="dimension-filter w-full" name="dim_{{$dimension->id}}_items[]" multiple onchange="">
                                    @if(!is_null($dimension->characteristic))
                                        @foreach($dimension->characteristic as $characteristic)
                                            @if(!$characteristic->public)
                                                <option value="{{$characteristic->id}}" {{in_array($characteristic->id, $selected_characteristics) ? 'selected' : ''}}>{{$characteristic->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-start-3 col-span-3">
                <div class="max-w-xl mx-auto sm:px-3 lg:px-4">
                    <div class="grid grid-cols-4">
                        <x-input type="text" wire:model="search" placeholder="Type here to search for author, title, etc." class="col-span-3 w-full"></x-input>
                        <x-tas-button type="submit">Search</x-tas-button>
                    </div>
                    <div class="mt-2">
                        <div class="grid grid-cols-3 gap-0 border-purple-300 border-2 rounded text-center text-sm">
                            <div :class="clicks == 0 ? 'border-r border-r-purple-300 p-2' : 'border-r border-r-purple-300 p-2 bg-purple-300 font-bold' " @click=" (clicks < 2 ? clicks = clicks + 1 : clicks = clicks - 2); $wire.sort('title', clicks) " x-data="{ clicks: 0 }">
                                Title <span class="text-xs" x-html=" (clicks == 0) ? '' : (clicks == 1 ? '(Ascending)' : '(Descending)') "></span>
                            </div>
                            <div :class="clicks == 0 ? 'border-r border-r-purple-300 p-2' : 'border-r border-r-purple-300 p-2 bg-purple-300 font-bold' " @click=" (clicks < 2 ? clicks = clicks + 1 : clicks = clicks - 2); $wire.sort('contributor', clicks)  " x-data="{ clicks: 0 }">
                                Contributor <span class="text-xs" x-html=" (clicks == 0) ? '' : (clicks == 1 ? '(Ascending)' : '(Descending)') "></span>
                            </div>
                            <div :class="clicks == 0 ? 'border-r border-r-purple-300 p-2' : 'border-r border-r-purple-300 p-2 bg-purple-300 font-bold' " @click=" (clicks < 2 ? clicks = clicks + 1 : clicks = clicks - 2); $wire.sort('user_rating', clicks)  " x-data="{ clicks: 0 }">
                                User Rating <span class="text-xs" x-html=" (clicks == 0) ? '' : (clicks == 1 ? '(Ascending)' : '(Descending)') "></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-xl mx-auto sm:px-3 lg:px-4 mt-4">
                    {{count($usecases)}} Usecase{{count($usecases) > 1 ? 's' : ''}}
                </div>
                @foreach($usecases as $usecase)
                    <div class="max-w-xl mx-auto sm:px-3 lg:px-4 bg-purple-50 border-2 border-purple-600 rounded p-2 mt-4">
                        <div class="grid-rows-1 mt-1">
                            <div class="grid grid-cols-1">
                                <div class="font-semibold">{{$usecase->title}}</div>
                            </div>
                        </div>
                        <div class="grid-rows-1 mt-1">
                            <div class="grid grid-cols-1">
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
                            </div>
                        </div>
                        <div class="grid-rows-1 mt-4">
                            <div class="text-sm">{{$usecase->source}}</div>
                        </div>
                        <div class="grid-rows-1 mt-4">
                            <div class="text-sm">{{substr($usecase->description, 0, 100)}} ...</div>
                        </div>
                        <div class="grid-rows-1 mt-4 text-right mb-2">
                            <x-tas-secondary-button-link href="{{route('library.usecase', ['usecase' => $usecase->id])}}">Read More</x-tas-secondary-button-link>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script type="module">
        $(document).ready(function () {
            $('.dimension-filter').select2();
            $('.dimension-filter').on('change', function (e) {
                var data = $('.dimension-filter option:selected').map(function () {
                    return this.value;
                }).get();
            @this.set('selected_characteristics', data);
            });

            window.addEventListener('reEnforceSelect2', event => {
                $('.dimension-filter').select2();
                $('.dimension-filter').on('change', function (e) {
                    var data = $('.dimension-filter option:selected').map(function () {
                        return this.value;
                    }).get();
                    @this.set('selected_characteristics', data);
                });
            });
        });
    </script>
@endpush
