@component('mail::message')
Hi there,

A new issue has been submitted about <a target="_blank" href="{{route('usecase.read', [$issue->usecase_id])}}">'{{$issue->usecase->title}}'</a>.

@if(strlen($issue->email))
Sender's email address is: <a href="mailto:{{$issue->email}}">{{$issue->email}}</a>
@endif

Here is the message:

{{$issue->message}}
@endcomponent
