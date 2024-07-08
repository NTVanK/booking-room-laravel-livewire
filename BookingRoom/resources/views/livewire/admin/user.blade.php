<div>
    <h3>Quản lí người dùng</h3>
    <hr>
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

    <div class="row g-0">
        <div class="col-xl-8 pe-2">
            <table class="table rounded overflow-hidden">
                <thead class="table-dark border border-dark">
                    <tr>
                        <th>id</th>
                        <th>Khách hàng</th>
                        <th>Địa chỉ email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody class="border border-dark">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                <button type="btn" class="btn btn-sm btn-success" wire:click='edit({{$user->id}})'>Sửa</button>
                                <button type="btn" class="btn btn-sm btn-danger" wire:click='delete({{$user->id}})'>Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="border border-dark rounded px-3 py-2 col-xl-4">
            <livewire:admin.addUser />
        </div>
        
    </div>
</div>

