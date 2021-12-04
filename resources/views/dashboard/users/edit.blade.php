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
                    <form action="{{ route('users.update', $user) }}" role="form" class="form-horizontal style-form" method="post">
                        @method('PUT')
                        @csrf

                        <div class="form-group @error('name') has-error @enderror">
                            <label class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input name="name" type="text" value="{{ $user->name }}" placeholder="" id="l-name" class="form-control" autofocus>
                                <p class="@error('name') help-block @enderror ">@error('name') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="form-group @error('email') has-error @enderror">
                            <label class="col-lg-2 control-label">E-mail</label>
                            <div class="col-lg-10">
                                <input name="email" type="text" value="{{ $user->email }}" placeholder="" id="l-name" class="form-control">
                                <p class="@error('email') help-block @enderror ">@error('email') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="form-group @error('image') has-error @enderror">
                            <label class="col-lg-2 control-label">Image</label>
                            <div class="col-lg-10">
                                <input name="image" type="text" value="{{ $user->image }}" placeholder="" id="l-name" class="form-control">
                                <p class="@error('image') help-block @enderror ">@error('image') {{ $message }} @enderror</p>
                            </div>
                        </div>
                        <div class="form-group last">
                            <label class="control-label col-md-3">Image Upload</label>
                            <div class="col-md-9">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                        <span class="btn btn-theme02 btn-file">
                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" class="default" />
                        </span>
                                        <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                                    </div>
                                </div>
                                <span class="label label-info">NOTE!</span>
                                <span>
                      Attached image thumbnail is
                      supported in Latest Firefox, Chrome, Opera,
                      Safari and Internet Explorer 10 only
                      </span>
                            </div>
                        </div>

                        <div class="form-group @error('address') has-error @enderror">
                            <label class="col-lg-2 control-label">Address</label>
                            <div class="col-lg-10">
                                <input name="address" type="text" value="{{ $user->address }}" placeholder="" id="l-name" class="form-control">
                                <p class="@error('address') help-block @enderror ">@error('address') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-theme" type="submit">Edit</button>
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
