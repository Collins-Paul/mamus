 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="p-3 shadow rounded-3 my-3 mx-3">
            <h6>How it works</h6>
            <p>Copy one of the wallet addresses below into your exchange app or click any of our trusted vendor below. Next, specify the deposit amount right in your exchange app.</p>
        </div>
        <div class="modal-body">
            <form action="{{ route('user.submitDeposit') }}" method="post">
                @csrf
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Amount (USD):</label>
                      <input type="text" placeholder="Enter {{ $method }} amount in USD" name="amount" class="form-control" id="amount">
                        @error('amount')
                            <span id="-error" class="invalid">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Choose Wallet:</label>
                        <select name="wallet_name" id="wallet_name" class="form-control">
                            <option value="0">Choose wallet</option>
                            @foreach ($allWallets as $name)
                                <option value="{{$name->id}}">
                                    {{ Str::ucfirst($name->wallet_name)}} {{ !is_null($name->wallet_format) ? " (".($name->wallet_format).")" : null }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Wallet Address</label>
                        <input placeholder="Click address to copy" readonly type="text" name="wallet_address" class="form-control" id="wallet_address" onclick="copyText('wallet_address')">
                        @error('wallet_address')
                            <span id="-error" class="invalid">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <img src="" alt="" id="qr_code" style="width: 200px">
                    </div>

                    <p>Kindly click any of our trusted vendor below to proceed for the transaction</p>
                    <div class="my-3 d-flex justify-content-evenly">
                        <a href="https://www.moonpay.com/buy" target="_blank"><img src="{{ asset('assets/images/moonpay.svg') }}" alt="" style="width: 100px"></a>
                        <a href="https://buy.bitcoin.com/btc/" target="_blank"><img src="{{ asset('assets/images/bitcoin-com.png') }}" alt="" style="width: 100px"></a>
                    </div>
                    <div class="my-3 d-flex justify-content-evenly">
                        <a href="https://www.coinomi.com/en/buy/simplex/" target="_blank"><img src="{{ asset('assets/images/coinomi.png') }}" alt="" style="width: 100px"></a>
                        <a href="https://paybis.com/" target="_blank"><img src="{{ asset('assets/images/paybis.png') }}" alt="" style="width: 100px"></a>
                    </div>
            </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" id="submitDeposit" style="display: none" class="btn btn-success">I've Made Deposit</button>
        </div>
    </form>
    </div>
    </div>
</div>

<script>
    //get the selected wallet address on change
    $(document).ready(function(){
      $('#wallet_name').change(function (e) {
        e.preventDefault();
            var wallet_name = document.querySelector('#wallet_name').value;
            $.get("/user/show-wallet/"+ wallet_name, function(data, status){
                console.log(data);
                document.querySelector('#wallet_address').value = data['wallet_address'];
                document.querySelector('#qr_code').src = '/wallets-qrcode/'+data['qr_code'];
            });
        });

       $('#amount').keyup(function (e) {
            $('#submitDeposit').css('display', 'block');
       });

    });
</script>


