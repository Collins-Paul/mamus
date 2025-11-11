@extends('layouts.emails')

@section('title')
    Alart Mail
@endsection

@section('content')
                <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
                    <tbody>
                        <tr>
                            <td style="padding: 30px 30px 20px">
                                <div style="text-align: center; margin-bottom: 10px;">
                                    <h4 style="margin-bottom: 10px;">Transaction Nofitication</h4>
                                    <h1 style="color: {{ $MailData['type'] == 'Deposit' ? '#0064cc' : 'red' }}">{{number_format($MailData['amount'], 2)}} USD</h1>
                                </div>
                                <p style="margin-bottom: 10px;">
                                    Dear <strong>{{$MailData['fullname']}}</strong>,
                                </p>
                                <p style="margin-bottom: 10px;">
                                    Kindly take note, the following transaction occured in your account with {{ config('app.name') }}.
                                </p>
                                <div style="display: flex; justify-content: space-between">
                                    <p style="font-weight: bold">Type:</p>
                                    <p style="font-weight: bold">{{ strtoupper($MailData['type']) }}</p>
                                </div>
                                <div style="display: flex; justify-content: space-between">
                                    <p style="font-weight: bold">Balance:</p>
                                    <p style="font-weight: bold">${{number_format($MailData['balance'], 2)}}</p>
                                </div>
                                <div style="display: flex; justify-content: space-between">
                                    <p style="font-weight: bold">Profit:</p>
                                    <p style="font-weight: bold">${{number_format($MailData['profit'], 2)}}</p>
                                </div>
                                <div style="display: flex; justify-content: space-between">
                                    <p style="font-weight: bold">Created At:</p>
                                    <p style="font-weight: bold">{{$MailData['created_at']}}</p>
                                </div>
                                <div style="display: flex; justify-content: space-between">
                                    <p style="font-weight: bold">Ref:</p>
                                    <p>{{$MailData['ref']}}</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

@endsection
