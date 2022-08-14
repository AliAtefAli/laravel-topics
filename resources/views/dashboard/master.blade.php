<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
{{--    <meta name="description" content="@if(isset($setting['site_description'])){{ $setting['site_description'] }} @endif">--}}
{{--    <meta name="keywords" content="@if(isset($setting['site_tagged'])){{ $setting['site_tagged'] }} @endif">--}}
{{--    <meta name="author" content="@if(isset($setting['site_name'])){{ $setting['site_name'] }} @endif">--}}
    <title>@yield('title')</title>

    @yield('before-styles')

    <!-- Favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="@if(isset($setting['favicon'])){{asset('assets/uploads/settings/' . $setting['favicon'] )}} @else {{asset('assets/dashboard/img/favicon.png')}} @endif">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/dashboard/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('assets/dashboard/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/dashboard/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/dashboard/css/style-responsive.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body>
<section id="container">

    <!--header start-->
@include('dashboard.partials.header')
<!--header end-->



<!-- BEGIN: Side bar-->
@include('dashboard.partials.sidebar')
<!-- END: Side bar-->

<!--main content start-->
<section id="main-content">
    @yield('content')
</section>
<!-- /MAIN CONTENT -->

<!--footer start-->
@include('dashboard.partials.footer')
<!--footer end-->

<!-- js placed at the end of the document so the pages load faster -->
<link href="{{ asset('assets/dashboard/lib/jquery/jquery.min.js') }}" rel="stylesheet">
<link href="{{ asset('assets/dashboard/lib/bootstrap/js/bootstrap.min.js') }}" rel="stylesheet">
<link href="{{ asset('assets/dashboard/lib/jquery.dcjqaccordion.2.7.js') }}" rel="stylesheet">
<link href="{{ asset('assets/dashboard/lib/jquery.scrollTo.min.js') }}" rel="stylesheet">
<link href="{{ asset('assets/dashboard/lib/jquery.nicescroll.js') }}" rel="stylesheet">
<!--common script for all pages-->
<link href="{{ asset('assets/dashboard/lib/common-scripts.js') }}" rel="stylesheet">

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    @if(session()->has('success'))
    fireSuccess("{{ session()->get('success') }}");
    @elseif(session()->has('error'))
    fireSuccess("{{ session()->get('error') }}");
    @endif

</script>
<!-- Request Errors -->
{{--@if($errors->any())--}}
{{--    toastr.error("{{ $errors->first() }}")--}}
{{--@endif--}}

@yield('scripts')
</section>
</body>
</html>

