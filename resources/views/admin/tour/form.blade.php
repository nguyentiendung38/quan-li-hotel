<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('t_title') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tiêu đề tour <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control" placeholder="Tiêu tour" name="t_title" value="{{ old('t_title',isset($tour) ? $tour->t_title : '') }}">
                                <span class="text-danger ">
                                    <p class="mg-t-5">{{ $errors->first('t_title') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Địa điểm <sup class="text-danger">(*)</sup></label>
                                    <select class="custom-select" name="t_location_id">
                                        <option value="">Chọn địa điểm</option>
                                        @foreach($locations as $location)
                                        <option
                                            {{old('t_location_id', isset($tour->t_location_id ) ? $tour->t_location_id  : '') == $location->id ? 'selected="selected"' : ''}}
                                            value="{{$location->id}}">
                                            {{$location->l_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        <p class="mg-t-5">{{ $errors->first('t_location_id') }}</p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select class="custom-select" name="t_status">
                                        @foreach($status as $key => $statu)
                                        <option
                                            {{old('t_status', isset($tour->t_status ) ? $tour->t_status : '') == $key ? 'selected="selected"' : ''}}
                                            value="{{$key}}">
                                            {{$statu}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        <p class="mg-t-5">{{ $errors->first('t_status') }}</p>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Số lượng người tham gia <sup class="text-danger">(*)</sup></label>
                                    <input type="text" class="form-control" placeholder="" name="t_number_guests" value="{{ old('t_number_guests',isset($tour) ? $tour->t_number_guests : '') }}">
                                    <span class="text-danger">
                                        <p class="mg-t-5">{{ $errors->first('t_location_id') }}</p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Giảm giá </label>
                                        <input type="number" max="100" class="form-control" placeholder="" name="t_sale" value="{{ old('t_sale',isset($tour) ? $tour->t_sale : '') }}">
                                        <span class="text-danger">
                                            <p class="mg-t-5">{{ $errors->first('t_sale') }}</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Giá người lớn <sup class="text-danger">(*)</sup></label>
                                    <input type="number" class="form-control" placeholder="" name="t_price_adults" value="{{ old('t_price_adults',isset($tour) ? $tour->t_price_adults : '') }}">
                                    <span class="text-danger">
                                        <p class="mg-t-5">{{ $errors->first('t_price_adults') }}</p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Giá trẻ em <sup class="text-danger">(*)</sup></label>
                                        <input type="number" class="form-control" placeholder="" name="t_price_children" value="{{ old('t_price_children',isset($tour) ? $tour->t_price_children : '') }}">
                                        <span class="text-danger">
                                            <p class="mg-t-5">{{ $errors->first('t_price_children') }}</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Phương tiện di chuyển</label>
                                    <input type="text" class="form-control" placeholder="" name="t_move_method" value="{{ old('t_move_method',isset($tour) ? $tour->t_move_method : '') }}">
                                    <span class="text-danger">
                                        <p class="mg-t-5">{{ $errors->first('t_move_method') }}</p>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Địa điểm xuất phát</label>
                                        <input type="text" class="form-control" placeholder="" name="t_starting_gate" value="{{ old('t_starting_gate',isset($tour) ? $tour->t_starting_gate : '') }}">
                                        <span class="text-danger">
                                            <p class="mg-t-5">{{ $errors->first('t_starting_gate') }}</p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Hạng sao khách sạn <sup class="text-danger">(*)</sup></label>
                                    <select class="custom-select" name="t_hotel_star">
                                        <option value="">Chọn hạng sao</option>
                                        <option value="1" {{old('t_hotel_star', isset($tour->t_hotel_star) ? $tour->t_hotel_star : '') == 1 ? 'selected="selected"' : ''}}>Khách sạn 1 sao ⭐</option>
                                        <option value="2" {{old('t_hotel_star', isset($tour->t_hotel_star) ? $tour->t_hotel_star : '') == 2 ? 'selected="selected"' : ''}}>Khách sạn 2 sao ⭐⭐</option>
                                        <option value="3" {{old('t_hotel_star', isset($tour->t_hotel_star) ? $tour->t_hotel_star : '') == 3 ? 'selected="selected"' : ''}}>Khách sạn 3 sao ⭐⭐⭐</option>
                                        <option value="4" {{old('t_hotel_star', isset($tour->t_hotel_star) ? $tour->t_hotel_star : '') == 4 ? 'selected="selected"' : ''}}>Khách sạn 4 sao ⭐⭐⭐⭐</option>
                                        <option value="5" {{old('t_hotel_star', isset($tour->t_hotel_star) ? $tour->t_hotel_star : '') == 5 ? 'selected="selected"' : ''}}>Khách sạn 5 sao ⭐⭐⭐⭐⭐</option>
                                    </select>
                                    <span class="text-danger">
                                        <p class="mg-t-5">{{ $errors->first('t_hotel_star') }}</p>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('t_journeys') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Hành trình <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control" placeholder="Hành trình" name="t_journeys" value="{{ old('t_journeys',isset($tour) ? $tour->t_journeys : '') }}">
                                <span class="text-danger ">
                                    <p class="mg-t-5">{{ $errors->first('t_journeys') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('t_schedule') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Lịch trình <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control" placeholder="Lịch trình" name="t_schedule" value="{{ old('t_schedule',isset($tour) ? $tour->t_schedule : '') }}">
                                <span class="text-danger ">
                                    <p class="mg-t-5">{{ $errors->first('t_schedule') }}</p>
                                </span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('t_description') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Mô tả lịch trình </label>
                            <div>
                                <textarea name="t_description" id="t_description" cols="30" rows="10" class="form-control" style="height: 225px;">{{ old('t_description', isset($tour) ? $tour->t_description : '') }}</textarea>
                                <script>
                                    ckeditor(t_description);
                                </script>
                                @if ($errors->first('t_description'))
                                <span class="text-danger">{{ $errors->first('t_description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('t_content') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Giới thiệu tour </label>
                            <div>
                                <textarea name="t_content" id="t_content" cols="30" rows="10" class="form-control" style="height: 225px;">{{ old('t_content', isset($tour) ? $tour->t_content : '') }}</textarea>
                                <script>
                                    ckeditor(t_content);
                                </script>
                                @if ($errors->first('t_content'))
                                <span class="text-danger">{{ $errors->first('t_content') }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Add new service sections -->
                        <div class="form-group {{ $errors->first('t_service_included') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Dịch vụ bao gồm </label>
                            <div>
                                <textarea name="t_service_included" id="t_service_included" cols="30" rows="10" class="form-control" style="height: 225px;">{{ old('t_service_included', isset($tour) ? $tour->t_service_included : '') }}</textarea>
                                <script>
                                    ckeditor(t_service_included);
                                </script>
                                @if ($errors->first('t_service_included'))
                                <span class="text-danger">{{ $errors->first('t_service_included') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('t_notes') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Ghi chú </label>
                            <div>
                                <textarea name="t_notes" id="t_notes" cols="30" rows="10" class="form-control" style="height: 225px;">{{ old('t_notes', isset($tour) ? $tour->t_notes : '') }}</textarea>
                                <script>
                                    ckeditor(t_notes);
                                </script>
                                @if ($errors->first('t_notes'))
                                <span class="text-danger">{{ $errors->first('t_notes') }}</span>
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
                        <h3 class="card-title"> Xuất bản</h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-set">
                            <button type="submit" name="submit" value="{{ isset($tour) ? 'update' : 'create' }}" class="btn btn-info">
                                <i class="fa fa-save"></i> Lưu dữ liệu
                            </button>
                            <button type="reset" name="reset" value="reset" class="btn btn-danger">
                                <i class="fa fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">Lịch khởi hành</h3>
                    </div>
                    <div class="card-body">
                        <div id="departure-dates">
                            @if(isset($tour) && !empty($tour->t_start_date))
                                @php
                                    $dates = json_decode($tour->t_start_date) ?? [];
                                @endphp
                                @foreach($dates as $date)
                                <div class="form-group departure-date-group">
                                    <div class="d-flex">
                                        <input type="date" class="form-control" name="t_start_date[]" value="{{ $date }}" style="flex: 1;">
                                        <button type="button" class="btn btn-danger ml-2 remove-date"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="form-group departure-date-group">
                                    <div class="d-flex">
                                        <input type="date" class="form-control" name="t_start_date[]" style="flex: 1;">
                                        <button type="button" class="btn btn-danger ml-2 remove-date"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-success mt-2" id="add-date">
                            <i class="fa fa-plus"></i> Thêm ngày khởi hành
                        </button>
                        @if ($errors->first('t_start_date'))
                        <span class="text-danger">{{ $errors->first('t_start_date') }}</span>
                        @endif
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh </h3>
                    </div>
                    <div class="card-body" style="min-height: 288px">
                        <div class="form-group">
                            <div class="input-group input-file" name="images">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">Chọn tệp</button>
                                </span>
                                <input type="text" class="form-control" placeholder='Không có tệp nào ...' />
                                <span class="input-group-btn"></span>
                            </div>
                            <span class="text-danger ">
                                <p class="mg-t-5">{{ $errors->first('images') }}</p>
                            </span>
                            @if(isset($tour) && !empty($tour->t_image))
                                {{-- For testing, bypass pare_url_file() to see if the image loads --}}
                                <img src="{{ asset($tour->t_image) }}" alt="" class="margin-auto-div img-rounded" id="image_render" style="height: 150px; width:100%;">
                            @else
                                <img src="{{ asset('admin/dist/img/no-image.png') }}" alt="" class="margin-auto-div img-rounded" id="image_render" style="height: 150px; width:100%;">
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- Album Images upload field -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Album Ảnh</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="t_album_images">Tải nhiều ảnh</label>
                            <input type="file" name="t_album_images[]" multiple class="form-control">
                            @if($errors->first('t_album_images'))
                            <span class="text-danger">
                                <p class="mg-t-5">{{ $errors->first('t_album_images') }}</p>
                            </span>
                            @endif
                            @if(isset($tour) && !empty($tour->t_album_images))
                            <?php $album = json_decode($tour->t_album_images, true); ?>
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

<!-- Add this JavaScript code at the end of your file -->
<script>
document.getElementById('add-date').addEventListener('click', function() {
    const container = document.getElementById('departure-dates');
    const newDateGroup = document.createElement('div');
    newDateGroup.className = 'form-group departure-date-group';
    newDateGroup.innerHTML = `
        <div class="d-flex">
            <input type="date" class="form-control" name="t_start_date[]" style="flex: 1;">
            <button type="button" class="btn btn-danger ml-2 remove-date"><i class="fa fa-times"></i></button>
        </div>
    `;
    container.appendChild(newDateGroup);
});

document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-date')) {
        const dateGroups = document.querySelectorAll('.departure-date-group');
        if (dateGroups.length > 1) {
            e.target.closest('.departure-date-group').remove();
        }
    }
});
</script>