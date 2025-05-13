<!-- Thêm đoạn CSS này vào <head> hoặc file CSS chung của bạn -->
<style>
  .search-property-1 .btn-search {
    background: linear-gradient(45deg, #2196F3, #1976D2);
    color: #fff;
    padding: 12px 35px;
    margin-top: 24px;
    border-radius: 30px;
    font-weight: 600;
    border: none;
    box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
    transition: all 0.3s ease;
    cursor: pointer;
    width: 100%;
  }

  .search-property-1 .btn-search:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
  }

  /* Màu cho các label */
  .search-property-1 .form-group label {
    color: #1976D2;
    font-weight: 600;
  }
  .search-property-1 select {
    -webkit-appearance: none; /* Chrome, Safari */
    -moz-appearance: none;    /* Firefox */
    appearance: none;         /* Các trình duyệt hiện đại */
    background-image: none;   /* Xóa nền có sẵn (nếu có) */
    padding-right: 15px;      /* Cho đẹp khi mất icon */
  }

  /* Nếu bạn muốn canh giữa nội dung sau khi xoá icon */
  .search-property-1 .form-field select {
    text-align-last: left; /* giữ căn trái */
  }
</style>

<form action="{{ route('hotel') }}" class="search-property-1">
  <div class="row no-gutters" style="background: #f1f3f5; 
                                      padding: 25px; 
                                      border-radius: 15px; 
                                      box-shadow: inset 0 0 15px rgba(0,0,0,0.03);
                                      border: 1px solid #e9ecef;">
    <div class="col-lg d-flex">
      <div class="form-group p-2 border-0">
        <label>Khách sạn</label>
        <div class="form-field">
          <div class="icon"><span class="fa fa-search"></span></div>
          <input type="text" name="key_hotel" class="form-control" placeholder="Tên khách sạn">
        </div>
      </div>
    </div>
    <div class="col-lg d-flex">
      <div class="form-group p-2">
        <label>Địa điểm</label>
        <div class="form-field">
          <div class="icon"><span class="fa fa-chevron-down"></span></div>
          <select name="location_id" class="form-control">
            <option value="">Chọn địa điểm</option>
            @foreach($locations as $location)
            <option value="{{ $location->id }}">{{ $location->l_name }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="col-lg d-flex">
      <div class="form-group p-2">
        <label>Loại Phòng</label>
        <div class="form-field">
          <div class="icon"><span class="fa fa-chevron-down"></span></div>
          <select name="room_type" class="form-control">
            @php
            $roomTypes = [
            '' => 'Chọn loại phòng',
            'standard_double'=> 'Phòng tiêu chuẩn giường đôi',
            'superior_double'=> 'Phòng Superior giường đôi',
            'superior_twin' => 'Phòng Superior 2 giường đơn',
            'deluxe_double' => 'Phòng Deluxe giường đôi',
            'deluxe_triple' => 'Phòng Deluxe cho 3 người',
            'family_room' => 'Phòng gia đình',
            'junior_suite' => 'Phòng Suite Junior gia đình',
            'deluxe_quad' => 'Phòng Deluxe cho 4 người'
            ];
            @endphp
            @foreach($roomTypes as $key => $value)
            <option value="{{ $key }}" {{ request('room_type') == $key ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="col-lg d-flex">
      <div class="form-group p-2">
        <label>Khoảng giá</label>
        <div class="form-field">
          <div class="icon"><span class="fa fa-chevron-down"></span></div>
          <select name="price" class="form-control">
            <option value="">Chọn khoảng giá</option>
            <option value="0-500000">0→500.000</option>
            <option value="500000-800000">500.000→800.000</option>
            <option value="800000-1000000">800.000→1.000.000</option>
            <option value="1000000-15000000">1.000.000→1.500.000</option>
            <option value="1500000-2000000">1.500.000→2.000.000</option>
            <option value="4000000-5000000">4.000.000→5.000.000</option>
            <option value="5000000-6000000">5.000.000→6.000.000</option>
            <option value="6000000-7000000">6.000.000→7.000.000</option>
            <option value="7000000-8000000">7.000.000→8.000.000</option>
            <option value="8000000-9000000">8.000.000→9.000.000</option>
            <option value="9000000-10000000">9.000.000→10.000.000</option>
            <option value="10000000-11000000">10.000.000→11.000.000</option>
            <option value="11000000-12000000">11.000.000→12.000.000</option>
            <option value="12000000-13000000">12.000.000→13.000.000</option>
            <option value="13000000-14000000">13.000.000→14.000.000</option>
            <option value="14000000-15000000">14.000.000→15.000.000</option>
            <option value="15000000-100000000">Trên 15.000.000</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-lg d-flex">
      <div class="form-group d-flex w-100 border-0">
        <div class="form-field w-100 align-items-center d-flex">
          <button type="submit" class="btn-search">Tìm kiếm</button>
        </div>
      </div>
    </div>
  </div>
</form>