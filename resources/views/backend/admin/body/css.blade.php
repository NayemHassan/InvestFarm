<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>{{ $pageTitle ?? 'World Bank - Your Financial Partner' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Manage your savings and investments securely.' }}">
    <meta name="keywords" content="bank, savings, investment, financial management">
    <meta name="robots" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Open Graph (OG) for Social Media -->
    <meta property="og:title" content="{{ $pageTitle ?? 'World Bank' }}">
    <meta property="og:description" content="{{ $metaDescription ?? 'Your trusted investment platform.' }}">
    <meta property="og:image" content="{{ asset('backend/assets/images/seo-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle ?? 'World Bank' }}">
    <meta name="twitter:description" content="{{ $metaDescription ?? 'Secure and reliable financial solutions.' }}">
    <meta name="twitter:image" content="{{ asset('backend/assets/images/seo-image.jpg') }}">
  <!-- Favicon -->
<link rel="icon" href="{{asset('backend')}}/assets/images/favicon-32x32.png" type="image/png" />

<!-- Plugins CSS -->
<link href="{{asset('backend')}}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
<link href="{{asset('backend')}}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
<link href="{{asset('backend')}}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
<link href="{{asset('backend')}}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
<!-- Include Pickadate CSS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/themes/default.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/themes/default.date.css" />

<!-- Include Pickatime CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.5.6/themes/default.time.css" />
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Loader CSS -->
<link href="{{asset('backend')}}/assets/css/pace.min.css" rel="stylesheet" />
<script src="{{asset('backend')}}/assets/js/pace.min.js"></script>

<!-- Bootstrap CSS -->
<link href="{{asset('backend')}}/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="{{asset('backend')}}/assets/css/app.css" rel="stylesheet">
<link href="{{asset('backend')}}/assets/css/icons.css" rel="stylesheet">

<!-- Theme Style CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/css/dark-theme.css" />
<link rel="stylesheet" href="{{asset('backend')}}/assets/css/semi-dark.css" />
<link rel="stylesheet" href="{{asset('backend')}}/assets/css/header-colors.css" />

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

<!-- Toastr Alternative CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <title>World Bank</title>
</head>

<body>
