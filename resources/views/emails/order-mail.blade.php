@extends('layouts.emails')

@section('title')
    Order Mail
@endsection

@section('content')
<table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
    <tbody>
        <tr>
            <td style="padding: 30px 30px 20px">
                <div style="text-align: center; margin-bottom: 10px;">
                    <h4 style="margin-bottom: 10px;">Trade Order Nofitication</h4>
                    <h1 style="color: {{ $MailData['pl'] < 0 ? 'red' : 'green' }}">{{number_format($MailData['pl'], 2)}} USD</h1>
                </div>
                <div style="display: flex; justify-content: space-between">
                    <p style="font-weight: bold">Order:</p>
                    <p style="font-weight: bold; text-align: right">{{ strtoupper($MailData['order']) }}</p>
                </div>
                <div style="display: flex; justify-content: space-between">
                    <p style="font-weight: bold">Symbol:</p>
                    <p style="font-weight: bold; text-align: right">{{$MailData['currency_pair']}}</p>
                </div>
                <div style="display: flex; justify-content: space-between">
                    <p style="font-weight: bold">Margin:</p>
                    <p style="font-weight: bold; text-align: right">${{number_format($MailData['margin'], 2)}}</p>
                </div>
                <div style="display: flex; justify-content: space-between">
                    <p style="font-weight: bold">Opening Price:</p>
                    <p style="font-weight: bold; text-align: right">{{$MailData['opening_price']}}</p>
                </div>
                <div style="display: flex; justify-content: space-between">
                    <p style="font-weight: bold">Closing Price:</p>
                    <p style="font-weight: bold; text-align: right">{{$MailData['closing_price']}}</p>
                </div>
                <div style="display: flex; justify-content: space-between">
                    <p style="font-weight: bold">Created At:</p>
                    <p style="font-weight: bold; text-align: right">{{$MailData['created_at']}}</p>
                </div>
                <div style="display: flex; justify-content: space-between">
                    <p style="font-weight: bold">Order ID:</p>
                    <p style="text-align: right">{{$MailData['ref']}}</p>
                </div>
                <div style="display: flex; justify-content: space-between">
                    <p style="font-weight: bold">Status:</p>
                    <p style="font-weight: bold; text-align: right">{{$MailData['status']}}</p>
                </div>
            </td>
        </tr>
    </tbody>
</table>
@endsection
