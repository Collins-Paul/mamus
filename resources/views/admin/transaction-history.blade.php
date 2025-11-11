@extends('layouts.index')

@section('title')
    All Transaction History
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-between-md g-4">
                        <div class="nk-block-head-content d-flex justify-content-evenly">
                            <div>
                                <h6 class="nk-block-title fw-normal pe-4 pt-1">Total ({{$history->count()}})</h6>
                            </div>
                            <div>
                                <butto class="btn btn-transparent" data-bs-toggle="modal" data-bs-target="#staticBackdrop" type="button"><em class="icon ni ni-trash"></em> Delete All</butto>
                            </div>
                        </div>
                    </div>
                </div>
                @include('includes.transaction-history')
            </div>
        </div>
    </div>

         <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="text-center">
                <div class="pb-2">
                    <img src="{{ asset('assets/images/info.jfif') }}" alt="" width="40">
                </div>
                <h5>Do you want to clear everything?</h5>
                <p>Note: If you click <strong>YES</strong> the entire history will be cleared up permanently.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">CANCEL</button>
            <a href="{{ route('admin.truncate.table', ['table' => 'trans_history']) }}" id="submitDeposit" class="btn btn-danger">YES</a>
        </div>
    </div>
    </div>
</div>
@endsection
