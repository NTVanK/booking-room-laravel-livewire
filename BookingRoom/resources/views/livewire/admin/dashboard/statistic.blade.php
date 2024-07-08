<div class="container d-flex gap-3">
    <div class="form-control text-bg-danger fw-bold shadow" style="with: 20%">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-dollar-sign fa-2xl"></i>
            <div class="vr mx-3"></div>
            <div>
                <h4>Doanh thu</h4>
                <h5>{{ $sales ?? 0 }}</h5>
            </div>
        </div>
    </div>
    <div class="form-control text-bg-success fw-bold shadow" style="with: 20%">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-hand-holding-dollar fa-2xl"></i>
            <div class="vr mx-3"></div>
            <div>
                <h4>Lợi nhuận</h4>
                <h5>{{ $salesProfit ?? 0 }}</h5>
            </div>
        </div>
    </div>
    <div class="form-control text-bg-warning fw-bold shadow" style="with: 20%">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-house fa-2xl"></i>
            <div class="vr mx-3"></div>
            <div>
                <h4>Còn phòng</h4>
                <h5>{{ $noroom ?? 0 }}</h5>
            </div>
        </div>
    </div>
    <div class="form-control text-bg-info fw-bold shadow" style="with: 20%">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-house-user fa-2xl"></i>
            <div class="vr mx-3"></div>
            <div>
                <h4>Hết phòng</h4>
                <h5>{{ $room ?? 0 }}</h5>
            </div>
        </div>
    </div>
    <div class="form-control text-bg-primary fw-bold shadow" style="with: 20%">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-calendar-check fa-2xl"></i>
            <div class="vr mx-3"></div>
            <div>
                <h4>Chưa duyệt</h4>
                <h5>{{ $confirm ?? 0 }}</h5>
            </div>
        </div>
    </div>
</div>
