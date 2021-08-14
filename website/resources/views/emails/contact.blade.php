@extends('emails.email_layout')

@section('content')
    <p> This is a contact form sent from {{ $url }} </p>

    <p> The message is from {{ $data['name'] }}, with an email: {{ $data['email'] }} </p>

    <p> {{ $data['subject'] }} </p>
    <p> {{ $data['message'] }} </p>
@stop
