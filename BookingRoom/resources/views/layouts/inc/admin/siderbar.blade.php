<div class="col-xl-2 py-3 slider-bar">
    @php
        if (!function_exists('isRoute')) {
            function isRoute(...$routes)
            {
                return in_array(request()->route()->getName(), $routes);
            }
        }
    @endphp
    <a href="{{ route('admin.dashboard') }}" class="{{ isRoute('admin.dashboard') ? 'active' : '' }}" wire:navigate>
        <img class="img-thumbnail" src="{{ asset('assets\image\icon\dashboard.png') }}" />
        Thống kê
    </a>
    <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
        aria-controls="collapseExample" class="{{isRoute('admin.category.type','admin.category.noof') ? 'active' : ''}}">
        <img class="img-thumbnail" src="{{ asset('assets\image\icon\bed.png') }}" />
        Phân loại
        <i class="fa-regular fa-square-caret-down fa-sm"></i>
    </a>
    <div class="collapse p-2" id="collapseExample">
        <div class="form-control">
            <a href="{{ route('admin.category.type') }}" wire:navigate class="text-warning-emphasis fs-6">Loại phòng</a>
            <a href="{{ route('admin.category.noof') }}" wire:navigate class="text-warning-emphasis fs-6">Số phòng</a>
        </div>
    </div>
    <a data-bs-toggle="collapse" href="#booking" role="button" aria-expanded="false"
        aria-controls="booking" class="{{isRoute('admin.bookingManagement','admin.booking') ? 'active' : ''}}">
        <img class="img-thumbnail" src="{{ asset('assets\image\icon\bedroom.png') }}" />
        Đặt phòng
        <i class="fa-regular fa-square-caret-down fa-sm"></i>
    </a>
    <div class="collapse p-2" id="booking">
        <div class="form-control">
            <a href="{{ route('admin.bookingManagement') }}" wire:navigate class="text-warning-emphasis fs-6">Quản lí</a>
            <a href="{{ route('admin.historyBook') }}" wire:navigate class="text-warning-emphasis fs-6">Lịch sử</a>
        </div>
    </div>
    <a href="{{ route('admin.user') }}" class="{{ isRoute('admin.user') ? 'active' : '' }}" wire:navigate>
        <img src="{{ asset('assets\image\icon\staff.png') }}" />
        Người dùng
    </a>
    <a href="{{ route('admin.payment') }}" class="{{ isRoute('admin.payment') ? 'active' : '' }}" wire:navigate>
        <img src="{{ asset('assets\image\icon\wallet.png') }}" />
        Thanh toán
    </a>
    <a href="#">
        <img src="{{ asset('assets\image\icon\staff.png') }}" />
        Quản lí
    </a>
</div>
