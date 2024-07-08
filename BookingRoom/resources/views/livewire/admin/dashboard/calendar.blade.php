<div class="container mt-3">
    <div class="form-control text-bg-dark d-flex mb-3">
        <h4>Lịch đặt phòng</h4>
        <input type="date" class="form-control ms-auto" style="width: 30%" wire:model.live='month' id="month"/>
        <a href="{{ route('admin.bookingManagement') }}" class="btn btn-primary ms-2">Quản lí phòng</a>
    </div>
    <table class="table table-bordered rounded overflow-hidden table-striped shadow">
        <thead class="table-dark">
            <tr class="text-center">
                <th colspan="{{$day_is + 1}}">Tháng {{ $month_is }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->noofroom }}</td>
                    @for ($i = 1; $i <= $day_is; $i++)
                        @if($room->getDayBefore($month_is, $year_is) <= $i && $i < $room->getDayAfter($month_is, $year_is))
                            <td class="{{ $room->checkRoom() == 'confirm' ? 'bg-danger' : 'bg-warning' }}
                            ">{{$i}}</td>
                        @else
                        <td>{{$i}}</td>
                        @endif
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
