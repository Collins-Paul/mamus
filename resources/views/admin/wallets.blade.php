@extends('layouts.index')
@section('title')
    Wallets
@endsection
@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h6 class="nk-block-title fw-normal pe-4 pt-1">System Wallets</h6>
                    </div>
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools gx-3">
                            <li><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" type="button"><span>New Wallet</span> <em class="icon ni ni-plus"></em></button></li>
                            <li><a href="{{ route('admin.truncate.table', ['table' => 'wallets']) }}" class="btn btn-danger"><em class="icon ni ni-trash d-none d-sm-inline-block"></em><span>Delete All</span></a></li>
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
                                    <span>Coin: <span class="fw-bold">{{ Str::ucfirst($value->wallet_name) }}</span></span>
                                    <span>Format: <span class="fw-bold">{{ $value->wallet_format == null ? 'N/A' : $value->wallet_format }}</span></span>
                                </div>
                                <span class="fw-bold">Address: <span>{{ $value->wallet_address }}</span></span>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('admin.delete.wallet', ['id' => encrypt($value->id)]) }}" class="text-danger"><em class="icon ni ni-trash"></em> Delete</a>
                                        <a href="{{ asset('/wallets-qrcode/'.$value->qr_code) }}" class="text-primary">QR-Code</a>
                                    </div>
                                    <span>Created At: <span>{{ $value->created_at }}</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
</div>

     <!-- Modal -->
     <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.createWallets') }}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                    <div class="mb-3 d-flex justify-content-center">
                        <div style="width: 100px">
                            <div class="text-center" style="width: 100%">
                                <img src="" id="blah" class="img-fluid rounded mb-3" alt="">
                                <label for="imgInp" class="btn btn-outline-primary">QR-CODE</label>
                            </div>
                            <input type='file' id="imgInp" name="image" style="display: none">
                        </div>
                    </div>

                    <div class="mb-3">
                      <label for="coin_name" class="col-form-label">Wallet/Coin Name</label>
                      <input type="text" placeholder="Name of Coin" name="wallet_name" class="form-control" id="coin_name">
                        @error('wallet_name')
                            <span id="-error" class="invalid">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="wallet_address" class="col-form-label">Wallet Address</label>
                        <input type="text" placeholder="Wallet Address" name="wallet_address" class="form-control" id="adddress">
                          @error('wallet_address')
                              <span id="-error" class="invalid">{{ $message }}</span>
                          @enderror
                    </div>

                    <div class="mb-3">
                        <label for="wallet_format" class="col-form-label">Wallet Format</label>
                        <input type="text" placeholder="Address Format (Optional)" name="wallet_format" class="form-control" id="wallet_format">
                          @error('wallet_format')
                              <span id="-error" class="invalid">{{ $message }}</span>
                          @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">CANCEL</button>
                <button type="submit" id="submitDeposit" class="btn btn-success">Create</button>
            </div>
            </form>
        </div>
        </div>
    </div>
@endsection

@section('img-preview')
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>

    <script>
        icon.onchange = evt => {
            const [file] = icon.files
            if (file) {
                favicon.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
