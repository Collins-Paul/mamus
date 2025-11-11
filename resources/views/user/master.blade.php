@extends('layouts.index')

@section('title')
    Master rating
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="row">
            <?php use App\Models\Copier; ?>
           @forelse ($masters as $master)

           <?php
            //count the number of copiers the master has
            $getCopiers = Copier::where('master_id' ,$master->id)->get();

            if ($master->capital == 0.00) {
               $gain = 0;
            } else {
                $gain = ($master->profit/$master->capital) * 100;
            }

            //set the color of the risk badge
           if($master->risk_score <=2) {
                $color = 'bg-success';
           } elseif($master->risk_score <=4) {
                $color = 'bg-warning';
           } else {
                $color = 'bg-danger';
           }
           ?>
            <div class="col-lg-12 ps-2 pe-0 mb-3">
            <a href="{{ route('user.masterperformance', ['id' => encrypt($master->id)]) }}" class="masters-link">
                <div class="shadow p-2 border rounded-3 mx-2">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div style="
                            width: 50px !important;
                            height: 50px !important;
                            border-radius: 100px !important;
                            background-position: center !important;
                            background-size: contain !important;
                            background: url({{ asset('traders-photo/'.$master->photo) }});
                            "></div>
                            <div class="master-name ms-2">
                                <p class="fw-bold">{{ $master->username }}</p>
                                <p><em class="icon ni ni-star"></em> {{ $master->expertise }}</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge rounded-pill {{ $color }}"> {{ $master->risk_score }} risk</span>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="pb-2 d-flex justify-content-between">
                        <div>
                            <p class="mb-0">Gain</p>
                            <h6 class="text-success">{{ number_format($gain, 2) }}%</h6>
                        </div>
                        <div>
                            <p class="mb-0">Copiers</p>
                            <h6>{{ $getCopiers->count() }}</h6>
                        </div>
                        <div>
                            <p class="mb-0">Commission</p>
                            <h6 class="text-success">{{ $master->commission }}%</h6>
                        </div>
                    </div>
                    <div class="border-bottom pb-1 border-3 border-success d-flex justify-content-between">
                        <div>
                            <p class="mb-0">Profit and loss</p>
                            <h6>$ {{ $master->profit }}</h6>
                        </div>
                        <div class="d-flex align-items-end">
                            <h6>$ {{ $master->loss }}</h6>
                        </div>
                    </div>
                </div>
            </a>
            </div>
           @empty
            <div class="col-lg-12 ps-2 pe-0 mb-3">
                <h3>No Master Trader</h3>
            </div>
           @endforelse
        </div>

        {{-- <div class="position-fixed p-2 bg-black text-white rounded-circle" style="bottom: 12%; right: 3%; z-index: 1000; width: 50px; height:50px">
            <em class="fs-3 icon ni ni-opt-dot-alt"></em>
        </div> --}}

        @include('includes.bottomnav')
    </div>
@endsection
