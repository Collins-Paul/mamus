@extends('layouts.index')
@section('title')
    Testimonies
@endsection
@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-lg wide-sm">
                <div class="nk-block-head-content d-flex justify-content-between">
                    <div>
                        <div class="nk-block-head-sub"><a class="back-to" href="javascript:history.back()"><em class="icon ni ni-arrow-left"></em><span>Back</span></a></div>
                        <h4 class="nk-block-title fw-normal">All Testimonies</h4>
                    </div>
                    <div>
                        <a href="{{ route('admin.testifier.create') }}" class="btn btn-icon btn-primary" ><em class="icon ni ni-plus"></em></a>
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
                                    <th scope="col">Investor</th>
                                    <th scope="col">Testimony</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; ?>
                                @forelse ($testimonies as $investor)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $investor->investor }}</td>
                                        <td>{{ Str::limit($investor->testimony, 40, '...') }}</td>
                                        <td>
                                            <a href="{{ route('admin.testifiers.delete', ['id' => encrypt($investor->id)]) }}"><em class="icon ni ni-trash text-danger"></em></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Testimonies Yet</td>
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
