@extends('layouts.emails')

@section('title')
    Welcome Mail
@endsection

@section('content')
<table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
    <tbody>
        <tr>
            <td style="padding: 30px 30px 20px">
                {{-- {{ $MailData['fullname'] }} --}}
                <p style="margin-bottom: 10px;">Hi {{ $MailData['fullname']   }},</p>
                <p style="margin-bottom: 10px;">We are pleased to have you as a member of {{ config('app.name') }}</p>
                <p style="margin-bottom: 10px;">Your account is now verified and you can start trading.</p>
                <p style="margin-bottom: 15px;">Hope you'll enjoy the experience? we're here if you have any questions, drop us a mail at <a style="color: #6576ff; text-decoration:none;" href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a> anytime. </p>
            </td>
        </tr>
    </tbody>
</table>
@endsection
