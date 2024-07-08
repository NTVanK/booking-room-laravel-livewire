<div class="container">
    <div class="form-control d-flex align-items-center mb-3">
        <h4>Lịch sử đặt phòng</h4>
        <div class="btn-group btn-group-sm ms-auto">
            <input type="search" class="form-control" wire:model.live='search' id="search"
                placeholder="Nhâp tên khách hàng...">
            <button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-toggle-split"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ $searchTitle ?? '' }}
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-item">
                    <div class="text-bg-warning cursor-pointer p-2 rounded" wire:click='value("no confirm")'>Chưa
                        checkin</div>
                </li>
                <li class="dropdown-item">
                    <div class="text-bg-danger cursor-pointer p-2 rounded" wire:click='value("confirm")'>Đã checkin
                    </div>
                </li>
                <li class="dropdown-item">
                    <div class="text-bg-success cursor-pointer p-2 rounded" wire:click='value("complete")'>Hoàn thành
                    </div>
                </li>
                <li class="dropdown-item">
                    <div class="text-bg-dark cursor-pointer p-2 rounded" wire:click='value("payment")'>Thanh toán</div>
                </li>
                <li class="dropdown-item">
                    <div class="text-bg-dark cursor-pointer p-2 rounded" wire:click='value("cancel")'>Hủy đặt</div>
                </li>
            </ul>
        </div>
        <button class="btn btn-outline-primary ms-2" wire:click='resetData'>
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
                    <th>Số người</th>
                    <th>Trạng thái</th>
                    <th>Từ ngày</th>
                    <th>Đến ngày</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr class="text-center">
                        <td class="text-danger-emphasis fw-bold">{{ $book->user->name ?? 'ẩn danh' }}</td>
                        <td class="text-warning-emphasis fw-bold">{{ $book->user->phone ?? 'ẩn danh' }}</td>
                        <td class="text-primary-emphasis fw-bold">{{ $book->room->noofroom ?? 'ẩn danh' }}</td>
                        <td class="text-primary-emphasis fw-bold">{{ $book->room->category->category ?? 'ẩn danh' }}
                        </td>
                        <td class="text-primary-emphasis fw-bold">{{ $book->people ?? 'ẩn danh' }}</td>
                        <td>
                            @if ($book->status == 'no confirm')
                                <span class="badge text-bg-warning">Chưa checkin</span>
                            @elseif($book->status == 'confirm')
                                <span class="badge text-bg-danger">Đã checkin</span>
                            @elseif($book->status == 'complete')
                                <span class="badge text-bg-success">Đã hoàn thành</span>
                            @elseif($book->status == 'payment')
                                <span class="badge text-bg-primary">Đợi thanh toán</span>
                            @elseif($book->status == 'cancel')
                                <span class="badge text-bg-dark">Đã hủy</span>
                            @endif
                        </td>
                        <td class="text-success fw-bold">{{ $book->created_at ?? 'ẩn danh' }}</td>
                        <td class="text-success-emphasis fw-bold">{{ $book->updated_at ?? 'ẩn danh' }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-info"
                                wire:click='detail({{ $book->id }})'>Xem</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($detailRoom)
        <hr>
        <div class="form-control p-3" wire:transition>
            <div class="d-flex align-items-center">
                <h4>Xem thông tin chi tiết</h4>
                @if ($detailRoom->status == 'no confirm')
                    <button type="button" class="btn btn-warning fw-bold ms-auto" disabled>
                        Chưa checkin
                    </button>
                @elseif($detailRoom->status == 'confirm')
                    <button type="button" class="btn btn-danger fw-bold ms-auto" disabled>
                        Đã checkin
                    </button>
                @elseif($detailRoom->status == 'complete')
                    <button type="button" class="btn btn-success fw-bold ms-auto" disabled>
                        Đã hoàn thành
                    </button>
                @elseif($detailRoom->status == 'payment')
                    <button type="button" class="btn btn-primary fw-bold ms-auto" disabled>
                        Đợi thanh toán
                    </button>
                @elseif($detailRoom->status == 'cancel')
                    <button type="button" class="btn btn-dark fw-bold ms-auto" disabled>
                        Đã hủy
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
