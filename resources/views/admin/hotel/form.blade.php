<div class="container-fluid">
    <form role="form" action="{{ isset($hotel) ? route('hotel.update', $hotel->id) : route('hotel.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if(isset($hotel))
        @method('PUT')
        @endif
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('h_name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên khách sạn <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control" placeholder="Tên khách sạn" name="h_name" value="{{ old('h_name', isset($hotel) ? $hotel->h_name : '') }}">
                                <span class="text-danger ">
                                    <p class="mg-t-5">{{ $errors->first('h_name') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Địa điểm <sup class="text-danger">(*)</sup></label>
                                    <select class="custom-select" name="h_location_id">
                                        <option value="">Chọn địa điểm</option>
                                        @foreach($locations as $location)
                                        <option
                                            {{ old('h_location_id', isset($hotel->h_location_id) ? $hotel->h_location_id : '') == $location->id ? 'selected="selected"' : '' }}
                                            value="{{ $location->id }}">
                                            {{ $location->l_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        <p class="mg-t-5">{{ $errors->first('h_location_id') }}</p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select class="custom-select" name="h_status">
                                        @foreach($status as $key => $statu)
                                        <option
                                            {{ old('h_status', isset($hotel->h_status) ? $hotel->h_status : '') == $key ? 'selected="selected"' : '' }}
                                            value="{{ $key }}">
                                            {{ $statu }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        <p class="mg-t-5">{{ $errors->first('h_status') }}</p>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('h_address') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Địa chỉ <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control" placeholder="Địa chỉ" name="h_address" value="{{ old('h_address', isset($hotel) ? $hotel->h_address : '') }}">
                                <span class="text-danger ">
                                    <p class="mg-t-5">{{ $errors->first('h_address') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('h_phone') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Số điện thoại <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control" placeholder="Số điện thoại" name="h_phone" value="{{ old('h_phone', isset($hotel) ? $hotel->h_phone : '') }}">
                                <span class="text-danger ">
                                    <p class="mg-t-5">{{ $errors->first('h_phone') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('h_price') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Giá <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="number" class="form-control" placeholder="Giá" name="h_price" value="{{ old('h_price', isset($hotel) ? $hotel->h_price : '') }}">
                                <span class="text-danger ">
                                    <p class="mg-t-5">{{ $errors->first('h_price') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('h_sale') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Giảm giá</label>
                            <div>
                                <input type="number" max="100" class="form-control" placeholder="Giảm giá" name="h_sale" value="{{ old('h_sale', isset($hotel) ? $hotel->h_sale : '') }}">
                                <span class="text-danger ">
                                    <p class="mg-t-5">{{ $errors->first('h_sale') }}</p>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Sửa trường Tổng số phòng -->
                        <div class="form-group {{ $errors->first('h_rooms') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Tổng số phòng <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="number" min="1" class="form-control" placeholder="Nhập tổng số phòng" name="h_rooms" value="{{ old('h_rooms', isset($hotel) ? $hotel->h_rooms : '') }}">
                                <span class="text-danger ">
                                    <p class="mg-t-5">{{ $errors->first('h_rooms') }}</p>
                                </span>
                            </div>
                        </div>

                        <!-- Thêm trường Loại phòng -->
                        <div class="form-group {{ $errors->first('h_room_type') ? 'has-error' : '' }}">
                            <label for="inputRoomType" class="control-label default">Loại phòng <sup class="text-danger">(*)</sup></label>
                            <div>
                                <select class="custom-select" name="h_room_type">
                                    <option value="">Chọn loại phòng</option>
                                    @foreach($roomTypes as $key => $name)
                                    <option value="{{ $key }}"
                                        {{ old('h_room_type', isset($hotel) ? $hotel->h_room_type : '') == $key ? 'selected="selected"' : '' }}>
                                        {{ $name }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    <p class="mg-t-5">{{ $errors->first('h_room_type') }}</p>
                                </span>
                            </div>
                        </div>

                        <!-- Thêm mục tiện nghi -->
                        <div class="form-group {{ $errors->first('h_facilities') ? 'has-error' : '' }}">
                            <label for="inputFacilities" class="control-label default">Tiện nghi <sup class="text-danger">(*)</sup></label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="wifi" name="h_facilities[]" value="Wifi miễn phí"
                                            {{ isset($hotel) && in_array('Wifi miễn phí', json_decode($hotel->h_facilities ?? '[]')) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="wifi"><i class="fas fa-wifi"></i> Wifi miễn phí</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="parking" name="h_facilities[]" value="Bãi đậu xe"
                                            {{ isset($hotel) && in_array('Bãi đậu xe', json_decode($hotel->h_facilities ?? '[]')) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="parking"><i class="fas fa-parking"></i> Bãi đậu xe</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="air_conditioning" name="h_facilities[]" value="Điều hòa"
                                            {{ isset($hotel) && in_array('Điều hòa', json_decode($hotel->h_facilities ?? '[]')) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="air_conditioning"><i class="fas fa-snowflake"></i> Điều hòa</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="elevator" name="h_facilities[]" value="Thang máy"
                                            {{ isset($hotel) && in_array('Thang máy', json_decode($hotel->h_facilities ?? '[]')) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="elevator"><i class="fas fa-level-up-alt text-primary"></i> Thang máy</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="pool" name="h_facilities[]" value="Hồ bơi"
                                            {{ isset($hotel) && in_array('Hồ bơi', json_decode($hotel->h_facilities ?? '[]')) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="pool"><i class="fas fa-swimming-pool"></i> Hồ bơi</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="restaurant" name="h_facilities[]" value="Nhà hàng"
                                            {{ isset($hotel) && in_array('Nhà hàng', json_decode($hotel->h_facilities ?? '[]')) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="restaurant"><i class="fas fa-utensils"></i> Nhà hàng</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="non_smoking" name="h_facilities[]" value="Phòng không hút thuốc"
                                            {{ isset($hotel) && in_array('Phòng không hút thuốc', json_decode($hotel->h_facilities ?? '[]')) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="non_smoking"><i class="fas fa-smoking-ban"></i> Phòng không hút thuốc</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="gym" name="h_facilities[]" value="Phòng tập gym"
                                            {{ isset($hotel) && in_array('Phòng tập gym', json_decode($hotel->h_facilities ?? '[]')) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="gym"><i class="fas fa-dumbbell"></i> Phòng tập gym</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="spa" name="h_facilities[]" value="Spa & Massage"
                                            {{ isset($hotel) && in_array('Spa & Massage', json_decode($hotel->h_facilities ?? '[]')) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="spa"><i class="fas fa-spa"></i> Spa & Massage</label>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger">
                                <p class="mg-t-5">{{ $errors->first('h_facilities') }}</p>
                            </span>
                        </div>

                        <div class="form-group {{ $errors->first('h_description') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Mô tả</label>
                            <div>
                                <textarea name="h_description" id="h_description" cols="30" rows="10" class="form-control" style="height: 225px;">{{ old('h_description', isset($hotel) ? $hotel->h_description : '') }}</textarea>
                                <script>
                                    ckeditor(h_description);
                                </script>
                                @if ($errors->first('h_description'))
                                <span class="text-danger">{{ $errors->first('h_description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('h_content') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Nội dung</label>
                            <div>
                                <textarea name="h_content" id="h_content" cols="30" rows="10" class="form-control" style="height: 225px;">{{ old('h_content', isset($hotel) ? $hotel->h_content : '') }}</textarea>
                                <script>
                                    ckeditor(h_content);
                                </script>
                                @if ($errors->first('h_content'))
                                <span class="text-danger">{{ $errors->first('h_content') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Xuất bản</h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-set">
                            <button type="submit" name="submit" value="{{ isset($hotel) ? 'update' : 'create' }}" class="btn btn-info">
                                <i class="fa fa-save"></i> Lưu dữ liệu
                            </button>
                            <button type="reset" name="reset" value="reset" class="btn btn-danger">
                                <i class="fa fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh</h3>
                    </div>
                    <div class="card-body" style="min-height: 288px">
                        <div class="form-group">
                            <div class="input-group input-file" name="h_image">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">Chọn tệp</button>
                                </span>
                                <input type="text" class="form-control" placeholder='Không có tệp nào ...' />
                                <span class="input-group-btn"></span>
                            </div>
                            <span class="text-danger ">
                                <p class="mg-t-5">{{ $errors->first('h_image') }}</p>
                            </span>
                            @if(isset($hotel) && !empty($hotel->h_image))
                            <img src="{{ asset($hotel->h_image) }}" alt="" class="margin-auto-div img-rounded" id="image_render" style="height: 150px; width:100%;">
                            @else
                            <img src="{{ asset('admin/dist/img/no-image.png') }}" alt="" class="margin-auto-div img-rounded" id="image_render" style="height: 150px; width:100%;">
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- Re-add Album Images upload field -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Album Ảnh</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="h_album_images">Tải nhiều ảnh</label>
                            <input type="file" name="h_album_images[]" multiple class="form-control">
                            @if($errors->first('h_album_images'))
                            <span class="text-danger">
                                <p class="mg-t-5">{{ $errors->first('h_album_images') }}</p>
                            </span>
                            @endif
                            @if(isset($hotel) && !empty($hotel->h_album_images))
                            <?php $album = json_decode($hotel->h_album_images, true); ?>
                            @if(is_array($album) && count($album) > 0)
                            <div class="mt-3">
                                @foreach($album as $img)
                                <img src="{{ asset($img) }}" alt="" class="img-thumbnail" style="height:100px;">
                                @endforeach
                            </div>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>