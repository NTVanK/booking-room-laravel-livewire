<div>
    <h3>Danh mục phòng</h3>
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
                        <th>Loại phòng</th>
                        <th>Số người</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody class="border border-dark">
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category }}</td>
                            <td>{{ $category->number_people }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-success"
                                    wire:click='edit({{ $category->id }})'>Sửa</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    wire:click='delete({{ $category->id }})'>Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <form class="border border-dark rounded px-3 py-2 col-xl-4" wire:submit.prevent='save'
            style="height: max-content">
            <div class="mt-3">
                <label class="form-label fw-bold" for='category'>Nhập loại phòng</label>
                <input type="text" class="form-control" name="category" wire:model.live = 'category' @if($event) required @else readonly @endif>
                @error('category')
                    <div class="w-100 text-danger bg-danger-subtle rounded fw-bold p-1 px-2 mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mt-3">
                <label class="form-label fw-bold" for='number'>Nhập số người</label>
                <input type="number" min="1" class="form-control" name="number" wire:model.live = 'number'>
                @error('number')
                    <div class="w-100 text-danger bg-danger-subtle rounded fw-bold p-1 px-2 mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark w-75">Tạo</button>
                <button type="button" class="btn btn-outline-dark w-25" wire:click='resetData'>Xóa</button>
            </div>
        </form>
    </div>
</div>
