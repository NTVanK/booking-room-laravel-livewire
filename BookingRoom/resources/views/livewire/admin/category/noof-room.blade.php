<div>
    <h3>Quản lí phòng</h3>
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
                        <th>Số phòng</th>
                        <th>Loại phòng</th>
                        <th>số người</th>
                        <th>Giá tiền</th>
                        <th>Ghi chú</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody class="border border-dark">
                    @foreach ($rooms as $room)
                        <tr>
                            <td>{{ $room->id }}</td>
                            <td>{{ $room->noofroom }}</td>
                            <td>{{ $room->category->category }}</td>
                            <td>{{ $room->category->number_people }}</td>
                            <td>{{ $room->amount }}</td>
                            <td>{{ $room->note ?? '' }}</td>
                            <td>
                                <button type="btn" class="btn btn-sm btn-success" wire:click='edit({{$room->id}})'>Sửa</button>
                                <button type="btn" class="btn btn-sm btn-danger" wire:click='delete({{$room->id}})'>Xóa</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <form class="border border-dark rounded px-3 py-2 col-xl-4" wire:submit.prevent='save' style="height: max-content">
            <div class="mt-3">
                <label class="form-label fw-bold" for='room'>Nhập tên phòng</label>
                <input type="text" class="form-control" wire:model.live='noofroom' @if($event) required @else readonly @endif>
            </div>
            <div class="mt-3">
                <label class="form-label fw-bold" for='category'>Chọn loại phòng</label>
                <select class="form-select" id="category" wire:model.live='category' required aria-label="Default select example">
                    <option class="text-bg-dark">Chọn loại phòng</option>
                    @foreach ($catgories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }} - {{$category->number_people}} người</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <label class="form-label fw-bold" for='amount'>Mệnh giá</label>
                <input type="text" class="form-control" name="amount" wire:model.live='amount' required>
            </div>
            <div class="mt-3">
                <label class="form-label fw-bold" for='note'>Ghi chú</label>
                <textarea class="form-control" name="note" wire:model.live='note'></textarea>
            </div>
            <hr>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-dark w-75">Tạo</button>
                <button type="button" class="btn btn-outline-dark w-25" wire:click='resetData'>Xóa</button>
            </div>
        </form>
    </div>
</div>
