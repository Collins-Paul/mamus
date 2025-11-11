@extends('layouts.index')

@section('title')
    Master Profile
@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Master's Account</h3>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="row gy-gs">
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-center">
                                <div id="blah" style="
                                    width: 175px !important;
                                    height: 200px !important;
                                    background-repeat: no-repeat !important;
                                    background-size: cover !important;
                                    background-position: center !important;
                                    background: url({{ asset('traders-photo/'.$details->photo) }});">
                                    <form action="{{ route('admin.admin.upload.photo') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type='file' id="imgInp" name="image" class="d-none">
                                        <input type="hidden" name="master_id" value="{{ $details->id }}">
                                        <label for="imgInp" class="position-relative fs-4 bg-light" style="
                                        top: -21px;
                                        right: 21px;
                                        padding: 8px;
                                        border-radius: 100%;
                                        height: 45px;
                                        width: 45px;"><em class="icon ni ni-camera" style="
                                        font-size: 26px;
                                        display: flex;
                                        justify-content: center;"></em></label>
                                        <button type="submit" class="position-relative border-0 fs-4 bg-light" style="
                                        top: -21px;
                                        right: 21px;
                                        padding: 8px;
                                        border-radius: 100%;
                                        height: 45px;
                                        width: 45px;"><em class="icon ni ni-upload" style="
                                        font-size: 26px;
                                        display: flex;
                                        justify-content: center;"></em></button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-center">{{ $details->username }}</p>
                            <div class="d-flex justify-content-start my-4 px-3">
                                <span class="text-center"><span class="fw-bold">Firstname: </span>{{ Str::ucfirst($details->fname) }}</span>
                                <span class="text-center ms-3"><span class="fw-bold">Lastname: </span>{{ Str::ucfirst($details->lname) }}</span>
                            </div>
                            <div class="d-flex justify-content-between my-4 px-3">
                                <span class="text-center"><span class="fw-bold">Balance:</span> ${{ number_format($details->balance, 2) }}</span>
                                <span class="text-center"><span class="fw-bold">Bonus:</span> ${{ number_format($details->bonus, 2) }}</span>
                                <span class="text-center"><span class="fw-bold">Equity:</span> ${{ number_format($equity, 2) }}</span>
                            </div>
                        </div>

                        <div  class="col-lg-6">
                            <div class="">
                                <ul class="master-menu">
                                    <li>
                                        @php
                                            if ($details->status != 1) {
                                                $status = '<span class="badge rounded-pill bg-danger">Inactive</span>';
                                            } else {
                                                $status = '<span class="badge rounded-pill bg-success">Active</span>';
                                            }
                                        @endphp
                                        <div class="d-flex justify-content-between">
                                            <span class="fs-6 me-3">Master Status <sup>{!! $status !!}</sup></span>
                                            @if ($details->status == 0 || $details->status == 2)
                                            <a href="{{ route('admin.admin.activate', ['id' => encrypt($details->id), 'who' => 'master']) }}" class="btn  btn-success btn-sm"><em class="icon ni ni-check"></em> Activate</a>
                                            @else
                                            <a href="{{ route('admin.admin.deactivate', ['id' => encrypt($details->id), 'who' => 'master']) }}" class="btn  btn-danger btn-sm">X Deactivate</a>
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex justify-content-between">
                                            <span class="fs-6 me-3">Account Details</span>
                                            <button class="btn  btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editAccount">Edit <em class="icon ni ni-edit"></em></button>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex justify-content-between">
                                            <span class="fs-6 me-3">Min. Investment/Commission</span>
                                            <button class="btn  btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editMiniInvestment">Edit <em class="icon ni ni-edit"></em></button>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex justify-content-between">
                                            <span class="fs-6 me-3">Strategy Description</span>
                                            <button class="btn  btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#strategyDescription">Edit <em class="icon ni ni-edit"></em></button>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex justify-content-between">
                                            <span class="fs-6 me-3">Risk / Expertise</span>
                                            <button class="btn  btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#risksExpertise">Edit <em class="icon ni ni-edit"></em></button>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex justify-content-between">
                                            <span class="fs-6 me-3">Risk Management</span>
                                            <button class="btn  btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#riskManagement">Edit <em class="icon ni ni-edit"></em></button>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="d-flex justify-content-between">
                                            <span class="fs-6 me-3">Trades</span>
                                            <a href="{{route('admin.place.order', ['master_id' => encrypt($details->id), 'master_bal' => encrypt($details->balance)])}}">
                                                <button class="btn  btn-light btn-sm"><em class="icon ni ni-trend-up"></em> Place Order</button>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <ul class="nav nav-tabs nav-tabs-s2">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem9">Opened ({{ $orders->count() }})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem10">Closed ({{ $closed->count() }})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem11">Copy Traders ({{ $copiers->count() }})</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabItem9">
                                    <div class="row">
                                        @include('includes.open-order')
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabItem10">
                                    <div class="row">
                                        @include('includes.closed-order')
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabItem11">
                                    @include('includes.copytrades')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Edit Account Modal -->
