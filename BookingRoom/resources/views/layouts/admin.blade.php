<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title', 'Trang chủ')</title>
    <link rel="icon" href="{{ asset('assets\image\Logo.png') }}" type="image/x-icon">

    <!-- fontowesome Bootstrap css-->
    <link data-navigate-once rel="stylesheet" href="{{ asset('assets\bootstrap-5.3.3\dist\css\bootstrap.min.css') }}"
        type="text/css" />
    <link data-navigate-once rel="stylesheet" href="{{ asset('assets\font-awesome\css\all.min.css') }}"
        type="text/css" />
    <link data-navigate-once rel="stylesheet" href="{{ asset('assets\css\admin.css') }}" type="text/css" />
    <!-- sweet alert -->
    <script data-navigate-once src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script data-navigate-once src="{{ asset('assets\canvasjs-chart-3.8.8\canvasjs.min.js') }}"></script>
    @yield('css')
    @livewireStyles
</head>

<body>
    @include('layouts.inc.admin.nav')
    <div class="container-fluid g-0">
        <div class="row g-0">
            @include('layouts.inc.admin.siderbar')
            <div class="col-xl-10 p-4 bg-body-secondary content" data-bs-spy="scroll" data-bs-smooth-scroll="true">
                @yield('content')
            </div>
        </div>
    </div>
</body>

@yield('js')
@livewireScripts

{{-- Bootstap js --}}
<script data-navigate-once src="{{ asset('assets\bootstrap-5.3.3\dist\js\bootstrap.bundle.min.js') }}"></script>

</html>
