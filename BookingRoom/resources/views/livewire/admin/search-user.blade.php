<div class="position-relative">
    <div class="input-group mb-3">
        <span class="input-group-text text-bg-dark">
            <i class='fa-solid fa-search fa-sm'></i>
        </span>
        <input type="text" class="form-control" id="search" wire:model.live.debounce:200ms ='search'
            placeholder="Nhập sđt ...">
    </div>
    @if ($searching)
        <div class="position-absolute form-control d-flex flex-column w-100 z-3 shadow">
            @forelse ($searching as $value)
                <div class="btn-search" wire:click='user'>
                    <b>{{ $value->name }}</b> - <b>{{ $value->phone }}</b> - <b>{{ $value->address }}</b>
                </div>
            @empty
                <div class="fw-bold text-danger p-2">
                    Không có sản phẩm nào!
                </div>
            @endforelse
        </div>
    @endif
</div>
