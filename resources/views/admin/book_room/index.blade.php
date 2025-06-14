@extends('admin.layouts.main')
@section('title', 'Danh sách đặt phòng')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">
                            <i class="nav-icon fas fa-home"></i> Trang chủ
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Danh sách đặt phòng</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- FORM TÌM KIẾM -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h3 class="card-title">Form tìm kiếm</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('book.room.index') }}" method="GET">
                    <div class="row">
                        <!-- Tìm theo tên khách sạn -->
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <input type="text" name="hotel_name" class="form-control"
                                    value="{{ request()->hotel_name }}"
                                    placeholder="Tên khách sạn...">
                            </div>
                        </div>

                        <!-- Tìm theo tên khách -->
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control"
                                    value="{{ request()->name }}"
                                    placeholder="Tên khách hàng...">
                            </div>
                        </div>

                        <!-- Tìm theo email -->
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <input type="text" name="email" class="form-control"
                                    value="{{ request()->email }}"
                                    placeholder="Email...">
                            </div>
                        </div>

                        <!-- Tìm theo phone -->
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control"
                                    value="{{ request()->phone }}"
                                    placeholder="Số điện thoại...">
                            </div>
                        </div>

                        <!-- Tìm theo trạng thái -->
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <select name="status" class="form-control">
                                    <option value="">-- Trạng thái --</option>
                                    <option value="0" {{ request()->status == '0' ? 'selected' : '' }}>Chưa duyệt</option>
                                    <option value="1" {{ request()->status == '1' ? 'selected' : '' }}>Đã duyệt</option>
                                    <option value="2" {{ request()->status == '2' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                            </div>
                        </div>

                        <!-- Nút submit -->
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-search"></i> Tìm kiếm
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- HIỂN THỊ DANH SÁCH ĐẶT PHÒNG -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách đặt phòng</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="4%" class="text-center">STT</th>
                                    <th>Tên khách sạn</th>
                                    <th>Thông tin khách hàng</th>
                                    <th>Dữ liệu đặt phòng</th>
                                    <th>Hình thức thanh toán</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$bookRooms->isEmpty())
                                @php $i = $bookRooms->firstItem(); @endphp
                                @foreach($bookRooms as $bookRoom)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;">{{ $i }}</td>
                                    <td style="vertical-align: middle; white-space: normal; word-break: break-all; max-width: 150px;">
                                        {{ $bookRoom->hotel->h_name ?? '---' }}
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <p><b>Tên:</b> {{ $bookRoom->name }}</p>
                                        <p><b>Phone:</b> {{ $bookRoom->phone }}</p>
                                        <p><b>Email:</b> {{ $bookRoom->email }}</p>
                                        <p><b>Địa chỉ:</b> {{ $bookRoom->address }}</p>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <p><b>Nhận:</b> {{ $bookRoom->checkin_date }}</p>
                                        <p><b>Trả:</b> {{ $bookRoom->checkout_date }}</p>
                                        <p><b>Số đêm:</b> {{ $bookRoom->nights }}</p>
                                        <p><b>Số phòng:</b> {{ $bookRoom->rooms }}</p>
                                        <p><b>Số người:</b> {{ $bookRoom->guests }}</p>
                                        <p><b>Mã giảm giá:</b> {{ $bookRoom->coupon ?? '---' }}</p>
                                        <p><b>Tổng tiền:</b>
                                            @php
                                            $price = $bookRoom->hotel->h_price;
                                            $sale = $bookRoom->hotel->h_sale;
                                            $priceWithDiscount = $sale > 0 ? $price - ($price * $sale / 100) : $price;
                                            $totalPrice = $bookRoom->nights * $bookRoom->rooms * $priceWithDiscount;
                                            // Apply coupon discount if a coupon exists (fixed 5% discount in this example)
                                            if(!empty($bookRoom->coupon)){
                                            $couponDiscountRate = 0.05;
                                            $totalPrice = $totalPrice - ($totalPrice * $couponDiscountRate);
                                            }
                                            @endphp
                                            {{ number_format($totalPrice, 0, ',', '.') }} VNĐ
                                            @if($sale > 0)
                                            (sale {{ $sale }}%)
                                            @endif
                                            @if($bookRoom->coupon)
                                            - Mã: {{ $bookRoom->coupon }}
                                            @endif
                                        </p>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        @if($bookRoom->payment)
                                        <ul>
                                            @if($bookRoom->payment->p_code_momo)
                                            <li>Phương thức: MOMO</li>
                                            <li>Mã giao dịch MOMO: {{ $bookRoom->payment->p_code_momo }}</li>
                                            @elseif($bookRoom->payment->p_code_vnpay)
                                            <li>Phương thức: VNPay</li>
                                            <li>Ngân hàng: {{ $bookRoom->payment->p_code_bank }}</li>
                                            <li>Mã thanh toán VNPay: {{ $bookRoom->payment->p_code_vnpay }}</li>
                                            @endif
                                            <li>Mã giao dịch: {{ $bookRoom->payment->p_transaction_code }}</li>
                                            <li>Tổng tiền: {{ number_format($bookRoom->payment->p_money, 0, ',', '.') }} VNĐ</li>
                                            <li>Nội dung: {{ $bookRoom->payment->p_note }}</li>
                                            <li>Thời gian: {{ date('Y-m-d H:i', strtotime($bookRoom->payment->p_time)) }}</li>
                                        </ul>
                                        @else
                                        Thanh toán thường
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align: middle;">
                                        <button type="button" class="btn btn-block btn-xs {{ $classStatus[$bookRoom->status] ?? 'btn-default' }}">
                                            @if($bookRoom->payment && ($bookRoom->payment->p_code_momo || $bookRoom->payment->p_code_vnpay))
                                                @if($bookRoom->status == 3)
                                                    Đã hủy
                                                @else
                                                    Đã thanh toán
                                                @endif
                                            @else
                                                {{ $status[$bookRoom->status] ?? 'Chưa duyệt' }}
                                            @endif
                                        </button>
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm">Action</button>
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu action-transaction" role="menu">
                                                <li>
                                                    <a href="{{ route('book.room.delete', $bookRoom->id) }}" class="btn-confirm-delete">
                                                        <i class="fa fa-trash"></i> Delete 
                                                    </a>
                                                </li>
                                                
                                                @if($bookRoom->payment && ($bookRoom->payment->p_code_momo || $bookRoom->payment->p_code_vnpay))
                                                    <li class="update_book_room" url="{{ route('book.room.update.status', ['status' => 3, 'id' => $bookRoom->id]) }}">
                                                        <a><i class="fas fa-ban"></i> Hủy</a>
                                                    </li>
                                                @else
                                                    @php
                                                        $validFlow = [
                                                            0 => [1], // Tiếp nhận -> Đã xác nhận
                                                            1 => [2], // Đã xác nhận -> Đã thanh toán
                                                            2 => [3], // Đã thanh toán -> Đã hủy
                                                            3 => []   // Đã hủy (không có next status)
                                                        ];
                                                        $nextStatuses = $validFlow[$bookRoom->status] ?? [];
                                                    @endphp

                                                    @foreach($status as $key => $item)
                                                        @if(in_array($key, $nextStatuses))
                                                            <li class="update_book_room" url="{{ route('book.room.update.status', ['status' => $key, 'id' => $bookRoom->id]) }}">
                                                                <a><i class="fas fa-check"></i> {{ $item }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @php $i++ @endphp
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="7" class="text-center">Không có dữ liệu</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        @if($bookRooms->hasPages())
                        <div class="pagination float-right mt-3 mr-3">
                            {{ $bookRooms->appends(request()->query())->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Clear search input fields on page load
        $('form[action="{{ route("book.room.index") }}"] input[type="text"]').val('');

        // Handle status update clicks
        $('.update_book_room').on('click', function() {
            var url = $(this).attr('url');
            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert(response.message || 'Đã xảy ra lỗi khi cập nhật trạng thái');
                    }
                },
                error: function() {
                    alert('Đã xảy ra lỗi khi cập nhật trạng thái');
                }
            });
        });
    });
</script>
@endsection