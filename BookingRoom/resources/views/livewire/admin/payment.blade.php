<div class="container">
    <div class="form-control d-flex align-items-center mb-3">
        <h4>Thanh toán hóa đơn</h4>
        <input type="search" class="form-control w-25 ms-auto" wire:model.live='search' id="search"
            placeholder="Nhâp tên khách hàng...">
        <button class="btn btn-warning ms-2" wire:click='value("confirm")'>
            Đã thanh toán
        </button>
        <button class="btn btn-success ms-2" wire:click='value("all")'>
            Xem tất cả
        </button>
        <button class="btn btn-primary ms-2" wire:click='resetData'>
            <i class="fa-solid fa-retweet"></i>
        </button>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade w-100 show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade w-100 show" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="form-control">
        <table class="table table-bordered rounded overflow-hidden">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>Khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Số phòng</th>
                    <th>Loại phòng</th>
                    <th>Trạng thái</th>
                    <th>Thành tiền</th>
                    <th>Từ ngày</th>
                    <th>Đến ngày</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr class="text-center">
                        <td class="text-danger-emphasis fw-bold">{{ $payment->user->name ?? 'ẩn danh' }}</td>
                        <td class="text-warning-emphasis fw-bold">{{ $payment->user->phone ?? 'ẩn danh' }}</td>
                        <td class="text-primary-emphasis fw-bold">{{ $payment->book->room->noofroom ?? 'ẩn danh' }}</td>
                        <td class="text-primary-emphasis fw-bold">
                            {{ $payment->book->room->category->category ?? 'ẩn danh' }}
                        </td>
                        <td class="text-primary-emphasis fw-bold">{{ $payment->total_amount ?? 'ẩn danh' }}</td>
                        <td>
                            @if ($payment->status == 'no confirm')
                                <span class="badge text-bg-warning">Chưa thanh toán</span>
                            @elseif($payment->status == 'confirm')
                                <span class="badge text-bg-danger">Đã thanh toán</span>
                            @endif
                        </td>
                        <td class="text-success fw-bold">{{ $payment->book->created_at ?? 'ẩn danh' }}</td>
                        <td class="text-success-emphasis fw-bold">{{ $payment->book->updated_at ?? 'ẩn danh' }}</td>
                        <td>
                            @if ($payment->status == 'no confirm')
                                <button type="button" class="btn btn-sm btn-danger w-100 mb-2"
                                    wire:click='payment({{ $payment->id }})'>Thanh toán</button>
                            @endif
                            <button type="button" class="btn btn-sm btn-outline-info w-100"
                                wire:click='detail({{ $payment->book_id }})'>Xem</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($detailRoom)
        <hr>
        <div class="form-control p-3">
            <div class="d-flex align-items-center">
                <h4>Xem thông tin chi tiết</h4>
                @if ($detailRoom->status == 'payment')
                    <button type="button" class="btn btn-warning fw-bold ms-auto" disabled>
                        Chưa Thanh toán
                    </button>
                @elseif($detailRoom->status == 'complete')
                    <button type="button" class="btn btn-success fw-bold ms-auto" disabled>
                        Đã thanh toán
                    </button>
                @endif
                <button type="button" class="btn btn-danger ms-2" wire:click='remove'>
                    <i class="fa-solid fa-close"></i>
                </button>
            </div>
            <hr>
            <div class="form-control">
                <b>Khách hàng: </b>{!! $detailRoom->user->name ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
                <b>Email: </b>{!! $detailRoom->user->email ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
                <b>Số điện thoại: </b>{!! $detailRoom->user->phone ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
                <b>Địa chỉ: </b> {!! $detailRoom->user->address ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
                <b>Số phòng: </b> {!! $detailRoom->room->noofroom ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
                <b>Loại phòng: </b> {{ $detailRoom->room->category->category }} -
                {{ $detailRoom->room->category->number_people }} người <br>
                <b>Giá tiền: </b> {{ $detailRoom->room->amount }} - 1 ngày<br>
                <b>Tổng tiền: </b> {{ $detailRoom->total_amount }} -
                {{ $detailRoom->total_amount / $detailRoom->room->amount }} ngày<br>
                <b>Đặt từ ngày: </b> {!! $detailRoom->created_at ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!} <br>
                <b>Đến ngày: </b> {!! $detailRoom->updated_at ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
                <b>Nhận phòng: </b> {!! $detailRoom->check->checkin ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!} <br>
                <b>Trả phòng: </b> {!! $detailRoom->check->checkout ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
            </div>
        </div>
    @endif
</div>
