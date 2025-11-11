@extends('layouts.index')

@section('title')
    Update LiveChat
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="title nk-block-title">Update LiveChat App</h4>
                            <div class="nk-block-des">
                                <p>Create a livechat app and copy the link here in the form below to add it to your application.</p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <h6>Direct Chat Link</h6>

                            <p>Current url: <a href="{{ $data->url }}" target="_blank" class="fw-bold">{{ $data->url }}</a></p>

                            <form action="{{ route('admin.livechat.update.url') }}" class="form-validate is-alter" novalidate="novalidate" method="post">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="fva-full-name">New URL</label>
                                            <div class="form-control-wrap">
                                                <input type="text" placeholder="Paste URL here" class="form-control" id="fva-full-name" name="url" required="">
                                                @error('url')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card card-bordered">
                        <div class="card-inner">
                            <h6>LiveChat Widget</h6>
                            <form action="{{ route('admin.livechat.update.script') }}" class="form-validate is-alter" novalidate="novalidate" method="post">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="fva-full-name">New Script</label>
                                            <div class="form-control-wrap">
                                                <textarea name="script" class="w-100 p-2" rows="10" placeholder="Paste the livechat script here">{{ $data->script }}</textarea>
                                                @error('script')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
