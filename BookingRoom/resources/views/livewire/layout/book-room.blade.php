<div class="container">
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

    <div class="row">
        <div class="position-relative col-6">
            <h5 class="fw-bold">Thông tin đặt phòng</h5>
            <div class="form-control">
                <div class='form-control text-bg-dark gap-4'>
                    <div class="d-flex align-items-center gap-5 w-100">
                        <div class="w-100">
                            <label for="dateBefore" class="form-label fw-bold">Từ ngày</label>
                            <input type="date" class="form-control" id="dateBefore" wire:model.live='before'>
                        </div>
                        <i class="fa-solid fa-calendar-days fa-xl"></i>
                        <div class="w-100">
                            <label for="dateAfter" class="form-label fw-bold">Đến ngày</label>
                            <input type="date" class="form-control" id="dateAfter" wire:model.live='after'>
                        </div>
                    </div>
                    <div class="w-100 mt-3">
                        <div class="dropdown w-100">
                            <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Chọn phòng
                            </button>
                            <ul class="dropdown-menu w-100">
                                @foreach ($rooms as $room)
                                    @if ($room->checkRoom() === 'no confirm')
                                        <li class="px-3 py-1" wire:click='addRoom({{ $room->id }})'>
                                            {{ $room->noofroom }} - {{ $room->category->category }} -
                                            {{ $room->category->number_people }} người
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="w-100 mt-2">
                        <label class="form-label">Danh sách phòng</label><br>
                        @foreach ($roomID as $room)
                            <button type="button" class="btn btn-sm btn-primary mt-2" wire:click='deleteRoom({{ $room->id }})'>
                                {{ $room->noofroom }} - {{ $room->category->category }} -
                                            {{ $room->category->number_people }} người
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        {{--  --}}
        <div class="ms-auto col-6">
            <h5 class="fw-bold">Kiểm tra thông tin đặt</h5>
            <div class="form-control">
                @if ($createUser)
                    <div class="form-control">
                        <livewire:admin.addUser />
                    </div>
                    <hr>
                @endif
                <b>Khách hàng: </b>{!! $user->name ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
                <b>Email: </b>{!! $user->email ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
                <b>Số điện thoại: </b>{!! $user->phone ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
                <b>Địa chỉ: </b> {!! $user->address ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
                @php
                    $total_price = 0;
                @endphp

                @foreach ($roomID as $room)
                    <hr>
                    <b>Số phòng: </b> {!! $room->noofroom ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
                    <b>Loại phòng: </b> {{ $room->category->category }} - {{ $room->category->number_people }} người <br>
                    <b>Giá tiền: </b> {{ $room->amount }} - 1 ngày<br>
                    <b>Tổng tiền: </b> {{ $room->amount * $day }} {{$day}} ngày<br>
                    <hr>
                    @php
                        $total_price += $room->amount * $day;
                    @endphp
                @endforeach

                <hr>
                <b>Tổng cộng: </b> {{ $total_price }} - {{$day}} ngày<br>
                <b>Đặt từ ngày: </b> {!! $before ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!} <br>
                <b>Đến ngày: </b> {!! $after ?? '<b class="text-danger fw-bold">Chưa có!</b>' !!}<br>
            </div>
        </div>

    </div>
    <hr>
    <div class="d-flex gap-3 mt-2">
        <button class="btn btn-success ms-auto" wire:click='save'>Đặt phòng</button>
    </div>

    <style>
        .btn-search {
            padding: 5px 7px;
            border-radius: 5px;
            cursor: pointer;
            transform: 0.25s;

            &:hover {
                background: black;
                color: white;
                transition: background 0.25s;
            }
        }
    </style>
</div>
