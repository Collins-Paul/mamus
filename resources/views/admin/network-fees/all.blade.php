@extends('layouts.index')

@section('title')
    All Network Fees
@endsection

@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Lable</th>
                                                    <th>Percentage</th>
                                                    <th>Type</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @forelse ($fees as $data)
                                                    <tr>
                                                        <th>{{ $i++ }}</th>
                                                        <th>{{ $data->type }}</th>
                                                        <th>{{ $data->percentage }}</th>
                                                        <th>{{ $data->network }}</th>
                                                        <td><a href="{{ route('admin.admin.fees.destroy', ['id' => encrypt($data->id)]) }}"><em class="icon ni ni-trash text-danger"></em></a></td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="9">No Network Fee</td>
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
