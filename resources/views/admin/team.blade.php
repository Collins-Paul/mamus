@extends('layouts.index')
@section('title')
    Management Team
@endsection
@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-lg wide-sm">
                <div class="nk-block-head-content d-flex justify-content-between">
                    <div>
                        <div class="nk-block-head-sub"><a class="back-to" href="javascript:history.back()"><em class="icon ni ni-arrow-left"></em><span>Back</span></a></div>
                        <h4 class="nk-block-title fw-normal">Team List</h4>
                    </div>
                    <div>
                        <a href="{{ route('admin.create.member.form') }}" class="btn btn-icon btn-primary" ><em class="icon ni ni-plus"></em></a>
                    </div>
                </div>
            </div>

            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Photo</th>
                                    <th scope="col">Staff Name</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @forelse ($members as $member)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>
                                            <a href="{{ url('/teams/'.$member->photo) }}">
                                                <img src="{{ asset('teams/'.$member->photo) }}" style="width: 30px" alt="">
                                            </a>
                                        </td>
                                        <td>{{ $member->staff_name }}</td>
                                        <td>{{ $member->staff_position }}</td>
                                        <td>
                                            <a href="{{ route('admin.member.edit.form', ['id' => encrypt($member->id)]) }}">Edit <em class="icon ni ni-edit text-secondary"></em></a> |
                                            <a href="{{ route('admin.delete.team', ['id' => encrypt($member->id)]) }}"><em class="icon ni ni-trash text-danger"></em></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Registered Team Members</td>
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
@endsection
