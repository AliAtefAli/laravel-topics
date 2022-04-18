@extends('dashboard.master')
@section('title', 'Create User')

@section('styles')

@endsection

@section('content')

    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Form Validation</h3>
        <!-- BASIC FORM VALIDATION -->
        <div class="row mt">
            <div class="col-lg-12">
                <h4><i class="fa fa-angle-right"></i> Basic Validations</h4>
                <div class="form-panel">
                    <x-alert type="error" :message="Success"></x-alert>
                    <form role="form" class="form-horizontal style-form">

                        <div class="form-group @error('email') has-error @enderror">
                            <label class="col-lg-2 control-label">Last Name</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="" id="l-name" class="form-control">
                                <p class="@error('email') help-block @enderror ">@error('email') {{ $message }} @enderror</p>
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
