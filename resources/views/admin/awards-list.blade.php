@extends('layouts.index')
@section('title')
    Our Awards
@endsection
@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-lg wide-sm">
                <div class="nk-block-head-content d-flex justify-content-between">
                    <div>
                        <div class="nk-block-head-sub"><a class="back-to" href="javascript:history.back()"><em class="icon ni ni-arrow-left"></em><span>Back</span></a></div>
                        <h4 class="nk-block-title fw-normal">Awards List</h4>
                    </div>
                    <div>
                        <a href="{{ route('admin.award.create.new') }}" class="btn btn-icon btn-primary" ><em class="icon ni ni-plus"></em></a>
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
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @forelse ($awards as $award)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>
                                            <a href="{{ url('/awards/'.$award->photo) }}">
                                                <img src="{{ asset('awards/'.$award->photo) }}" style="width: 30px" alt="">
                                            </a>
                                        </td>
                                        <td>{{ $award->heading }}</td>
                                        <td>{{ $award->description }}</td>
                                        <td>
                                            <a href="{{ route('admin.awards.delete', ['id' => encrypt($award->id)]) }}"><em class="icon ni ni-trash text-danger"></em></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Award Yet</td>
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
