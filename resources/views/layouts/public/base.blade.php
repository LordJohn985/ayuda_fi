<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>UnaGauchada</title>

    {{--@include('includes.components.admin.styles')--}}
<!-- Vendor styles -->
    <link rel="stylesheet" href="css/vendor/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="css/vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="css/vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="/css/vendor/datatables/datatables.min.css"/>
    <link rel="stylesheet" href="/css/vendor/toastr/toastr.min.css"/>

    <!-- App styles -->
    <link rel="stylesheet" href="css/pe-icons/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" href="css/pe-icons/helper.css"/>
    <link rel="stylesheet" href="css/stroke-icons/style.css"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="/css/style-custom.css">

</head>

<body>
<div class="wrapper">
    @include('includes.publicHeader')

    @yield('content')

    {{--@include('includes.components.admin.header')
    @include('includes.components.admin.sidebar')
    @include('includes.components.admin.notification')
    @yield('content')

    @include('includes.components.admin.footer')--}}

    @include('includes.scripts')


</div><!--/wrapper-->

<!-- Vendor scripts -->
{{--<script src="css/vendor/pacejs/pace.min.js"></script>--}}
<!--<script src="css/vendor/jquery/dist/jquery.min.js"></script> -->
<!--<script src="css/vendor/bootstrap/js/bootstrap.min.js"></script> -->

<!-- App scripts -->
{{--<script src="js/luna.js"></script>
@yield('scripts')--}}
</body>
</html>
