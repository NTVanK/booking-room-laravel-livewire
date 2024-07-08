<nav class="navbar navbar-expand-lg sticky-top bg-light z-3" id="navbar-example2">
    <div class="container-fluid px-4">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="col navbar-brand d-flex align-items-center gap-2">
            <img src="{{ asset('assets\image\Logo.png') }}" height="38" alt="Logo">
            <span class='fw-bold fs-3'>The Line</span>
        </a>

        {{--  --}}
        <div class="btn btn-outline-light fw-bold">{{Auth::guard('admin')->user()->admin}}</div>
        <a href="{{ route('admin.logout') }}" class="btn btn-danger ms-2 fw-bold">Đăng xuất</a>
    </div>
</nav>
