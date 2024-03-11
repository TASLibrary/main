@component('mail::message')
Hi there,

A new message has been submitted by {{$message_received->name}}.

@if(strlen($message_received->email))
Sender's email address is: <a href="mailto:{{$message_received->email}}">{{$message_received->email}}</a>
@endif

Here is the message:

{{$message_received->message}}
@endcomponent
