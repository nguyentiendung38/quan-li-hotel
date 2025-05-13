<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Form Tìm Kiếm Tour</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ✅ Flatpickr Theme Material Blue -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css">

  <!-- ✅ CSS Giao diện sẵn có -->
  <style>
    .search-property-1 .form-group label {
      color: #1976D2;
      font-weight: 600;
    }

    .search-property-1 .btn-search {
      background: linear-gradient(45deg, #2196F3, #1976D2);
      color: #fff;
      padding: 12px 35px;
      margin-top: 24px;
      border-radius: 25px;
      font-weight: 500;
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

    /* Add new icon styling */
    .search-property-1 .form-field .icon {
        color: #2196F3; /* Change icon color to match theme */
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .search-property-1 .form-field:hover .icon {
        opacity: 1;
    }

    /* Style for select dropdown icon */
    .select-wrap .icon {
        color: #2196F3 !important; /* Force icon color */
    }
  </style>
</head>
<body>

<!--  FORM TÌM TOUR -->
<form action="{{ route('tour') }}" class="search-property-1">
  <div class="row no-gutters" style="background: #f1f3f5; padding: 25px; border-radius: 15px; box-shadow: inset 0 0 15px rgba(0,0,0,0.03); border: 1px solid #e9ecef;">

    <!-- Tên Tour -->
    <div class="col-md d-flex">
      <div class="form-group p-2 border-0">
        <label>Tour</label>
        <div class="form-field">
          <div class="icon"><span class="fa fa-search"></span></div>
          <input type="text" name="key_tour" value="{{ Request::get('key_tour') }}" class="form-control" placeholder="Tìm kiếm">
        </div>
      </div>
    </div>

    <!-- Ngày Khởi Hành -->
    <div class="col-md d-flex">
      <div class="form-group p-2">
        <label>Ngày Khởi Hành</label>
        <div class="form-field">
          <div class="icon"><span class="fa fa-calendar"></span></div>
          <input type="text" name="t_start_date" value="{{ Request::get('t_start_date') }}" class="form-control checkin_date" placeholder="Ngày Khởi Hành" autocomplete="off">
        </div>
      </div>
    </div>

    <!-- Khoảng Giá -->
    <div class="col-md d-flex">
      <div class="form-group p-2">
        <label>Khoảng giá</label>
        <div class="form-field">
          <div class="select-wrap">
            <div class="icon"><span class="fa fa-chevron-down"></span></div>
            <select name="price" class="form-control">
              <option value="">Chọn khoảng giá</option>
              <option value="0-500000">0→500.000</option>
              <option value="500000-800000">500.000→800.000</option>
              <option value="800000-1500000">800.000→1.500.000</option>
              <option value="1500000-3000000">1.500.000→3.000.000</option>
              <option value="3000000-5000000">3.000.000→5.000.000</option>
              <option value="5000000-10000000">5.000.000→10.000.000</option>
              <option value="10000000-15000000">10.000.000→15.000.000</option>
              <option value="15000000-100000000">Trên 15.000.000</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Nút Tìm kiếm -->
    <div class="col-md d-flex">
      <div class="form-group d-flex w-100 border-0">
        <div class="form-field w-100 align-items-center d-flex">
          <button type="submit" class="btn-search">Tìm kiếm</button>
        </div>
      </div>
    </div>

  </div>
</form>

<!-- ✅ Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr(".checkin_date", {
    dateFormat: "d/m/Y",
    minDate: "today",
    disableMobile: true,
    locale: {
      firstDayOfWeek: 1,
      weekdays: {
        shorthand: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
        longhand: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],
      },
      months: {
        shorthand: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'],
        longhand: ['Tháng Một', 'Tháng Hai', 'Tháng Ba', 'Tháng Tư', 'Tháng Năm', 'Tháng Sáu', 'Tháng Bảy', 'Tháng Tám', 'Tháng Chín', 'Tháng Mười', 'Tháng Mười Một', 'Tháng Mười Hai'],
      },
    }
  });
</script>

</body>
</html>
