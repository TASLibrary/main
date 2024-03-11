<x-app-layout>
    <x-slot name="header">
        <x-bread-crumb>
            <a href="{{route('dimension.list')}}" class="text-blue-300 hover:text-blue-400">Dimensions</a> / Create Dimension
        </x-bread-crumb>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4">
            Create New Dimension
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
        <form method="post" action="{{route('dimension.create')}}">
            @csrf
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <x-label for="name" value="Name" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autofocus />
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="question" value="Question" />
                <x-input id="question" class="block mt-1 w-full" type="text" name="question" :value="old('question')"  autofocus />
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="description" value="Description" />
                <textarea id="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" name="description">{{old('description')}}</textarea>
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 mt-4">
                <x-label for="description" value="Input Type" />
                <select name="input_type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                    @foreach(\App\Enum\DimensionInputType::cases() as $input_type)
                        <option value="{{$input_type->value}}"}}>{{\App\Enum\DimensionInputType::getName($input_type)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-right mt-5">
                <x-tas-secondary-button-link href="{{route('dimension.list')}}">
                    View Dimensions
                </x-tas-secondary-button-link>
                <x-tas-button type="submit">
                    Create Dimension
                </x-tas-button>
            </div>
        </form>
    </div>
</x-app-layout>
