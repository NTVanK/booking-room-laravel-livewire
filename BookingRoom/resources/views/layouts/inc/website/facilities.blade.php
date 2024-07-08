<section class="container shadow my-5" id="thirdsection">
    <h1 class="text-center my-4">≼ Facilities ≽</h1>
    <div class="body d-flex gap-2 mt-5">
        <div class="box">
            <img src="{{ asset('assets/image/Hoboi.jpg') }}" alt="...">
            <h3>Swiming pool</h3>
        </div>
        <div class="box">
            <img src="{{ asset('assets/image/spa1.png') }}" alt="...">
            <h3>Spa</h3>
        </div>
        <div class="box">
            <img src="{{ asset('assets/image/Nhahang.jpg') }}" alt="...">
            <h3>24*7 Restaurants</h3>
        </div>
        <div class="box">
            <img src="{{ asset('assets/image/Gym1.jpg') }}" alt="...">
            <h3>24*7 Gym</h3>
        </div>
        <div class="box">
            <img src="{{ asset('assets/image/Tructhang.jpg') }}" alt="...">
            <h3>Heli service</h3>
        </div>
    </div>
    <hr>
    <div class="footer form-control mt-4">
        <div class="text-title p-1">
            <b>Thông tin: </b>
            Nội thất của phòng được bố trí hài hòa với gam màu trang nhã và ánh sáng dịu nhẹ. Giường ngủ rộng rãi, nệm êm ái cùng bộ chăn ga gối cao cấp đảm bảo giấc ngủ ngon.
            Phòng còn được trang bị bàn làm việc, TV màn hình phẳng, minibar và máy pha cà phê, đáp ứng nhu cầu giải trí và công việc của khách hàng. Wi-Fi miễn phí có sẵn trong toàn bộ khu vực phòng, giúp khách dễ dàng kết nối với internet.
        </div>
        <div class="vr mx-2"></div>
        <div class='text-btn p-1'>
            <a href="{{ route('home') }}" class="col navbar-brand d-flex align-items-center gap-2">
                <img src="{{ asset('assets\image\Logo.png') }}" height="38" alt="Logo">
                <span class='fw-bold fs-3'>The Line</span>
            </a>
            <button type="button" class="btn" onclick="window.location.href='#booking'">
                Đăng ký ngay
            </button>
        </div>
    </div>
</section>
