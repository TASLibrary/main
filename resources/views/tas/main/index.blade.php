<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto px-18 sm:px-20 lg:px-20">
            <div class="grid grid-cols-2 md:grid-cols-2 mt-5 gap-2">
                <div>
                    <div>
                        <p class="text-justify">
                            {!! nl2br($welcome_text) !!}
                        </p>
                    </div>
                    <div>
                        <p class="text-lg">Featured Usecase</p>
                        @if(!is_null($usecase))
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
                                    <div class="text-sm">{{substr($usecase->description, 0, 200)}} ...</div>
                                </div>
                                <div class="grid-rows-1 mt-4 text-right mb-2">
                                    <x-tas-secondary-button-link href="{{route('library.usecase', ['usecase' => $usecase->id])}}">Read More</x-tas-secondary-button-link>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="grid grid-cols-2 md:grid-cols-2">
                            <div class="px-6">
                                <x-tas-button-link class="block py-6" href="{{route('library')}}">
                                    Search or Browse
                                </x-tas-button-link>

                            </div>
                            <div class="px-6" x-data>
                                @auth
                                    <x-tas-button-link @click="$dispatch('initCreateUseCaseModal')" href="#" class="block py-6">
                                        Add a Usecase
                                    </x-tas-button-link>
                                @endauth
                                @guest
                                    <x-tas-button-link href="#" x-on:click="$dispatch('initLoginModal')" class="block py-6">
                                        Add a Usecase
                                    </x-tas-button-link>
                                @endguest
                            </div>
                    </div>
                    <div class="px-10 py-10">
                        @if(!is_null($video_file_path))
                            <video width="450" height="450" controls>
                                <source src="{{\Illuminate\Support\Facades\Storage::url($video_file_path)}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
