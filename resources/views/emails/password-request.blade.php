@extends('layouts.emails')

@section('title')
    Password Reset Request
@endsection

@section('content')
<table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
    <tbody>
        <tr>
            <td style="text-align:center;padding: 30px 30px 15px 30px;">
                <h2 style="font-size: 18px; color: #6576ff; font-weight: 600; margin: 0;">Reset Password</h2>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;padding: 0 30px 20px">
                <p style="margin-bottom: 10px;">Hi <strong>{{ $MailData['fullname'] }}</strong></p>
                <p style="margin-bottom: 25px;">Click On The link below to reset your password.</p>
                <a href="{{ $MailData['token'] }}" style="background-color:#6576ff;border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 25px">Reset Password</a>
            </td>
        </tr>
        <tr>
            <td style="padding: 0 30px">
                <h4 style="font-size: 15px; color: #000000; font-weight: 600; margin: 0; text-transform: uppercase; margin-bottom: 10px">or</h4>
                <p style="margin-bottom: 10px;">If the button above does not work, click this link:</p>
                <a href="{{ $MailData['token'] }}" style="color: #6576ff; text-decoration:none;word-break: break-all;">{{ $MailData['token'] }}</a>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px 30px 40px">
                <p>If you did not make this request, please contact us or ignore this message.</p>
                <p style="margin: 0; font-size: 13px; line-height: 22px; color:#9ea8bb;">This is an automatically generated email please do not reply to this email. If you face any issues, please contact us at  <a href="mailto:{{ config('app.email') }}"><strong>{{ config('app.email') }}</strong></a></p>
            </td>
        </tr>
    </tbody>
</table>
@endsection
