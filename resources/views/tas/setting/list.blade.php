<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            Settings
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Settings
        </h2>
    </x-slot>
    <div class="py-6">
        @if ($errors->any())
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-alert-danger>
                    <ul class="text-red-800">
                        @foreach ($errors->all() as $error)
                            <li class="mt-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-alert-danger>
            </div>
        @endif
        @if (session('status'))
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-alert-info>
                    {{session('status')}}
                </x-alert-info>
            </div>
        @endif
        <form method="post" action="{{route('setting.list')}}">
            @csrf
            @foreach($settings as $setting)
                @switch($setting->type)
                    @case('text')
                        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                            <x-label for="{{$setting->name}}" value="{{$setting->friendly_name}}" class="font-semibold" />
                            <p class="text-xs">{{$setting->description}}</p>
                            <x-input id="{{$setting->name}}" class="block mt-1 w-full" type="text" name="{{$setting->name}}" :value="old($setting->name, $setting->value)"  autofocus />
                        </div>
                        @break
                    @case('textarea')
                        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                            <x-label for="{{$setting->name}}" value="{{$setting->friendly_name}}" class="font-semibold" />
                            <p class="text-xs">{{$setting->description}}</p>
                            <textarea id="{{$setting->name}}" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm wysiwyg" name="{{$setting->name}}">{{old($setting->name, $setting->value)}}</textarea>
                        </div>
                        @break
                    @case('file')
                        <livewire:file-upload :name="$setting->name" :friendly_name="$setting->friendly_name" :current_path="$setting->value" />
                        @break
                    @case('plaintext')
                        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                            <x-label for="{{$setting->name}}" value="{{$setting->friendly_name}}" class="font-semibold" />
                            <p class="text-xs">{{$setting->description}}</p>
                            <textarea id="{{$setting->name}}" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="{{$setting->name}}">{{old($setting->name, $setting->value)}}</textarea>
                        </div>
                        @break
                @endswitch
            @endforeach
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-right mt-5">
                <x-tas-button type="submit">
                    Update Settings
                </x-tas-button>
            </div>
        </form>
    </div>
</x-app-layout>
