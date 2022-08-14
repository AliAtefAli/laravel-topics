@extends('dashboard.master')
@section('title', 'Create User')

@section('styles')

@endsection

@section('content')

    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <h3><i class="fa fa-plus"></i> Create User</h3>
                <div class="form-panel">
                    <form role="form" action="{{ route('users.store') }}" method="post" class="form-horizontal style-form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name-input" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" name="name" placeholder="" id="name-input" class="form-control">
                                <p class="@error('name') help-block @enderror ">@error('name') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email-input" class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-10">
                                <input type="text" name="email" placeholder="" id="email-input" class="form-control">
                                <p class="@error('email') help-block @enderror ">@error('email') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="form-group @error('phone') has-error @enderror">
                            <label for="phone-input" class="col-lg-2 control-label">Phone</label>
                            <div class="col-lg-10">
                                <input type="text" name="phone" placeholder="" id="phone-input" class="form-control">
                                <p class="@error('phone') help-block @enderror ">@error('phone') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="form-group @error('image') has-error @enderror">
                            <label for="image-input" class="col-lg-2 control-label">Image</label>
                            <div class="col-lg-10">
                                <input type="file" name="image" placeholder="" id="image-input" class="form-control">
                                <p class="@error('image') help-block @enderror ">@error('image') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="form-group @error('password') has-error @enderror">
                            <label for="password-input" class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-10">
                                <input type="password" name="password" placeholder="" id="password-input" class="form-control">
                                <p class="@error('password') help-block @enderror ">@error('password') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="form-group @error('password_confirmation') has-error @enderror">
                            <label for="password_confirmation-input" class="col-lg-2 control-label">Password Confirmation</label>
                            <div class="col-lg-10">
                                <input type="password" name="password_confirmation" placeholder="" id="password_confirmation-input" class="form-control">
                                <p class="@error('password_confirmation') help-block @enderror ">@error('password_confirmation') {{ $message }} @enderror</p>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-theme" type="submit">Create</button>
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
@endsection
