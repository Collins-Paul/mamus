@extends('layouts.index')
@section('title')
    User Wallets
@endsection
@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h6 class="nk-block-title fw-normal pe-4 pt-1">User Wallets</h6>
                    </div>
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools gx-3">
                            <div class="d-flex justify-content-between my-4 px-3">
                                <span class="fs-6 me-3">Enable Private Key</span>
                                <div class="custom-control custom-switch">
                                    <input type="hidden" value="{{ $user->id }}" id="user_id">
                                    <input type="checkbox" {{ $user->phrase == 'yes' ? 'checked' : '' }}
                                        class="custom-control-input" id="can_phrase">
                                    <label class="custom-control-label" for="can_phrase"></label>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php $i=1 ?>
                @forelse($wallets as $key => $value)
                    <div class="border-bottom rounded-3 p-2 col-lg-12 mx-2">
                        <div class="d-flex justify-content-between">
                            <div>{{ $i++ }}</div>
                            <div style="width:95%">
                                <div class="d-flex justify-content-between">
                                    <span>Coin: <span class="fw-bold">{{ Str::ucfirst($value->coin) }}</span></span>
                                    <span>Format: <span class="fw-bold">{{ $value->network == null ? 'N/A' : $value->network }}</span></span>
                                </div>
                                <span class="fw-bold">Address: <span>{{ $value->address }}</span></span>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('user.user.destroy.wallets', ['id' => encrypt($value->id)]) }}" class="text-danger"><em class="icon ni ni-trash"></em> Delete</a>
                                        @if(!is_null($value->phrase))
                                        <a href="{{ route('admin.user.wallet.private.key', ['id' => encrypt($value->id)]) }}"><em class="icon ni ni-key"></em> Private Key</a>
                                        @endif
                                    </div>
                                    <span>Created At: <span>{{ $value->created_at }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h1 class="text-center mt-5">No Wallet</h1>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $('#can_phrase').click(function(e) {
                e.preventDefault();
                user_id = $('#user_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ route('admin.user.wallet.phrase.activate') }}",
                    data: {
                        user_id: user_id
                    },
                    success: function(response) {
                        console.log(response.message);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
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
