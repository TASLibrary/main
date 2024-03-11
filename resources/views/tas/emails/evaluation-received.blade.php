@component('mail::message')
Hi there,

A new evaluation has been submitted about <a target="_blank" href="{{route('usecase.read', [$evaluation->usecase_id])}}">'{{$evaluation->usecase->title}}'</a> by {{$evaluation->user->name}}.
@endcomponent
