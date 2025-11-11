@extends('layouts.index')

@section('title')
    Update WhatsApp Widget
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="d-flex justify-content-between">
                                <h4 class="title nk-block-title">WhatsApp No.</h4>
                                <div class="custom-control custom-switch">
                                    <input type="hidden" value="{{ $info->status }}" id="off">
                                    <input type="checkbox"  {{ $info->status == 1 ? 'checked' : '' }}  class="custom-control-input" id="status_toggle">
                                    <label class="custom-control-label" for="status_toggle"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <p>Current WhatsApp Number: <strong>{{ $info->number }}</strong></p>

                            <form action="{{ route('admin.admin.whatsapp.update') }}" class="form-validate is-alter" novalidate="novalidate" method="post">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="fva-full-name">New Phone No.</label>
                                            <div class="form-control-wrap">
                                                <input type="text" placeholder="Paste new phone number here" class="form-control" id="fva-full-name" name="phone" required="">
                                                @error('phone')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
        $('#status_toggle').click(function (e) {
            e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "get",
                    url: "{{ route('admin.admin.whatsapp.status') }}",
                    success: function (response) {
                        // console.log(response.message);
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
                            });
                            location.reload();
                    }
                });
        });
    });
    </script>
@endsection
