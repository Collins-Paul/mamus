@extends('layouts.index')
@section('title')
    Cards Subscription
@endsection

@section('styles')
    <style>
        .virtual-card:hover {
            cursor: pointer;
            border: 1px solid;
        }
    </style>
@endsection

@section('content')
<?php
    $logo = DB::table('app_logos')->first();
?>
<div class="nk-content nk-content-lg nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <div class="nk-block-head-sub"><span>Available Cards</span></div>
                        <div class="nk-block g-4">
                            <div class="nk-block-head-content">
                                <div class="d-flex justify-content-between">
                                    <h3 class="nk-block-title fw-normal">Cards Store</h3>
                                </div>
                                <div class="nk-block-des">
                                    <p>Here are 3 major card categories with different features, kindly explore...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nk-block mb-5">
                    <div class="container">
                        <div class="row">
                            @forelse ($cards as $card)
                                @php
                                    if($card->category == 'Basic') {
                                        $category = 'Basic';
                                        $bg = 'primary';
                                    } else if ($card->category == 'Platinum') {
                                        $category = 'Platinum';
                                        $bg = 'warning';
                                    } else {
                                        $category = 'Master';
                                        $bg = 'success';
                                    }

                                    if(is_numeric($card->max_withdrawal)) {
                                        $max_withdrawal = Auth::user()->currency[0]['symbol'] ." " . number_format($card->max_withdrawal, 2);
                                    } else {
                                        $max_withdrawal = $card->max_withdrawal;
                                    }
                                @endphp
                                <div class="col-lg-4 mb-5">
                                    <div class="shadow p-2 rounded position-relative virtual-card" id="{{ $card->id }}">
                                        <p class="position-absolute" style="right: 12px; top: -15px;"><span class="badge text-bg-{{ $bg }}">{{ $category  }}</span></p>
                                        <div class="d-flex justify-content-between mb-2 align-items-center border-bottom border-b-1 pb-1">
                                            <img width="40" src="{{ asset('assets/logo/' . $logo->logo) }}" alt="">
                                            <p>Virtual Card</p>
                                        </div>
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Registration Fee</p>
                                                <p class="fw-bold">{{ Auth::user()->currency[0]['symbol'] }} {{ number_format($card->reg_fee, 2) }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Max. Withdrawal</p>
                                                <p class="fw-bold">{{ $max_withdrawal }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Duration</p>
                                                <p class="fw-bold">{{ $card->duration }} Years</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="mb-0">Networks</p>
                                                <p class="fs-1">
                                                    <em class="icon ni ni-cc-visa"></em>
                                                    <em class="icon ni ni-american-express"></em>
                                                    <em class="icon ni ni-cc-mc"></em>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-12 shadow">
                                    <h4 class="text-center py-5">No Card</h4>
                                </div>
                            @endforelse

                            <form action="{{ route('user.user.create.user-card.proceed') }}" method="post" class="sendID">
                                @csrf
                                <input type="hidden" name="card_id" value="" id="card_id">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.virtual-card').click(function (e) {
                e.preventDefault();
                $('.card-preloader').remove();
                var preloader = `<div class="card-preloader position-absolute d-flex justify-content-center top-0 start-0 bottom-0 end-0 align-items-center rounded" style="background: rgba(0, 0, 0, 0.2);">
                                        <div class="text-center">
                                            <div class="spinner-border" role="status">
                                              <span class="visually-hidden">Loading...</span>
                                            </div>
                                          </div>
                                    </div>`;
                var id = $(this).attr('id');
                $('#'+id).prepend(preloader);
                $("#card_id").val(id);

                setTimeout(() => {
                    $('form').submit();
                }, 2000);
            });
        });
    </script>
@endsection
