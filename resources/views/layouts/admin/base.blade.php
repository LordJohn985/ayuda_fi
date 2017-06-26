<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>

    <!-- Page title -->
    <title>UnaGauchada</title>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="/css/vendor/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="/css/vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="/css/vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="/css/vendor/datatables/datatables.min.css"/>
    <link rel="stylesheet" href="/css/vendor/toastr/toastr.min.css"/>

    <!-- App styles -->
    <link rel="stylesheet" href="/css/pe-icons/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" href="/css/pe-icons/helper.css"/>
    <link rel="stylesheet" href="/css/stroke-icons/style.css"/>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/style-custom.css">

</head>
<body>

<input id="environment" type="hidden" value="{{env('APP_ENV')}}"/>

<!-- Wrapper-->
<div class="wrapper">
    @include('includes.header')
    @include('includes.nav')
    @include('includes.alert-error')
    @include('includes.alert-success')
    @yield('content')
    @include('includes.scripts')
</div>
@yield('script')
</body>

</html>