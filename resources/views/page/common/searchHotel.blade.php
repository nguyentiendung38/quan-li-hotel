<form action="{{ route('hotel') }}" class="search-property-1">
    <div class="row no-gutters" style="background: #f1f3f5; 
                                    padding: 25px; 
                                    border-radius: 15px; 
                                    box-shadow: inset 0 0 15px rgba(0,0,0,0.03);
                                    border: 1px solid #e9ecef;">
        <div class="col-lg d-flex">
            <div class="form-group p-2 border-0">
                <label for="#">Khách sạn</label>
                <div class="form-field">
                    <div class="icon"><span class="fa fa-search"></span></div>
                    <input type="text" name="key_hotel" class="form-control" placeholder="Tên khách sạn">
                </div>
            </div>
        </div>
        <div class="col-lg d-flex">
            <div class="form-group p-2">
                <label for="#">Địa điểm</label>
                <div class="form-field">
                    <div class="select-wrap">
                        <div class="icon"><span class="fa fa-chevron-down"></span></div>
                        <select name="location_id" id="" class="form-control">
                            <option value="">Chọn địa điểm</option>
                            @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->l_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Room Type Column -->
        <div class="col-lg d-flex">
            <div class="form-group p-2">
                <label for="#">Loại Phòng</label>
                <div class="form-field">
                    <div class="select-wrap">
                        <div class="icon"><span class="fa fa-chevron-down"></span></div>
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
                        <select name="room_type" class="form-control">
                            @foreach($roomTypes as $key => $value)
                            <option value="{{ $key }}" {{ request('room_type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg d-flex">
            <div class="form-group p-2">
                <label for="#">Khoảng giá</label>
                <div class="form-field">
                    <div class="select-wrap">
                        <div class="icon"><span class="fa fa-chevron-down"></span></div>
                        <select name="price" id="" class="form-control">
                            <option value="">Chọn khoảng giá</option>
                            <option value="0-500000">0->500.000</option>
                            <option value="500000-800000">500.000->800.000</option>
                            <option value="800000-1000000">800.000->1.000.000</option>
                            <option value="1000000-15000000">1.000.000->1.500.000</option>
                            <option value="1500000-2000000">1.500.000->2.000.000</option>
                            <option value="4000000-5000000">4.000.000->5.000.000</option>
                            <option value="5000000-6000000">5.000.000->6.000.000</option>
                            <option value="6000000-7000000">6.000.000->7.000.000</option>
                            <option value="7000000-8000000">7.000.000->8.000.000</option>
                            <option value="8000000-9000000">8.000.000->9.000.000</option>
                            <option value="9000000-10000000">9.000.000->10.000.000</option>
                            <option value="10000000-11000000">10.000.000->11.000.000</option>
                            <option value="11000000-12000000">11.000.000->12.000.000</option>
                            <option value="12000000-13000000">12.000.000->13.000.000</option>
                            <option value="13000000-14000000">13.000.000->14.000.000</option>
                            <option value="14000000-15000000">14.000.000->15.000.000</option>
                            <option value="15000000-100000000"> Trên 15.000.000</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg d-flex">
            <div class="form-group d-flex w-100 border-0">
                <div class="form-field w-100 align-items-center d-flex">
                    <input type="submit" value="Search"
                        class="align-self-stretch form-control btn btn-primary"
                        style="border-radius: 30px; 
                                font-weight: 600; 
                                padding: 12px 35px !important;
                                margin-top: 24px;
                                box-shadow: 0 3px 15px rgba(16,137,255,0.2);">
                </div>
            </div>
        </div>
    </div>
</form>