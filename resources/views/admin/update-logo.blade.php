@extends('layouts.index')
@section('title')
    Edit Logo/Icon
@endsection
@section('content')
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="row create_nft">
                <div class="col-lg-6 mb-5">
                    <h5>Logo Upload</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.upload-image') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <p id="file_name">PNG, JPG, GIF, WEBP or MP4. Max 200mb.</p>
                                    <input type='file' id="imgInp" name="image">
                                </div>
                            </div>
                            <div class="mt-3"><button type="submit" class="btn btn-primary mr-2">Upload</button></div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h5>Preview Upload</h5>
                    <div class="card items">
                        <div class="card-body" style="width: 200px">
                            <div class="items-img position-relative" style="width: 100%">
                                <img src="{{ asset('assets/logo/'.$logo->logo) }}" id="blah" class="img-fluid rounded mb-3" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h5>Icon Upload</h5>
                    <div class="card-body">
                        <form action="{{ route('admin.upload-icon') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <p id="file_name">PNG, JPG, GIF, WEBP or MP4. Max 200mb.</p>
                                    <input type='file' id="icon" name="image">
                                </div>
                            </div>
                            <div class="mt-3"><button type="submit" class="btn btn-primary mr-2">Upload</button></div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h5>Preview Upload</h5>
                    <div class="card items">
                        <div class="card-body" style="width: 200px">
                            <div class="items-img position-relative" style="width: 100%">
                                <img src="{{ asset('assets/logo/'.$logo->icon) }}" id="favicon" class="img-fluid rounded mb-3" alt="">
                            </div>
                        </div>
                    </div>
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

    <script>
        icon.onchange = evt => {
            const [file] = icon.files
            if (file) {
                favicon.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection

