@extends('layouts.emails')

@section('title')
    Account Deactivation
@endsection

@section('content')
<table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
    <tbody>
        <tr>
            <td style="padding: 30px 30px 20px">
                <div style="text-align: center; margin-bottom: 10px;">
                    <h4 style="margin-bottom: 10px; color: red">Account Deactivation</h4>
                </div>
                {{-- {{ $MailData['fullname'] }} --}}
                <p style="margin-bottom: 10px;">Dear {{ $MailData['fullname']   }},</p>
                <p style="margin-bottom: 10px;">Please be informed that your account with {{ config('app.name') }} has been deactivated indefinitely.</p>
                <p style="margin-bottom: 10px;">Kindly contact us via mail <a href="mailto:{{ config('app.email') }}"><strong>{{ config('app.email') }}</strong></a> for further enquiries and to activate your account.</p>
            </td>
        </tr>
    </tbody>
</table>
@endsection
