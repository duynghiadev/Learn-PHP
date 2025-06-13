<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="/admin/css/styles.css" rel="stylesheet" />
    <link href="/admin/css/tooltip.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    @yield('css')
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
@include('admin.includes.nav')
<div id="layoutSidenav">
    @include('admin.includes.sideNav')
    <div id="layoutSidenav_content">
        <main>
            @yield('content')
        </main>
        @include('admin.includes.footer')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/admin/js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="/admin/assets/demo/chart-area-demo.js"></script>
<script src="/admin/assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="/admin/js/datatables-simple-demo.js"></script>
<script src="/admin/js/all.min.js"></script>
<script src="/admin/js/jquery.dataTables.min.js"></script>
@yield('js')
</body>
</html>
