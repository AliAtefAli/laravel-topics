@extends('dashboard.master')
@section('title', 'Edit User')

@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/lib/bootstrap-fileupload/bootstrap-fileupload.css') }}" />
@endsection

@section('content')

    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Form Validation</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
            <div class="col-lg-12">
                <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>
                <div class="form-panel">
                    <form action="{{ route('users.update', $user) }}" role="form" class="form-horizontal style-form" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name-input" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" name="name" placeholder="" id="name-input" class="form-control" value="{{ $user->name }}" autofocus>
                                <p class="@error('name') help-block @enderror ">@error('name') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email-input" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input type="text" name="email" placeholder="" id="email-input"  class="form-control" value="{{ $user->email }}">
                                <p class="@error('email') help-block @enderror ">@error('email') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="form-group @error('phone') has-error @enderror">
                            <label for="phone-input" class="col-lg-2 control-label">Phone</label>
                            <div class="col-lg-10">
                                <input type="text" name="phone" placeholder="" id="phone-input"  class="form-control" value="{{ $user->phone }}">
                                <p class="@error('phone') help-block @enderror ">@error('phone') {{ $message }} @enderror</p>
                            </div>
                        </div>


                        <div class="form-group lst">
                            <label class="control-label col-md-2">Image Upload</label>
                            <div class="col-md-10">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new" style="width: 200px; height: 150px;">
                                        <img src="{{ $user->fullImage }}" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-theme02 btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                                        <input type="file" name="image" placeholder="" id="image-inut" class="default">
                                    </span>
                                    <p class="@error('image') help-block @enderror ">@error('image') {{ $message }} @enderror</p>

                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-theme" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /form-panel -->
            </div>
            <!-- /col-lg-12 -->
        </div>
        <!-- /row -->

    </section>

@endsection

@section('scripts')
    <script src="{{ asset('assets/dashboard/lib/form-validation-script.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/lib/jquery-ui-1.9.2.custom.min.js') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/lib/bootstrap-fileupload/bootstrap-fileupload.js') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/lib/advanced-form-components.js') }}" />
@endsection
