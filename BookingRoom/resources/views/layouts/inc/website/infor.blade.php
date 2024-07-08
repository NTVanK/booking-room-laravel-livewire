<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Line | Thông tin cá nhân</title>
    <link rel="icon" href="{{ asset('assets\image\Logo.png') }}" type="image/x-icon">

    <!-- fontowesome Bootstrap css-->
    <link data-navigate-once rel="stylesheet" href="{{ asset('assets\bootstrap-5.3.3\dist\css\bootstrap.min.css') }}"
        type="text/css" />
    <link data-navigate-once rel="stylesheet" href="{{ asset('assets\font-awesome\css\all.min.css') }}"
        type="text/css" />
    <link data-navigate-once rel="stylesheet" href="{{ asset('assets\css\home.css') }}" type="text/css" />
    <link data-navigate-once rel="stylesheet" href="{{ asset('assets\css\flash.css') }}" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('css')
</head>

<body>
    @include('layouts.inc.website.nav')
    <livewire:layout.infoUser />
</body>

@yield('js')

{{-- Bootstap js --}}
<script data-navigate-once src="{{ asset('assets\bootstrap-5.3.3\dist\js\bootstrap.bundle.min.js') }}"></script>

</html>
