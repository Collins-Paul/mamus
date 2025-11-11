@extends('layouts.index')

@section('title')
    Compose Mail
@endsection

@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-body">
                <div class="nk-content-wrap">
                    <div class="nk-block-head nk-block-head-lg">
                        <div class="nk-block-head-sub"><a href="" class="text-soft"><span>Mail</span></a></div>
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">Compose Mail</h2>
                            <div class="nk-block-des">
                                <p>You can compose and send mail with file attachment as an optional content.</p>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="nk-block mb-3">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <form action="{{ route('admin.send.mail') }}" method="post" class="form-contact" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" name="recipient" class="form-control form-control-lg" placeholder="To Recipient:">
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" name="subject" class="form-control form-control-lg" placeholder="Subject:">
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="form-editor-custom">
                                                        <textarea name="email_content" id="compose-textarea" class="form-control form-control-lg" placeholder="Compose message"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="file" name="attachment" class="form-control form-control-lg">
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Send Mail</button>
                                        </div><!-- .col -->
                                    </div><!-- .row -->
                                </form><!-- .form-contact -->
                            </div><!-- .card-inner -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection
