<nav class="navbar navbar-expand-lg sticky-top bg-light z-3 shadow" id="navbar-example2" wire:poll>
    <div class="container">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="col navbar-brand d-flex align-items-center gap-2">
            <img src="{{ asset('assets\image\Logo.png') }}" height="38" alt="Logo">
            <span class='fw-bold fs-3'>The Line</span>
        </a>


        {{-- nút rút gọn xuất hiện sau khi thu nhỏ màn hình --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        {{--  --}}
        <div class="offcanvas offcanvas-end rounded-2 m-2" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <a href="{{ route('home') }}" class="col navbar-brand d-flex align-items-center gap-2">
                    <img src="{{ asset('assets\image\Logo.png') }}" height="38" alt="Logo">
                    <span class='fw-bold fs-3'>The Line</span>
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item">
                        <a class="btn btn-outline-dark border border-0 fw-bold" href="#firstsection">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark border border-0 fw-bold" href="#secondsection">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark border border-0 fw-bold" href="#booking">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark border border-0 fw-bold" href="#thirdsection">Facilites</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-dark border border-0 fw-bold" href="#contactus">contact us</a>
                    </li>
                    @session('logUser')
                    <li class="nav-item">
                        <a class="btn btn-outline-dark fw-bold" href="{{ route('infor') }}" wire:navigate>
                            {{session('logUser')['name']}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger fw-bold" href="{{ route('logoutUser') }}" wire:navigate>
                            Đăng xuất
                        </a>
                    </li>
                    @endsession()

                </ul>
            </div>
        </div>
    </div>
</nav>
