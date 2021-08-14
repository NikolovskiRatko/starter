@extends('emails.email_layout')

@section('content')
    <style>
        .button {
            font: bold 11px Arial;
            text-decoration: none;
            background-color: #EEEEEE;
            color: #333333;
            padding: 2px 6px 2px 6px;
            border-top: 1px solid #CCCCCC;
            border-right: 1px solid #333333;
            border-bottom: 1px solid #333333;
            border-left: 1px solid #CCCCCC;
        }
    </style>
    <p>Dear {{ $name }},</p>

    <p>This is an automated e-mail, meant to inform you that a user account has been created for the {{config('app.name', 'Laravel')}} website.</p>

    <p>To verify your email address click</p>

    <a href="{{ $url }}" style="font-size: 17px;font-family: Helvetica, Arial, sans-serif;color: #ffffff;text-decoration: none;padding: 10px 20px;border-radius: 2px;border: 1px solid #0959b0;display: inline-block;background-color: #095fbd;">Activate Account</a>

    <p>Kind regards,<br/>
        The {{config('app.name', 'Laravel')}} Administration</p>
    <hr>
    <p style="font-size: 10pt;color: #666666">If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href="{{ $url }}">{{$url}}</a></p>
@stop