<div class="modal fade" id="editAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editAccount" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Account Details</h5>
        </div>
        <form action="{{ route('admin.edit.account') }}" method="post">
        <div class="modal-body">
            @csrf
                <div class="mb-3">
                  <label for="coin_name" class="col-form-label">Balance</label>
                  <input type="text" placeholder="$0.00" value="{{ number_format($details->balance, 2) }}" name="master_balance" class="form-control" id="balance">
                    @error('master_balance')
                        <span id="-error" class="invalid">{{ $message }}</span>
                    @enderror
                </div>

                <input type="hidden" name="id" value="{{ $details->id }}">

                <div class="mb-3">
                    <label for="wallet_address" class="col-form-label">Master's Bonus</label>
                    <input type="text" placeholder="$0.00" value="{{ number_format($details->bonus,2) }}" name="master_bonus" class="form-control" id="bonus">
                      @error('master_bonus')
                          <span id="-error" class="invalid">{{ $message }}</span>
                      @enderror
                </div>

                <div class="mb-3">
                    <label for="leverage" class="col-form-label">Leverage ({{ $details->leverage }})</label>
                    <select name="leverage" id="" class="form-control">
                        <option value="1:2000">1:2000</option>
                        <option value="1:1000">1:1000</option>
                        <option value="1:800">1:800</option>
                        <option value="1:600">1:600</option>
                        <option value="1:500">1:500</option>
                        <option value="1:400">1:400</option>
                        <option value="1:200">1:200</option>
                        <option value="1:100">1:100</option>
                        <option value="1:50">1:50</option>
                        <option value="1:20">1:20</option>
                        <option value="1:2">1:2</option>
                    </select>
                      @error('leverage')
                          <span id="-error" class="invalid">{{ $message }}</span>
                      @enderror
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">CANCEL</button>
            <button type="submit" id="submitDeposit" class="btn btn-success">SAVE</button>
        </div>
        </form>
    </div>
    </div>
</div>

{{-- Minimum Investment & Commission Modal --}}
<div class="modal fade" id="editMiniInvestment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editMiniInvestment" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Minimum Investment & Commission</h5>
        </div>
        <form action="{{ route('admin.edit.minimum.investment') }}" method="post">
        <div class="modal-body">
            @csrf
                <div class="mb-3">
                  <h6 >Current Minimum Investment ${{ number_format($details->minimum_investment, 2) }}</h6>
                  <h6 >Current Commission {{ $details->commission }}%</h6>
                </div>
                <div class="mb-3">
                    <label for="wallet_address" class="col-form-label">Change Amount</label>
                    <input type="text" placeholder="$0.00" value="{{ number_format($details->minimum_investment, 2) }}" name="minimum_investment" class="form-control">
                      @error('minimum_investment')
                          <span id="-error" class="invalid">{{ $message }}</span>
                      @enderror
                </div>
                <div class="mb-3">
                    <label for="wallet_address" class="col-form-label">Change Commission</label>
                    <input type="text" placeholder="$0.00" value="{{ $details->commission }}" name="commission" class="form-control">
                      @error('commission')
                          <span id="-error" class="invalid">{{ $message }}</span>
                      @enderror
                </div>
                <input type="hidden" name="id" value="{{ $details->id }}">
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">CANCEL</button>
            <button type="submit" id="submitDeposit" class="btn btn-success">SAVE</button>
        </div>
        </form>
    </div>
    </div>
