<form wire:submit.prevent='save'>
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
    <div class="form-outline mt-3">
        <label class="form-label fs-6 fw-bold" for="name">Nhập tên khách hàng</label>
        <input type="text" class="form-control" id="name" autocomplete="name" wire:model='name' required>
    </div>

    <!-- Nhập Email đã xác thực -->
    <div class="form-outline mt-3">
        <label class="form-label fs-6 fw-bold" for="email">Email đăng kí</label>
        <input type="email" class="form-control" id="email" autocomplete="email" wire:model.live='email'
            @if ($event) required @else readonly @endif>
        @error('email')
            <b class="text-danger">{{ $message ?? 'ẩn danh' }}</b>
        @enderror
    </div>

    <!-- Nhập Email đã xác thực -->
    <div class="form-outline mt-3">
        <label class="form-label fs-6 fw-bold" for="phone">Số điện thoại</label>
        <input type="number" class="form-control" id="phone" autocomplete="phone" wire:model='phone' required>
    </div>

    <!-- Nhập Email đã xác thực -->
    <div class="form-outline mt-3">
        <label class="form-label fs-6 fw-bold" for="address">Địa chỉ</label>
        <input type="text" class="form-control" id="address" autocomplete="address" wire:model='address' required>
    </div>
    <hr>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-dark w-75">Tạo tài khoản</button>
        <button type="button" class="btn btn-outline-dark w-25" wire:click='resetData'>Xóa</button>
    </div>
</form>
