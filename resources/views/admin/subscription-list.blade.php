@extends('layouts.index')

@section('title')
    Robot datascription
@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Subscribed Robots List</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have a of total <strong>{{ $sub->count() }}</strong> Robot Subscription.</p>
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
                                                    <th>Plan</th>
                                                    <th>Price</th>
                                                    <th>Robot ID</th>
                                                    <th>Date</th>
                                                    <th>Due Date</th>
                                                    {{-- <th>Client Name</th> --}}
                                                    <th>Receipt</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=1;
                                                @endphp
                                                @forelse ($sub as $data)
                                                    @php
                                                        $status_color = $data->status == 'active' ? 'text-success' : 'text-warning';
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td class="fw-bold">{{ $data->plan_title }}</td>
                                                        <td  class="fw-bold">${{ number_format($data->price, 2) }}</td>
                                                        <td>{{ $data->robot_id }}</td>
                                                        <td>{{ $data->purchase_date }}</td>
                                                        <td>{{ $data->exp_date }}</td>
                                                        {{-- <td>{{ $data->client_name }}</td> --}}
                                                        @if($data->plan_title == '1 Week Free')
                                                        <td>N/A</td>
                                                        @else
                                                        <td><a href="{{ url('/receipt/'.$data->reciept) }}">View</a></td>
                                                        @endif
                                                        <td class="{!! $status_color !!}">{{ $data->status }}</td>
                                                        <td>
                                                            @if($data->status == 'processing')
                                                            <a href="{{ route('admin.activate.robot', ['id' => encrypt($data->id)]) }}">Activate |</a>
                                                            @endif
                                                            <a href="{{ route('admin.delete.robot', ['id' => encrypt($data->id)]) }}">Delete</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="9" class="text-center">No datascription Yet</td>
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
