@extends('layouts.index')

@section('title')
    Copy Setup
@endsection

@section('content')

<style>
    .copy-card {
        padding-right: calc(var(--bs-gutter-x) * 0.2) !important;
        padding-left: calc(var(--bs-gutter-x) * 0.2) !important;
    }
</style>

    <div class="nk-content nk-content-fluid p-1">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head pb-2 pt-5 mt-5 px-2">
                    <div class="g-4">
                        <div class="d-flex">
                            <div style="
                            width: 50px !important;
                            height: 50px !important;
                            border-radius: 100px !important;
                            background-position: center !important;
                            background-size: contain !important;
                            background: url({{ asset('traders-photo/'.$masterInfo->photo) }});
                            "></div>
                            <div class="master-name ms-2 d-flex align-items-center">
                                <div>
                                    <p class="fs-6 fw-bold">{{ Str::ucfirst($masterInfo->username) }}</p>
                                    <p>{{ $masterInfo->commission }}% Commission</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nk-block-head px-2">
                    <div class="g-4">
                        <div class="pb-2 my-3">
                            <div class="d-flex justify-content-between border-bottom mb-3 pb-3">
                                <p class="m-0 fw-bold">Funds in Wallet</p>
                                <p class="m-0 fw-bold"><em class="icon ni ni-wallet-alt"></em> <span class="balance">{{ number_format($bal->balance, 2) }}</span> USD</p>
                            </div>

                            <p class="m-o mb-3 fw-bold">Copy Proportion</p>

                            <div class="row text-center mb-3">
                                <div class="col-lg-4 col-4 copy-card">
                                    <label class="shadow-sm border rounded py-1 w-100 selected-card" id="x1-card" for="x1">
                                        <input type="hidden" class="x1-card" value="x1" name="proportion" id="x1" onclick="getData(this.id)">
                                        <p class="mb-0 prop-type-x1">Equal x1</p>
                                        <p style="font-size: 11px; margin-bottom: 0.1rem; font-weight: bold">$<span class="min-invest-x1">{{ number_format($masterInfo->minimum_investment) }}</span> required</p>
                                        <span style="font-size: 11px;">x1 volume</span>
                                    </label>
                                </div>

                                <div class="col-lg-4 col-4 copy-card">
                                    <label class="shadow-sm border rounded py-1 w-100 selected-card" id="x2-card" for="x2">
                                        <input type="hidden" class="x2-card" value="x2" name="proportion" id="x2" onclick="getData(this.id)">
                                        <p class="mb-0 prop-type-x2">Double x2</p>
                                        <p style="font-size: 11px; margin-bottom: 0.1rem; font-weight: bold">$<span class="min-invest-x2">{{ number_format($masterInfo->minimum_investment) * 2 }}</span> required</p>
                                        <span style="font-size: 11px;">x1 volume</span>
                                    </label>
                                </div>

                                <div class="col-lg-4 col-4 copy-card">
                                    <label class="shadow-sm border rounded py-1 w-100 selected-card" id="x3-card" for="x3">
                                        <input type="hidden" class="x3-card" value="x3" name="proportion" id="x3" onclick="getData(this.id)">
                                        <p class="mb-0 prop-type-x3">Tripple x3</p>
                                        <p style="font-size: 11px; margin-bottom: 0.1rem; font-weight: bold">$<span class="min-invest-x3">{{ number_format($masterInfo->minimum_investment) * 3 }}</span> required</p>
                                        <span style="font-size: 11px;">x1 volume</span>
                                    </label>
                                </div>
                            </div>

                                <p class="m-o mb-3 fw-bold">Summary</p>
                                    <div class="d-flex justify-content-between border-bottom mb-3">
                                        <p class="m-0">Copy Proportion</p>
                                        <p class="m-0"><span class="prop-type"></span></p>
                                        <input id="prop-type" type="hidden" name="prop-type">
                                    </div>

                                    <div class="d-flex justify-content-between border-bottom pt-2 mb-3">
                                        <p class="m-0">Min Investment</p>
                                        <p class="m-0"><span class="min_invest">${{ number_format($masterInfo->minimum_investment, 2) }}</span></p>
                                        {{-- <input id="min_invest" type="hidden" value="{{ number_format($masterInfo->minimum_investment, 2) }}" name="min_invest"> --}}
                                    </div>

                                    <div class="d-flex justify-content-between border-bottom pt-2 mb-3">
                                        <p class="m-0">Required Investment</p>
                                        <p class="m-0"><span class="required-invest">$ 0.00</span></p>
                                        {{-- <input id="required-invest" type="hidden" name="required-invest"> --}}
                                    </div>

                                    <div class="d-flex justify-content-between border-bottom pt-2 mb-3">
                                        <p class="m-0">Commission (<span class="comm-percent">{{ $masterInfo->commission }}</span>%)</p>
                                        <p class="m-0"><span class="commission"></span></p>
                                        {{-- <input id="commission" type="hidden" name="commission"> --}}
                                    </div>

                                    <div class="d-flex justify-content-between border-bottom pt-2">
                                        <p class="m-0 fw-bold">Total</p>
                                        <p class="m-0 fw-bold"><span class="total">$ 0.00</span></p>
                                        {{-- <input id="total" type="hidden" name="total"> --}}
                                    </div>
                                </div>
                                    <input type="hidden" name="order_id" id="order_id" value="{{ $id }}">
                                <div style="display: none" id="submit-btn">
                                    <button type="button" class="btn btn-lg btn-block btn-primary start-copy">Start Copying</button>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
         function getData(id){
                var min_invest = document.querySelector('.min-invest-'+id).innerHTML;
                var balance = document.querySelector('.balance').innerHTML;
                balance = balance.replace(',', '');

                if(parseInt(balance) < parseInt(min_invest)){
                    alert('Insufficient Funds');
                    return;
                }

                var prop_type = document.querySelector('.prop-type-'+id).innerHTML;

                document.querySelector('.prop-type').innerHTML = prop_type;
                document.querySelector('.required-invest').innerHTML = '$'+min_invest;

                var percent = document.querySelector('.comm-percent').innerHTML;
                var commission = (parseInt(min_invest) * parseInt(percent)) / 100;

                document.querySelector('.commission').innerHTML = '$'+commission;
                var total = parseInt(min_invest) + commission;
                document.querySelector('.total').innerHTML = '$'+ total;

                document.querySelector('#submit-btn').style.display = 'block';
            }

        $(document).ready(function () {
            $('.selected-card').click(function (e) {
                e.preventDefault();
                var id = this.id;
                $('.selected-card').css({
                    'background-color': 'white',
                    'color': '#4d4d4d',
                });
                $('#'+id).css({
                    'background-color': 'orange',
                    'color': 'white',
                });

                $('.'+id).click();
            });

            $('.start-copy').click(function (e) {
                e.preventDefault();

                prop_type = $('.prop-type').text();
                min_invest = $('.min_invest').text();
                required_invest = $('.required-invest').text();
                commission = $('.commission').text();
                total = $('.total').text();
                order_id = $('#order_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.copytrading.order') }}",
                    data: {
                        prop_type: prop_type,
                        min_invest: min_invest,
                        required_invest: required_invest,
                        commission: commission,
                        total: total,
                        order_id: order_id
                    },
                    success: function (response) {
                        if(response.status == 200) {
                            console.log(response.message);
                            const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                icon: 'success',
                                title: response.message
                            })
                        } else {
                                    const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                })

                                Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                        }
                    }
                });
            });
        });
    </script>
@endsection
