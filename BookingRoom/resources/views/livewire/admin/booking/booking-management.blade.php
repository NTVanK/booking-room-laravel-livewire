<div>
    <div class="form-control d-flex align-items-center mb-3">
        <h4>Quản lí phòng</h4>
        <div class="btn-group btn-group-sm ms-auto">
            <input type="search" class="form-control" wire:model.live='search' id="search" placeholder="{{ $searchText ?? '' }}" @if($searchText == '') readonly @endif>
            <button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-toggle-split"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ $searchTitle ?? '' }}
            </button>
            <ul class="dropdown-menu">
                <li class="dropdown-item" >
                    <div wire:click='value("noofroom")'>Số phòng</div>
                </li>
                <li class="dropdown-item" > 
                    <div wire:click='value("name")'>Khách hàng đã đặt</div>
                </li>
                <li class="dropdown-item" > 
                    <div wire:click='value("noroom")'>Phòng trống</div>
                </li>
            </ul>
        </div>
        <button class="btn btn-outline-primary ms-2" wire:click='resetData'>
            <i class="fa-solid fa-retweet"></i>
        </button>
        <button class="btn btn-dark ms-2" wire:click='cancel'>Hủy Phòng</button>
        <button class="btn btn-danger ms-2" wire:click='checkout'>Trả phòng</button>
        <button class="btn btn-primary ms-2" wire:click='checkin'>Nhận phòng</button>
        <button class="btn btn-info ms-2" wire:click='detail'>Xem chi tiết</button>
        <button class="btn btn-success ms-2" wire:click='order'>Đặt phòng</button>
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
    <div class="form-control d-flex gap-3 mt-2">
        @if ($rooms)
            @foreach ($rooms as $room)
                <div class="form-control
                    @if ($room->checkRoom() === 'no confirm') 
                        text-secondary-emphasis bg-body-secondary
                    @elseif ($room->checkRoom() === 'waite')
                        text-warning-emphasis bg-warning-subtle
                    @elseif ($room->checkRoom() === 'confirm')
                        text-danger-emphasis bg-danger-subtle @endif
                    @if ($active == $room->id) active @endif 
                ratio ratio-1x1"
                    style="width: 15%;" wire:click='check({{ $room->id }})'>
                    <div class="box fw-bold">
                        {{ $room->noofroom }}<br>
                        {{ $room->category->category }}<br>
                        {{ $room->getName() }}
                    </div>
                </div>
            @endforeach
        @else
            <div class="form-control text-center bg-danger-subtle">
                <b class="text-danger">Không tìm thấy thông tin!</b>
            </div>
        @endif
    </div>

    @if ($detailRoom)
        <hr>
        <div class="form-control p-3">
            <div class="d-flex align-items-center">
                <h4>Xem chi tiết phòng</h4>
                <button type="button" class="btn btn-danger ms-auto" wire:click='remove'>
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
                <b>Loại phòng: </b> {{ $detailRoom->room->category->category }} - {{  $detailRoom->room->category->number_people }} người <br>
                <b>Giá tiền: </b> {{ $detailRoom->room->amount }} - 1 ngày<br>
                <b>Tổng tiền: </b> {{ $detailRoom->total_amount }} {{$detailRoom->total_amount / $detailRoom->room->amount}} ngày<br>
                <b>Đặt từ ngày: </b> {!! $detailRoom->created_at ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!} <br>
                <b>Đến ngày: </b> {!! $detailRoom->updated_at ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
            </div>
        </div>
    @endif

    <style>
        .box {
            cursor: pointer;
            display: flex;
            align-items: center;
            flex-direction: center;
            justify-content: center;
        }

        .active {
            border: black;
            box-shadow: 0 3px 5px black;
            transition: 0.25s;
        }
    </style>
</div>
