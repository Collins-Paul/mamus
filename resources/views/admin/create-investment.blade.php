@extends('layouts.index')

@section('title')
   Create Investment Plan
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="row g-2">
                    <div class="col-lg-6">
                        <div class="mx-2 vertical-scrollable">
                            <div class="row px-2">
                                <div class="card card-bordered shadow">
                                    <div class="card-inner">
                                        <form action="{{ route('admin.packages.store') }}"  method="post">
                                            @csrf
                                            <div class="row g-gs">
                                                    <div class="form-group mb-0">
                                                        <label class="form-label" for="fva-full-name">Create a new Plan</label>
                                                        <div class="form-control-wrap">
                                                            <div class="my-2">
                                                                <label for="">Package Title</label>
                                                                <input class="form-control" type="text" placeholder="Enter Title" name="name">
                                                                @error('name')
                                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="my-2">
                                                                <label for="">Deposit Return</label>
                                                                <select class="form-control" name="return">
                                                                    <option value="">Deposit Return</option>
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                </select>
                                                                @error('return')
                                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="my-2">
                                                                <label for="">Investment Interest %</label>
                                                                <input class="form-control" type="number" placeholder="Interest %" name="interest">
                                                                @error('interest')
                                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="my-2">
                                                                <label for="">Duration in weeks</label>
                                                                <input class="form-control" type="number" placeholder="Enter No. of Weeks" name="weeks">
                                                                @error('weeks')
                                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="my-2">
                                                                <label for="">Minimum Deposit</label>
                                                                <input class="form-control" type="number" placeholder="Enter min. deposit" name="min_deposit">
                                                                @error('min_deposit')
                                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="my-2">
                                                                <label for="">Maximum Deposit</label>
                                                                <input class="form-control" type="number" placeholder="Enter max. deposit" name="max_deposit">
                                                                @error('max_deposit')
                                                                    <span id="-error" class="invalid">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-lg btn-block btn-outline-primary">Create</button>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
