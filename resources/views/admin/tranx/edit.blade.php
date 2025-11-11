@extends('layouts.auth')


@section('title')
    Edit Transaction
@endsection

@section('content')
 <div class="container">
    <div class="row">
        {{-- Recent Transactions --}}
        <h4 class="text-center mt-5">Edit Transaction Details</h4>
        <div class="col-md-7 col-xxl-7 col-lg-7 mx-auto">
            <div class="d-flex justify-content-between border rounded shadow my-3 align-items-center py-1 px-2 bg-dark">
                <p class="fs-2 fw-bold text-center text-white mb-0">{{$details->type}}</p>
                <p class="fs-2 fw-bold text-center text-white">{{number_format($details->amount, 2)}}</p>
            </div>

            <div class="mt-2">
                <form action="{{route('admin.admin.update.sending.wallet')}}" method="post">
                    @csrf
                    <label for="" class="fs-6 mb-1">Edit Sending Wallet</label>
                    <input type="text" value="{{!is_null($sending) ? $sending->wallet : ''}}" class="form-control mb-2" name="address" placeholder="Enter wallet here">
                    <input type="hidden" value="{{$details->id}}" name="tranx_uid">
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>

            <div class="mb-2">
                <form action="{{route('admin.admin.update.recieving.wallet')}}" method="post">
                @csrf
                    <label for="" class="fs-6 mb-1">Edit Receiving Wallet</label>
                    <input type="text" name="address" value="{{!is_null($recieving) ? $recieving->wallet : ''}}" class="form-control mb-2" placeholder="Enter wallet here">
                    <input type="hidden" value="{{$details->id}}" name="tranx_uid">
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>

            <div class="">
                <form action="{{route('admin.admin.update.height')}}" method="post">
                @csrf
                    <label for="" class="fs-6 mb-1">Edit Height</label>
                    <input type="text" name="height" value="{{!is_null($network) ? $network->height : ''}}" class="form-control mb-2" placeholder="Enter height here">
                    <input type="hidden" value="{{$details->id}}" name="tranx_uid">
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>

            @if (!is_null($network))
            <hr>
            <p class="fs-6 mb-1">Network Fee Payment</p>
            <div class="border rounded shadow my-3 py-2 bg-dark px-2 text-white">
                <div class="d-flex justify-content-between mb-2">
                    <p class="mb-0">Network Type</p>
                    <p>{{strtoupper($network->network_type)}}</p>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <p class="mb-0">Fee Paid</p>
                    <p>{{$network->network_fee}}</p>
                </div>
                <div class="mb-2">
                    <p class="mb-0">To:</p>
                    <p>{{$network->to}}</p>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <p class="mb-0">Status</p>
                    <p class="fw-bold">{{$network->status == 0 ? 'Pending (Not Paid Yet)' : 'Approved'}}</p>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <p class="mb-0">Created At</p>
                    <p class="fw-bold">{{$network->created_at}}</p>
                </div>

                <form action="{{route('admin.admin.tranx.fee.approve')}}" method="post">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-6 col-lg-4">
                            <p class="mb-0">Add fee to amount</p>
                        </div>
                        <div class="col-6 col-lg-8">
                            <select name="add" id="" class="w-100">
                                <option value="no">NO</option>
                                <option value="yes">YES</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <a href="{{route('admin.admin.tranx.fee.delete', ['id' => encrypt($network->id)])}}" class="mb-0 btn btn-block btn-outline-danger mx-1">Delete</a>
                        <input type="hidden" name="id" value="{{$network->trans_history_id}}">
                        <button type="submit" class="mb-0 btn btn-block btn-outline-success mx-1">Approve</button>
                    </div>
                </form>
            </div>
            @endif

            <hr>

            <div class="mb-5">
                <form action="{{route('admin.admin.update.message')}}" method="post">
                @csrf
                    <label for="" class="fs-5 mb-1">Reason/Description</label>
                    <textarea name="message" class="form-control no-resize" id="default-textarea" placeholder="Type here...">{{!is_null($message) ? $message->message : '- - -'}}</textarea>
                    <input type="hidden" value="{{$details->id}}" name="tranx_uid">
                    <div class="text-end mt-2">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@endsection