</div>

{{-- Strategy Description Modal --}}
<div class="modal fade" id="strategyDescription" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="strategyDescription" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Strategy Description</h5>
        </div>
        <form action="{{ route('admin.edit.strategy.description') }}" method="post">
        <div class="modal-body">
            @csrf
                <div class="mb-3">
                    <label for="wallet_address" class="col-form-label">Description</label>
                    <textarea placeholder="type here" name="strategy_description" class="form-control">{{ trim($details->description) }}</textarea>
                      @error('strategy_description')
                          <span id="-error" class="invalid">{{ $message }}</span>
                      @enderror
                </div>
                <input type="hidden" name="id" value="{{ $details->id }}">
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">CANCEL</button>
            <button type="submit" id="submitDeposit" class="btn btn-success">SAVE</button>
        </div>
        </form>
    </div>
    </div>
</div>

{{-- Risk And Expertise Modal --}}
<div class="modal fade" id="risksExpertise" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="risksExpertise" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Risks/Expertise</h5>
        </div>
        <form action="{{ route('admin.edit.risk.expertise') }}" method="post">
        <div class="modal-body">
            @csrf
                <div class="mb-3">
                    <label for="risk" class="col-form-label">Select Risk</label>
                    <span class="badge rounded-pill bg-success">1-2 Low</span>
                    <span class="badge rounded-pill bg-warning">3-4 Medium</span>
                    <span class="badge rounded-pill bg-danger">5-6 High</span>
                    <select name="risk" id="" class="form-control">
                        <option value="1">1 Low risk</option>
                        <option value="2">2 Low risk</option>
                        <option value="3">3 Medium risk</option>
                        <option value="4">4 Medium risk</option>
                        <option value="5">5 High Risk</option>
                        <option value="6">6 High Risk</option>
                    </select>
                      @error('risk')
                          <span id="-error" class="invalid">{{ $message }}</span>
                      @enderror
                </div>

                <div>
                    <label for="expertise" class="col-form-label">Select Expertise</label>
                    <select name="expertise" id="" class="form-control">
                        <option value="Lengend">Lengend</option>
                        <option value="Expert">Expert</option>
                        <option value="High Achiever">High Achiever</option>
                        <option value="Growing Talent">Growing Talent</option>
                    </select>
                    @error('expertise')
                          <span id="-error" class="invalid">{{ $message }}</span>
                      @enderror
                </div>
                <input type="hidden" name="id" value="{{ $details->id }}">
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">CANCEL</button>
            <button type="submit" id="submitDeposit" class="btn btn-success">SAVE</button>
        </div>
        </form>
    </div>
    </div>
</div>

{{-- Risk management Modal --}}
<div class="modal fade" id="riskManagement" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="riskManagement" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Risk Management</h5>
        </div>
        <form action="{{ route('admin.edit.risk.management') }}" method="post">
        <div class="modal-body">
            @csrf
            <div class="mb-3">
                <h6 >Current Maximum Unrealised Loss -${{ number_format($details->max_unrealised_loss, 2) }}</h6>
                <h6 >Current Maximum Drawdown Duration {{ $details->max_drawndown_duration }}d</h6>
              </div>
              <div class="mb-3">
                  <label for="wallet_address" class="col-form-label">Change Loss Amount</label>
                  <input type="text" placeholder="$0.00" value="{{ number_format($details->max_unrealised_loss, 2) }}" name="max_loss" class="form-control">
                    @error('max_loss')
                        <span id="-error" class="invalid">{{ $message }}</span>
                    @enderror
              </div>
              <div class="mb-3">
                  <label for="wallet_address" class="col-form-label">Change Drawdown Duration</label>
                  <input type="text" placeholder="$0.00" value="{{ $details->max_drawndown_duration }}" name="max_drawdown" class="form-control">
                    @error('max_drawdown')
                        <span id="-error" class="invalid">{{ $message }}</span>
                    @enderror
              </div>
              <input type="hidden" name="id" value="{{ $details->id }}">
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">CANCEL</button>
            <button type="submit" id="submitDeposit" class="btn btn-success">SAVE</button>
        </div>
        </form>
    </div>
    </div>
</div>

@include('includes.script')

@endsection
