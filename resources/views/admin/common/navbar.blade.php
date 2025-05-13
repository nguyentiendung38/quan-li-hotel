<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            @php
            $user = Auth::user();
            @endphp
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                @if(!empty($user->avatar))
                <img src="{{ asset(pare_url_file($user->avatar)) }}"
                    class="user-image img-circle elevation-2"
                    alt="User Image">
                @else
                <img src="{{ asset('/admin/dist/img/avatar5.png') }}"
                    class="user-image img-circle elevation-2"
                    alt="User Image">
                @endif
                <span class="d-none d-md-inline">{!! $user->name !!}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    @if(!empty($user->avatar))
                    <img src="{{ asset(pare_url_file($user->avatar)) }}"
                        class="img-circle elevation-2"
                        alt="User Image">
                    @else
                    <img src="{{ asset('/admin/dist/img/avatar5.png') }}"
                        class="img-circle elevation-2"
                        alt="User Image">
                    @endif
                    <p>
                        {!! isset($user->name) ? $user->name : '' !!}
                        <small>{!! isset($user->email) ? $user->email : '' !!}</small>
                        <small>{!! isset($user->phone) ? $user->phone : '' !!}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer" style="text-align: center; width: 100%;">
                    <a href="{{ route('admin.logout') }}"
                        class="btn btn-default btn-flat"
                        style="width: 80%; font-size: 14px; padding: 6px 12px;">
                        Đăng xuất
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>