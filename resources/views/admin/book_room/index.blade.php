@extends('admin.layouts.main')
@section('title', 'Danh sách đặt phòng')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách đặt phòng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Danh sách đặt phòng</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên khách hàng</th>
                                        <th>Khách sạn</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookRooms as $bookRoom)
                                        <tr>
                                            <td>{{ $bookRoom->id }}</td>
                                            <td>{{ $bookRoom->customer_name }}</td>
                                            <td>{{ $bookRoom->hotel->h_name }}</td>
                                            <td>{{ $bookRoom->booking_date }}</td>
                                            <td>{{ $bookRoom->status }}</td>
                                            <td>
                                                <a href="{{ route('book.room.update.status', ['status' => 1, 'id' => $bookRoom->id]) }}" class="btn btn-success">Duyệt</a>
                                                <a href="{{ route('book.room.update.status', ['status' => 0, 'id' => $bookRoom->id]) }}" class="btn btn-warning">Bỏ duyệt</a>
                                                <a href="{{ route('book.room.delete', $bookRoom->id) }}" class="btn btn-danger">Xóa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $bookRooms->links() }}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@endsection
