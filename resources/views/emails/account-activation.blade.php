@extends('layouts.emails')

@section('title')
    Account Activation
@endsection

@section('content')
<table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
    <tbody>
        <tr>
            <td style="padding: 30px 30px 20px">
                <div style="text-align: center; margin-bottom: 10px;">
                    <h4 style="margin-bottom: 10px; color: green">Account Activation</h4>
                </div>
                {{-- {{ $MailData['fullname'] }} --}}
                <p style="margin-bottom: 10px;">Dear {{ $MailData['fullname']   }},</p>
                <p style="margin-bottom: 10px;">Please be informed that your account with {{ config('app.name') }} has been activated.</p>
                <p style="margin-bottom: 10px;">Thank you.</p>
            </td>
        </tr>
    </tbody>
</table>
@endsection
