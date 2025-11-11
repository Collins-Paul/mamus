@extends('layouts.index')

@section('title')
    Master Traders
@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Master Traders</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have a of total <strong>{{ $masters->count() }}</strong> master traders.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>-</th>
                                                    <th>Master</th>
                                                    <th>Balances</th>
                                                    <th>Copier</th>
                                                    <th>Opened</th>
                                                    <th>Closed</th>
                                                    <th>Status</th>
                                                    <th>Profile</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    use App\Http\Controllers\AppLogicController;
                                                    $i=1;
                                                @endphp
                                                @forelse ($masters as $master)
                                                    @php
                                                        $status = $master->status == 1 ? 'Active' : 'Inactive';
                                                        $status_color = $master->status == 1 ? 'text-success' : 'text-danger';
                                                    @endphp
                                                    <tr>
                                                        <th>{{ $i++ }}</th>
                                                        <th><div class="user-avatar xs bg-primary">
                                                            <span>{{ AppLogicController::getNameInitials($master->fname." ".$master->lname) }}</span>
                                                        </div></th>
                                                        <td>{{ $master->fname." ".$master->lname }}</td>
                                                        <td>$ {{ number_format($master->balance, 2) }}</td>
                                                        <td>{{ AppLogicController::rowCounter('copiers', 'master_id', $master->id) }}</td>
                                                        <td>{{ AppLogicController::ordersCount('opened', $master->id) }}</td>
                                                        <td>{{ AppLogicController::ordersCount('closed', $master->id) }}</td>
                                                        <td><span class="tb-status {{ $status_color }}">{{ $status }}</span></td>
                                                        <td><a href="{{ route('admin.view.master.account', ['id' => encrypt($master->id)]) }}"><em class="icon ni ni-user"></em> Master</a></td>
                                                        <td><a href="{{ route('admin.delete.master', ['id' => encrypt($master->id)]) }}"><em class="icon ni ni-trash text-danger"></em></a></td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="9">No Registered Copy Trader Yet</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div><!-- .nk-tb-list -->
                                </div><!-- .card-inner -->
                        </div><!-- .card-inner-group -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@endsection
