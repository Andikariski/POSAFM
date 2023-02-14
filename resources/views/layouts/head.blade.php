<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('style/assets/images/Logo-AM-fix.png')}}">
    <title>{{ config('app.name') }}</title>
    <!-- Custom CSS -->
    <link href="{{ url('style/assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet"/>
    <link href="{{ url('style/assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet"/>
    <link href="{{ url('style/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ url('style/dist/css/style.min.css')}}" rel="stylesheet"/>
    <!-- Custom CSS -->
    <link href="{{ url('style/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
    <link href="{{ url('style/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <link href="{{ url('js/sweetalert/sweetalert2.min.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> --}}

    
    <!-- Select2 -->
    <link href="{{ url('style/dist/css/select2.css')}}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

    {{-- Calendar --}}
    <link href="{{ url('style/assets/libs/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet" />


    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
