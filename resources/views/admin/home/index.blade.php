@extends('admin.layouts.main')
@section('title', 'Quản lý du lịch')
@section('style-css')
<style>
/* Modern Dashboard Styling */
.content-header {
    padding: 25px 0;
    background: linear-gradient(135deg, #2193b0, #6dd5ed);
    margin-bottom: 30px;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.content-header h1 {
    color: #fff;
    font-weight: 600;
    font-size: 28px;
    margin: 0;
}

.breadcrumb {
    background: rgba(255,255,255,0.2);
    border-radius: 30px;
    padding: 8px 20px;
}

.breadcrumb-item a {
    color: #fff !important;
}

/* Card Styling */
.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    margin-bottom: 30px;
}

.card-header {
    background: #fff;
    border-bottom: 1px solid #f1f1f1;
    padding: 20px;
    border-radius: 15px 15px 0 0 !important;
}

.card-body {
    padding: 25px;
}

/* Info Box Styling */
.info-box {
    border-radius: 15px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.info-box-icon {
    border-radius: 12px;
    width: 70px;
    height: 70px;
    line-height: 70px;
}

.info-box-content {
    padding: 15px 10px;
}

.info-box-text {
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 5px;
}

.info-box-number {
    font-size: 1.5rem;
    font-weight: 600;
}

/* Table Styling */
table {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0,0,0,0.05);
}

table thead th {
    background: #f8f9fa;
    border: none;
    padding: 15px;
    font-weight: 600;
    color: #2d3436;
}

table tbody td {
    padding: 15px;
    border-bottom: 1px solid #f1f1f1;
    vertical-align: middle;
}

/* Filter Section */
.filter-section {
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    margin-bottom: 30px;
}

.form-control {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    padding: 10px 15px;
    height: auto;
}

.form-control:focus {
    border-color: #2193b0;
    box-shadow: 0 0 0 0.2rem rgba(33,147,176,0.25);
}

/* Chart Containers */
.highcharts-figure {
    background: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    margin-bottom: 30px;
}

/* Custom Colors for Info Boxes */
.bg-info {
    background: linear-gradient(135deg, #2193b0, #6dd5ed) !important;
}

.bg-success {
    background: linear-gradient(135deg, #11998e, #38ef7d) !important;
}

.bg-warning {
    background: linear-gradient(135deg, #f2994a, #f2c94c) !important;
}

.bg-danger {
    background: linear-gradient(135deg, #eb3349, #f45c43) !important;
}

/* Button Styling */
.btn-success {
    background: linear-gradient(135deg, #11998e, #38ef7d);
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(17,153,142,0.3);
}

/* Highcharts Customization */
.highcharts-background {
    fill: #ffffff !important;
}

/* Chart Container Styles */
.highcharts-container {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
}

/* Text Colors */
.highcharts-title,
.highcharts-subtitle,
.highcharts-axis-title,
.highcharts-axis-labels text {
    fill: #333333 !important;
}

/* Grid Lines */
.highcharts-grid-line {
    stroke: #e0e0e0;
    stroke-width: 1px;
}

/* Series Colors */
.highcharts-color-0 {
    fill: #2196F3;
    stroke: #2196F3;
}

.highcharts-color-1 {
    fill: #4CAF50;
    stroke: #4CAF50;
}

/* Point Markers */
.highcharts-point {
    fill: #2196F3;
}

/* Tooltip */
.highcharts-tooltip {
    fill: #ffffff;
    stroke: #e0e0e0;
}

/* Legend */
.highcharts-legend-item text {
    fill: #333333 !important;
}

/* Pie Chart Specific */
.highcharts-pie-series .highcharts-point {
    stroke: #ffffff;
    stroke-width: 2px;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .content-header {
        border-radius: 0;
    }
    
    .info-box {
        margin-bottom: 20px;
    }
    
    .card-body {
        padding: 15px;
    }
}
</style>
@stop
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý du lịch</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Trang chủ</a></li>
                        {{-- <li class="breadcrumb-item"><a href="#">Quản lý bán hàng</a></li> --}}
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-th-large"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Tổng số tour</span>
                                    <span class="info-box-number">{{ number_format($tour) }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-th-large"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Tour đã đặt</span>
                                    <span class="info-box-number">{{ number_format($bookTour) }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fa fa-fw fa-user"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Tổng số thành viên</span>
                                    <span class="info-box-number">{{ number_format($user) }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info color-palette"><i class="fas fa-file-word"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tổng số bài viết</span>
                                    <span class="info-box-number">{{ number_format($article) }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info color-palette"><i
                                        class="fas fa-dollar-sign"></i></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu ngày</span>
                                    <span
                                        class="info-box-number">{{ number_format($totalMoneyDay) }}<small>NVD</small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        {{-- <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info color-palette"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu tuần</span>
                                    <span class="info-box-number">{{ number_format($article) }}<small>VND</small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div> --}}
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info color-palette"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu tháng</span>
                                    <span
                                        class="info-box-number">{{ number_format($totalMoneyMonth) }}<small>VND</small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info color-palette"><i class="fas fa-dollar-sign"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Doanh thu năm</span>
                                    <span
                                        class="info-box-number">{{ number_format($totalMoneyYear) }}<small>VND</small></span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-bed"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Phòng đã đặt</span>
                                    <span class="info-box-number">{{ number_format($bookedRooms) }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-building"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tổng số khách sạn</span>
                                    <span class="info-box-number">{{ number_format($totalHotels) }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <h3>Tour nổi bật </h3>

                    <div>
                        @if ($tours->count() > 0)
                            <table style="border-collapse: collapse; width: 100%; height: 68px;" border="1">
                                <tbody>
                                    <tr style="height: 17px;">
                                        <td style="width: 33.3333%; text-align: center; height: 17px;"><strong><em>Mã
                                                    Tour</em></strong></td>
                                        <td style="width: 33.3333%; text-align: center; height: 17px;"><strong><em>Tên
                                                    tour</em></strong></td>
                                        <td style="width: 33.3333%; text-align: center; height: 17px;"><strong><em>Lượt đăng
                                                    ký</em></strong></td>
                                    </tr>
                                    @foreach ($tours as $tour)
                                        <tr style="height: 17px;">
                                            <td style="width: 33.3333%; text-align: center; height: 17px;">
                                                {{ $tour->id }}</td>
                                            <td style="width: 33.3333%; text-align: center; height: 17px;">
                                                {{ $tour->t_title }}</td>
                                            <td style="width: 33.3333%; text-align: center; height: 17px;">
                                                {{ $tour->t_follow }}</td>
                                        </tr>
                                    @endforeach
                    </div>
                    </tbody>
                    </table>
                </div>
                @endif
                <span> .</span>
                <div class="col-sm-8" style="margin-left: 15px">
                    <form action="">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <?php $month = date('m'); ?>
                                <div class="form-group">
                                    <select name="select_month" id="" class="form-control">
                                        <option value="">Chọn tháng</option>
                                        @for ($i = 1; $i < 13; $i++)
                                            @if (Request::get('select_month'))
                                                <option
                                                    {{ Request::get('select_month') == $i ? "selected='selected'" : '' }}
                                                    value="{{ $i }}">{{ $i }}</option>
                                            @else
                                                <option {{ $month == $i ? "selected='selected'" : '' }}
                                                    value="{{ $i }}">{{ $i }}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <?php $year = date('Y'); ?>
                                <div class="form-group">
                                    <select name="select_year" id="" class="form-control">
                                        <option value="">Chọn năm</option>
                                        @for ($i = $year - 15; $i <= $year + 5; $i++)
                                            @if (Request::get('select_year'))
                                                <option
                                                    {{ Request::get('select_year') == $i ? "selected='selected'" : '' }}
                                                    value="{{ $i }}">{{ $i }}</option>
                                            @else
                                                <option {{ $year == $i ? "selected='selected'" : '' }}
                                                    value="{{ $i }}">{{ $i }}</option>
                                            @endif
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-success " style="margin-right: 10px"><i
                                            class="fas fa-search"></i> Lọc dữ liệu </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="row" style="margin-bottom: 15px;">

                    <div class="col-sm-8">
                        <figure class="highcharts-figure">
                            <div id="container2" data-list-day="{{ $listDay }}"
                                data-money-default={{ $arrRevenueTransactionMonthDefault }}
                                data-money={{ $arrRevenueTransactionMonth }}>
                            </div>
                        </figure>
                    </div>
                    <div class="col-sm-4">
                        <figure class="highcharts-figure">
                            <div id="container" data-json="{{ $statusTransaction }}"></div>
                        </figure>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-sm-12">
                        <figure class="highcharts-figure">
                            <div id="container3" data-list-day="{{ $listDay }}" data-money={{ $arrmoney }}>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop

@section('script')
    <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript">
        let dataTransaction = $("#container").attr('data-json');
        dataTransaction = JSON.parse(dataTransaction);

        let listday = $("#container2").attr("data-list-day");
        listday = JSON.parse(listday);

        let listMoneyMonth = $("#container2").attr('data-money');
        listMoneyMonth = JSON.parse(listMoneyMonth);

        let listMoneyMonthDefault = $("#container2").attr('data-money-default');
        listMoneyMonthDefault = JSON.parse(listMoneyMonthDefault);

        let listday2 = $("#container3").attr("data-list-day");
        listday2 = JSON.parse(listday2);

        let listMoneyMonth2 = $("#container3").attr('data-money');
        listMoneyMonth2 = JSON.parse(listMoneyMonth2);

        Highcharts.chart('container', {
            chart: {
                type: 'pie',
                backgroundColor: '#ffffff'
            },
            title: {
                text: 'Trạng thái các tour du lịch',
                style: {
                    color: '#333333',
                    fontSize: '18px'
                }
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr']
            },
            series: [{
                type: 'pie',
                allowPointSelect: true,
                keys: ['name', 'y', 'selected', 'sliced'],
                data: dataTransaction,
                showInLegend: true
            }],
            plotOptions: {
                pie: {
                    colors: ['#2196F3', '#4CAF50', '#FFC107', '#FF5722'],
                    dataLabels: {
                        enabled: true,
                        color: '#333333'
                    }
                }
            }
        });

        Highcharts.chart('container2', {
            chart: {
                type: 'spline',
                backgroundColor: '#ffffff'
            },
            title: {
                text: 'Thống kê lượng khách hàng đặt tour trong tháng'
            },
            subtitle: {
                text: 'Dữ liệu thống kê'
            },
            xAxis: {
                categories: listday
            },
            yAxis: {
                title: {
                    text: 'Số lượng khách hàng'
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    lineWidth: 3,
                    marker: {
                        enabled: true,
                        symbol: 'circle',
                        radius: 6
                    }
                }
            },
            series: [{
                    name: 'Tổng số người lớn',
                    marker: {
                        symbol: 'square'
                    },
                    data: listMoneyMonth
                },
                {
                    name: 'Tổng số trẻ em',
                    marker: {
                        symbol: 'square'
                    },
                    data: listMoneyMonthDefault
                },

            ]
        });
        Highcharts.chart('container3', {
            chart: {
                type: 'spline',
                backgroundColor: '#ffffff'
            },
            title: {
                text: 'Thống kê Doanh thu trong tháng'
            },
            subtitle: {
                text: 'Dữ liệu thống kê'
            },
            xAxis: {
                categories: listday2
            },
            yAxis: {
                title: {
                    text: 'Tiền'
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    lineWidth: 3,
                    marker: {
                        enabled: true,
                        symbol: 'circle',
                        radius: 6
                    }
                }
            },
            series: [{
                    name: 'Doanh thu',
                    marker: {
                        symbol: 'square'
                    },
                    data: listMoneyMonth2
                },

            ]
        });
    </script>
@stop
