<div {{ $attributes->merge(['class' => 'bg-gray-200 p-3 text-sm text-gray-500'])}}>
    <a href="{{route('dashboard')}}" class="text-blue-300 hover:text-blue-400">Dashboard</a> / {{$slot}}
</div>
