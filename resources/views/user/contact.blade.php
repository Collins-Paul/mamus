@extends('layouts.index')

@section('title')
    Contact Us
@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="px-3">
                <h5>Corresponding Address</h5>
                <p>{{ $contactsInfo->address }}</p>
            </div>
        </div>
    </div>
    <div class="px-3">
        <div class="w-100">
            <div class="my-2">
                <p class="mb-0"><strong>Got a question?</strong></p>
                <a href="{{ $liveChat->url }}" target="_blank" class="btn btn-success"><em class="icon ni ni-headphone pe-2"></em> START LIVECHART</a>
            </div>
        </div>
    </div>
</div>
@endsection
