<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Đăng nhập</title>
    <link rel="icon" href="{{ asset('assets\image\Logo.png') }}" type="image/x-icon">

    <!-- fontowesome Bootstrap css-->
    <link data-navigate-once rel="stylesheet" href="{{ asset('assets\bootstrap-5.3.3\dist\css\bootstrap.min.css') }}"
        type="text/css" />
    <link data-navigate-once rel="stylesheet" href="{{ asset('assets\font-awesome\css\all.min.css') }}"
        type="text/css" />
    <link data-navigate-once rel="stylesheet" href="{{ asset('assets\css\flash.css') }}" type="text/css" />
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        body{
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    @livewireStyles
</head>

<body class="bg-info-subtle">
    <livewire:admin.login />
</body>

@livewireScripts

{{-- Bootstap js --}}
<script data-navigate-once src="{{ asset('assets\bootstrap-5.3.3\dist\js\bootstrap.bundle.min.js') }}"></script>

</html>
