@extends('layouts.index')

@section('title')
    User Card
@endsection

@section('content')

  <h2>Card Status: {{ $card->status == 1 ? 'Active' : 'Inactive' }}</h2>

  <div class="nk-content nk-content-fluid">
    @include('includes.card')
    <div class="row mt-5">
        @php
            if($cardDetails->category == 'Basic') {
                $category = 'Basic';
                $bg = 'primary';
            } else if ($cardDetails->category == 'Platinum') {
                $category = 'Platinum';
                $bg = 'warning';
            } else {
                $category = 'Master';
                $bg = 'success';
            }

            if(is_numeric($cardDetails->max_withdrawal)) {
                $max_withdrawal = $user->currency[0]['symbol'] ." " . number_format($cardDetails->max_withdrawal, 2);
            } else {
                $max_withdrawal = $cardDetails->max_withdrawal;
            }
        @endphp


            <div class="col-lg-6 px-5">
                <h6>Card Status Info</h6>
                <div class="shadow border rounded py-3 position-relative">
                    <div class="px-3">
                        <p class="position-absolute" style="right: 12px; top: -15px;"><span class="badge text-bg-{{ $bg }}">{{ $category  }}</span></p>
                        <div class="d-flex justify-content-between mb-2 align-items-center border-bottom border-b-1 pb-1">
                            <img width="100" src="{{ asset('assets/logo/' . $logo->logo) }}" alt="">
                            <p>Virtual Card</p>
                        </div>
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-0">Registration Fee</p>
                                        <p class="fw-bold">{{ $user->currency[0]['symbol'] }} {{ number_format($cardDetails->reg_fee, 2) }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-0">Max. Withdrawal</p>
                                        <p class="fw-bold">{{ $max_withdrawal }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="mb-0">Duration</p>
                                        <p class="fw-bold">{{ $cardDetails->duration }} Years</p>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
          </div>
  </div>

    <script>
        $('.show-number').click(function(e) {
                e.preventDefault();
                if ($('.card-number').attr('type') == 'password') {
                    $('.card-number').attr('type', 'text');
                    $('.cvv-number').attr('type', 'text');

                    $('.show-icon').removeClass('ni-eye-off');
                    $('.show-icon').addClass('ni-eye');
                } else {
                    $('.card-number').attr('type', 'password');
                    $('.cvv-number').attr('type', 'password');

                    $('.show-icon').removeClass('ni-eye');
                    $('.show-icon').addClass('ni-eye-off');
                }
            });
    </script>
@endsection
