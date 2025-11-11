@extends('layouts.index')

@section('title')
    {{ $type }} Order
@endsection

@section('content')
    <div class="nk-content nk-content-fluid py-0">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="row g-2 my-5">
                    <div class="">
                        <h6>All Copy-{{ $type }} Order ({{ $copiers->count() }})</h6>
                    </div>
                    @include('includes.copytrades')
                </div>
            </div>
        </div>
    </div>

    @include('includes.script')

@endsection
