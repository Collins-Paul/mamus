@extends('layouts.index')

@section('title')
    Create Masters
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-block-head-content mb-4">
                    <h3 class="nk-block-title page-title">Create New Master</h3>
                </div>


                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="title nk-block-title">Fill the simple form below</h4>
                            <div class="nk-block-des">
                                <p>You can create a master with <code class="code-class">Firstname</code> and <code class="code-class">Lastname</code> thereafter you proceed to the master's account and make proper editing of the account then <code class="code-class">Activate</code></p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form action="{{ route('admin.createmaster') }}" class="form-validate is-alter" novalidate="novalidate" method="post">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fva-full-name">Firstname</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="fva-full-name" name="fname" required="">
                                                @error('fname')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="fva-full-name">Lastname</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="fva-full-name" name="lname" required="">
                                                @error('lname')
                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Create</button>
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
