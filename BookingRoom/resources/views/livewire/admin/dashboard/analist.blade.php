<div class="card shadow mb-4" wire:poll.keep-alive>
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Tổng quan thu nhập (trong vòng 5 tháng)</h6>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary"><i class="fa-solid fa-repeat"></i></button>
            <input type="date" class="form-control" wire:model.live='date'>
        </div>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="d-flex bg-primary px-2 py-1 mb-3 rounded">
            <div class="text-light" style="width: 20%">0</div>
            <div class="text-light" style="width: 20%">500,000</div>
            <div class="text-light" style="width: 20%">1,000,000</div>
            <div class="text-light" style="width: 20%">1,500,000</div>
            <div class="text-light" style="width: 20%">2,000,000</div>
        </div>

        @php
            function percent($total)
            {
                if ($total != 0) {
                    $percent = $total / (2000000 * 0.01);
                }

                return $percent ?? 0;
            }
        @endphp

        @foreach ($fourTotal as $key => $item)
            <h4 class="small font-weight-bold"> {{ $key }}
                <span class="float-right text-danger">{{ $item[0] }}(VND)</span> -
                <span class="float-right text-danger">{{ $item[1] }}(VND)</span>
            </h4>
            <div class="progress mb-1">
                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ percent($item[0]) }}%"
                    aria-valuenow="{{ percent($item[0]) }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="progress mb-4">
                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ percent($item[1]) }}%"
                    aria-valuenow="{{ percent($item[1]) }}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        @endforeach
    </div>
</div>
