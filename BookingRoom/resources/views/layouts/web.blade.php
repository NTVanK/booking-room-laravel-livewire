<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Line</title>
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
    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
        data-bs-smooth-scroll="true" class="bg-body-tertiary p-3 rounded-2" tabindex="0">

        @include('layouts.inc.website.home')
        <div class="container-fluid bg-info-subtle rounded mt-5 shadow">
            <a href="#" class="col navbar-brand d-flex align-items-center justify-content-center p-5 gap-2">
                <img src="{{ asset('assets\image\Logo.png') }}" height="38" alt="Logo">
                <span class='fw-bold fs-1'>The Line</span>
            </a>
        </div>
        @include('layouts.inc.website.rooms')

        @livewire('layout.booking')
        <div class="container-fluid bg-info-subtle rounded shadow">
            <a href="#" class="col navbar-brand d-flex align-items-center justify-content-center p-5 gap-2">
                <img src="{{ asset('assets\image\Logo.png') }}" height="38" alt="Logo">
                <span class='fw-bold fs-1'>The Line</span>
            </a>
        </div>
        @include('layouts.inc.website.facilities')
        @include('layouts.inc.website.contactus')

    </div>
</body>

@yield('js')

{{-- Bootstap js --}}
<script data-navigate-once src="{{ asset('assets\bootstrap-5.3.3\dist\js\bootstrap.bundle.min.js') }}"></script>

</html>
