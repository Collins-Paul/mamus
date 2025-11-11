@extends('layouts.emails')
@section('title')
    Password Reset Notification
@endsection
@section('content')
    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
        <tbody>
            <tr>
                <td style="text-align:center;padding: 30px 30px 15px 30px;">
                    <h2 style="font-size: 18px; color: #1ee0ac; font-weight: 600; margin: 0;">Password Reseted</h2>
                </td>
            </tr>
            <tr>
                <td style="text-align:center;padding: 0 30px 20px">
                    <p style="margin-bottom: 10px;">Hi <strong>{{ $MailData['fullname'] }}</strong>,</p>
                    <p>You Successfully Reseted Your Password. Thanks For being with Us.</p>
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
