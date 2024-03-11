@php

$fileType = ''

@endphp

<div x-data="{ {{$name}} : null, uploading: false, progress: 0, upload_error: false}"
     x-on:livewire-upload-start="uploading = true"
     x-on:livewire-upload-finish="uploading = false"
     x-on:livewire-upload-error="uploading = false; upload_error = true; progress = 0"
     x-on:livewire-upload-progress="progress = $event.detail.progress"
     class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
    <div>
        <x-label for="{{$name}}" value="{{$friendly_name}}" class="mb-2" />
        <x-tas-button-link x-on:click.prevent="$refs.{{$name}}.click()">
            Click to Select a New {{$friendly_name}}
        </x-tas-button-link>
        <input id="{{$name}}" class="hidden"
               wire:model="file"
               x-ref="{{$name}}"
               type="file"
               name="file"
               x-on:change="
                    {{$name}} = $refs.{{$name}}.files[0].name + '(' + Math.round(($refs.{{$name}}.files[0].size)/1024) + ' KB)';
                            "
               autofocus />
    </div>
    <div class="mt-2">
        <span class="text-sm font-semibold" x-text="{{$name}}"></span>
    </div>
    <div x-show="uploading">
        <progress max="100" x-bind:value="progress"></progress>
    </div>
    <input type="hidden" name="{{$name}}" value="{{strlen($file_path) > 0 ? $file_path : $current_path}}">
    <div x-show="upload_error">
        Error!
    </div>
</div>
