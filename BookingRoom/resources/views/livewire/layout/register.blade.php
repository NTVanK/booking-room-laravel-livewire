<form wire:submit.prevent='save'>
    <h3 class="my-3 text-center">Đăng kí</h3>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade w-100 show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-error alert-dismissible fade w-100 show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Nhập Email đã xác thực -->
    <div class="form-floating my-2">
        <input type="text" class="form-control" id="floatingInput" wire:model='name' placeholder="name">
        <label for="floatingInput">Nhập tên khách hàng</label>
    </div>
    @error('name')
        <b class="text-danger">{{ $message ?? 'ẩn danh' }}</b>
    @enderror

    <!-- Nhập Email đã xác thực -->
    <div class="form-floating my-2">
        <input type="text" class="form-control" id="floatingInput" wire:model='email' placeholder="email">
        <label for="floatingInput">Email đăng kí</label>
    </div>
    @error('email')
        <b class="text-danger">{{ $message ?? 'ẩn danh' }}</b>
    @enderror

    <!-- Nhập số điện thoại -->
    <div class="form-floating my-2">
        <input type="text" class="form-control" id="floatingInput" wire:model='phone' placeholder="phone">
        <label for="floatingInput">Số điện thoại</label>
    </div>
    @error('phone')
        <b class="text-danger">{{ $message ?? 'ẩn danh' }}</b>
    @enderror

    <!-- Nhập địa chỉ -->
    <div class="form-floating my-2">
        <input type="text" class="form-control" id="floatingInput" wire:model='address' placeholder="address">
        <label for="floatingInput">Địa chỉ</label>
    </div>
    @error('address')
        <b class="text-danger">{{ $message ?? 'ẩn danh' }}</b>
    @enderror
    <hr>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-dark w-75">Tạo tài khoản</button>
        <button type="button" class="btn btn-outline-dark w-25" wire:click='resetData'>Xóa</button>
    </div>
</form>
