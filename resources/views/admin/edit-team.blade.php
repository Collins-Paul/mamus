@extends('layouts.index')
@section('title')
    Edit Member
@endsection
@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-lg wide-sm">
                <div class="nk-block-head-content">
                    <div class="nk-block-head-sub"><a class="back-to" href="javascript:history.back()"><em class="icon ni ni-arrow-left"></em><span>Back</span></a></div>
                    <h4 class="nk-block-title fw-normal">Edit Member</h4>
                </div>
            </div>

            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <form action="{{ route('admin.member.update.team') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <h5>Member Photo</h5>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <p id="file_name">PNG, JPG, GIF, WEBP or MP4. Max 200mb. Dimensions: 400 x 400.</p>
                                            <input type='file' id="imgInp" name="image">
                                        </div>
                                        @error('image')
                                                <span id="-error" class="invalid text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <h5>Preview Photo</h5>
                                    <div class="card items">
                                        <div class="card-body" style="width: 200px">
                                            <div class="items-img position-relative" style="width: 100%">
                                                <img src="{{ asset('teams/'.$data->photo) }}" id="blah" class="img-fluid rounded mb-3" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="fva-full-name">Name of Staff <span class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                            name="name" value="{{ $data->staff_name }}" placeholder="Enter name of staff" required="">
                                            @error('name')
                                                <span id="-error" class="invalid text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="fva-full-name">Staff Position <span class="text-danger">*</span></label>
                                        <div class="form-control-wrap">
                                            <input type="text" value="{{ $data->staff_position }}" class="form-control"  name="position" placeholder="Enter position" required>
                                            @error('position')
                                                <span id="-error" class="invalid text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label" for="fva-full-name">Staff Description</label>
                                        <div class="form-control-wrap">
                                            @error('description')
                                                <span id="-error" class="invalid text-danger">{{ $message }}</span>
                                            @enderror
                                            <textarea placeholder="A brief description of the staff..." class="form-control" name="description" rows="10">{{ $data->description }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $data->id }}" name="id">
                                <div class="mt-3"><button type="submit" class="btn btn-primary mr-2">Save</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('img-preview')
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
