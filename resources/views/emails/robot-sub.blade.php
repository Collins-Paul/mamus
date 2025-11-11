@extends('layouts.emails')

@section('title')
    Robot Subscription
@endsection

@section('content')
<table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
    <tbody>
        <tr>
            <td style="text-align:center;padding: 30px 30px 15px 30px;">
                <h2 style="font-size: 18px; color: #1ee0ac; font-weight: 600; margin: 0;">Robot Subscription</h2>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 30px 20px">
                <p style="margin-bottom: 10px;">Hi {{ $MailData['fullname'] }},</p>
                <p>Your subscription for Robot Trading is successful and active.</p>
                <p>Plan: <strong>{{ $MailData['plan'] }}</strong></p>
                <p>Purchase Date: <strong>{{ $MailData['purchase_date'] }}</strong></p>
                <p>Expire Date: <strong>{{ $MailData['exp_date'] }}</strong></p>
                <p>Robot ID: <strong>{{ $MailData['robot_id'] }}</strong></p>
                <p>Status: <strong>{{ $MailData['status'] }}</strong></p>
                <p><a href="{{ config('app.url') }}/auth/login">Login Now</a></p>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;padding: 0 30px 40px">
                <p style="margin: 0; font-size: 13px; line-height: 22px; color:#9ea8bb;">This is an automatically generated email please do not reply to this email. If you face any issues, please contact us at  <a href="mailto:{{ config('app.email') }}">{{ config('app.email') }}</a></p>
            </td>
        </tr>
    </tbody>
</table>
@endsection
