@extends('layouts.index')
@section('title')
    All Copy Traders
@endsection
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">All Investors/Traders</h4>
                            <div class="nk-block-des">
                                <p>A full list of the traders accounts</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="mb-2 d-flex justify-content-end">
                        <form action="" method="get">
                            <div class="d-flex">
                                <input type="search" class="form-control px-2" placeholder="Search by name">
                                <a href="#" class="btn btn-light ms-1"><em class="icon ni ni-search"></em></a>
                            </div>
                        </form>
                    </div> --}}
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Details</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; ?>
                                        @forelse ($traders as $trader)
                                            <?php
                                                //Skip admin account and continue
                                                if ($trader->who == 2) { continue; }
                                            ?>
                                            @php
                                            //check the user account status
                                                if ($trader->status == 0) {
                                                    $status = '<span class="badge rounded-pill bg-danger">Unverified</span>';
                                                } else if ($trader->status == 2) {
                                                    $status = '<span class="badge rounded-pill bg-danger">Suspended</span>';
                                                } else if ($trader->status == 3) {
                                                    $status = '<span class="badge rounded-pill bg-warning">Review</span>';
                                                } else {
                                                    $status = '<span class="badge rounded-pill bg-success">Verified</span>';
                                                }
                                            @endphp
                                            <tr>
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $trader->first_name }}</td>
                                                <td>{{ $trader->last_name }}</td>
                                                <td>{{ $trader->email }}</td>
                                                <td>{{ $trader->created_at }}</td>
                                                <td>{!! $status !!}</td>
                                                <td><a href="{{ route('admin.view.user.profile', ['id' => encrypt($trader->id)]) }}"><em class="icon ni ni-user"></em> Profile</a></td>
                                                <td><a href="{{ route('admin.delete.user', ['id' => encrypt($trader->id)]) }}"><em class="icon ni ni-trash text-danger"></em></a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">No Registered Copy Trader Yet</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- .card-preview -->
                </div>
            </div>
        </div>
    </div>
@endsection
