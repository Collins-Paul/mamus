@extends('layouts.index')

@section('title')
    All Cards
@endsection

@section('styles')
    <style>
        th, td {
            text-wrap: nowrap !important;
        }
    </style>
@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h6 class="nk-block-title page-title"><em class="icon ni ni-cards"></em> All Virtual Cards</h6>
                        <div class="nk-block-des text-soft">
                            <ul class="list-inline">
                                <li>List of all Cards</li>
                            </ul>
                        </div>
                    </div><!-- .nk-block-head-content -->
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                  <tr>
                                      <th>S/N</th>
                                      <th>Card Holder Name</th>
                                      <th>Card Number</th>
                                      <th>CVV</th>
                                      <th>Card Type</th>
                                      <th>Network</th>
                                      <th>Payment Receipt</th>
                                      <th>Details</th>
                                      <th>Status</th>
                                      <th>Activate/Deactivate</th>
                                      <th>Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                  @forelse ($cards as $details)
                                    @php
                                        if($details->status == 0) {
                                            $status = '<span class="badge text-warning">Pending</span>';
                                            $color = 'success';
                                        } else {
                                            $status = '<span class="badge text-success">Approved</span>';
                                            $color = 'danger';
                                        }

                                        if(!is_null($details->payment_receipt)) {
                                            $link = '/receipts/'.$details->payment_receipt;
                                            $text = 'View';
                                        } else {
                                            $link = '#';
                                            $text = 'N/A';
                                        }
                                    @endphp
                                      <tr>
                                          <td>{{ $i++ }}</td>
                                          <td>{{ $app->getUserNames($details->user_id) }}</td>
                                          <td>{{ $details->card_no }}</td>
                                          <td>{{ $details->cvv }}</td>
                                          <td>{{ $details->type }}</td>
                                          <td>{{ $details->network }}</td>
                                          <td class="text-center"><a href="{{ $link }}">{{ $text }}</a></td>
                                          <td class="text-center"><a href="{{ route('admin.show.admin.card', ['id' => encrypt($details->user_id)]) }}">details</a></td>
                                          <td>{!! $status !!}</td>
                                          <td class="text-center"><a href="{{ route('admin.users.toggle.cards', ['id' => encrypt($details->id)]) }}" class="btn btn-sm btn-outline-{{ $color }}">Click</a></td>
                                          <td><a href="{{ route('admin.users.delete.cards', ['id' => encrypt($details->id)]) }}"><em class="icon ni ni-trash fs-3 text-danger"></em></a></td>
                                      </tr>
                                  @empty
                                      <tr>
                                        <td colspan='10' class="text-center py-3"><p>No Card(s)</p></td>
                                      </tr>
                                  @endforelse
                                </tbody>
                              </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
