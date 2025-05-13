<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.home')}}" class="brand-link d-flex align-items-center justify-content-center"
        style="border-bottom: 1px solid rgba(255,255,255,0.1); padding: 15px;">
        <img src="{!! asset('admin/dist/img/logo-hotel.png') !!}"
            alt="AdminLTE Logo"
            class="brand-image elevation-3"
            style="opacity: .9; border-radius: 10px; width: 35px; height: 35px; object-fit: cover;">
        <span class="brand-text font-weight-bold ml-2"
            style="font-size: 1.3rem; letter-spacing: 0.5px;">Du Lịch Huế</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User Panel -->
        @php
        $user = Auth::user();
        @endphp
        <div class="user-panel mt-4 pb-4 mb-4 d-flex align-items-center"
            style="border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div class="image">
                @if(!empty($user->avatar))
                <img src="{{ asset(pare_url_file($user->avatar)) }}"
                    class="img-circle elevation-2"
                    style="width: 45px; height: 45px; object-fit: cover; border: 2px solid rgba(255,255,255,0.2);"
                    alt="User Image">
                @else
                <img src="{{ asset('/admin/dist/img/avatar5.png') }}"
                    class="img-circle elevation-2"
                    style="width: 45px; height: 45px; object-fit: cover; border: 2px solid rgba(255,255,255,0.2);"
                    alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block"
                    style="font-size: 1rem; font-weight: 500; color: rgba(255,255,255,0.9);">
                    {!! $user->name !!}
                </a>
                <span style="font-size: 0.8rem; color: rgba(255,255,255,0.6);">Administrator</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
                style="padding: 0 0.5rem;">

                <!-- Menu Items -->
                @if(Auth::user()->can(['full-quyen-quan-ly', 'truy-cap-he-thong']))
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.home') }}"
                        class="nav-link {{ isset($home_active) ? $home_active : '' }}"
                        style="border-radius: 8px; transition: all 0.3s;">
                        <i class="nav-icon fas fa-home"
                            style="font-size: 1.1rem; width: 28px;"></i>
                        <p style="font-size: 0.95rem;">Màn Hình Chính</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can(['full-quyen-quan-ly', 'danh-sach-danh-muc']))
                <li class="nav-item mb-1">
                    <a href="{{ route('category.index') }}"
                        class="nav-link {{ isset($category_active) ? $category_active : '' }}"
                        style="border-radius: 8px; transition: all 0.3s;">
                        <i class="nav-icon fa fa-list"
                            style="font-size: 1.1rem; width: 28px;"></i>
                        <p style="font-size: 0.95rem;">Danh mục</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can(['full-quyen-quan-ly', 'danh-sach-bai-viet']))
                <li class="nav-item mb-1">
                    <a href="{{ route('article.index') }}"
                        class="nav-link {{ isset($article_active) ? $article_active : '' }}"
                        style="border-radius: 8px; transition: all 0.3s;">
                        <i class="nav-icon far fa-newspaper"
                            style="font-size: 1.1rem; width: 28px;" aria-hidden="true"></i>
                        <p style="font-size: 0.95rem;">Bài viết</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can(['full-quyen-quan-ly', 'danh-sach-dia-diem']))
                <li class="nav-item mb-1">
                    <a href="{{ route('location.index') }}"
                        class="nav-link {{ isset($location_active) ? $location_active : '' }}"
                        style="border-radius: 8px; transition: all 0.3s;">
                        <i class="nav-icon fas fa-map-marker-alt"
                            style="font-size: 1.1rem; width: 28px;" aria-hidden="true"></i>
                        <p style="font-size: 0.95rem;">Địa điểm</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can(['full-quyen-quan-ly', 'danh-sach-tour']))
                <li class="nav-item mb-1">
                    <a href="{{ route('tour.index') }}"
                        class="nav-link {{ isset($tour_active) ? $tour_active : '' }}"
                        style="border-radius: 8px; transition: all 0.3s;">
                        <i class="nav-icon fas fa-th-large"
                            style="font-size: 1.1rem; width: 28px;" aria-hidden="true"></i>
                        <p style="font-size: 0.95rem;">Tours</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can(['full-quyen-quan-ly', 'danh-sach-khach-san']))
                <li class="nav-item mb-1">
                    <a href="{{ route('hotel.index') }}"
                        class="nav-link {{ isset($hotel_active) ? $hotel_active : '' }}"
                        style="border-radius: 8px; transition: all 0.3s;">
                        <i class="nav-icon fas fa-bed"
                            style="font-size: 1.1rem; width: 28px;" aria-hidden="true"></i>
                        <p style="font-size: 0.95rem;">Khách sạn</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can(['full-quyen-quan-ly', 'quan-ly-dat-tour']))
                <li class="nav-item mb-1">
                    <a href="{{ route('book.tour.index') }}"
                        class="nav-link {{ isset($book_tour_active) ? $book_tour_active : '' }}"
                        style="border-radius: 8px; transition: all 0.3s;">
                        <i class="nav-icon fas fa-cart-plus"
                            style="font-size: 1.1rem; width: 28px;" aria-hidden="true"></i>
                        <p style="font-size: 0.95rem;">Danh sách đặt tour</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can(['full-quyen-quan-ly', 'quan-ly-dat-phong']))
                <li class="nav-item mb-1">
                    <a href="{{ route('book.room.index') }}"
                        class="nav-link {{ isset($book_room_active) ? $book_room_active : '' }}"
                        style="border-radius: 8px; transition: all 0.3s;">
                        <i class="nav-icon fas fa-bed"
                            style="font-size: 1.1rem; width: 28px;" aria-hidden="true"></i>
                        <p style="font-size: 0.95rem;">Danh sách đặt phòng</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can(['full-quyen-quan-ly', 'quan-ly-binh-luan']))
                <li class="nav-item mb-1">
                    <a href="{{ route('comment.index') }}"
                        class="nav-link {{ isset($comment_active) ? $comment_active : '' }}"
                        style="border-radius: 8px; transition: all 0.3s;">
                        <i class="nav-icon fas fa-comments"
                            style="font-size: 1.1rem; width: 28px;" aria-hidden="true"></i>
                        <p style="font-size: 0.95rem;">Quản lý bình luận</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can(['full-quyen-quan-ly', 'danh-sach-vai-tro']))
                <li class="nav-item mb-1">
                    <a href="{{ route('role.index') }}"
                        class="nav-link {{ isset($role_active) ? $role_active : '' }}"
                        style="border-radius: 8px; transition: all 0.3s;">
                        <i class="nav-icon fa fa-gavel"
                            style="font-size: 1.1rem; width: 28px;" aria-hidden="true"></i>
                        <p style="font-size: 0.95rem;">Phân Quyền</p>
                    </a>
                </li>
                @endif
                @if(Auth::user()->can(['full-quyen-quan-ly', 'danh-sach-nguoi-dung']))
                <li class="nav-item mb-1">
                    <a href="{{ route('user.index') }}"
                        class="nav-link {{ isset($user_active) ? $user_active : '' }}"
                        style="border-radius: 8px; transition: all 0.3s;">
                        <i class="nav-icon fa fa-fw fa-user"
                            style="font-size: 1.1rem; width: 28px;" aria-hidden="true"></i>
                        <p style="font-size: 0.95rem;">Người dùng</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>

    <style>
        .main-sidebar {
            background: linear-gradient(180deg, #2C3E50 0%, #1A252F 100%);
        }

        .nav-sidebar .nav-item .nav-link {
            padding: 0.8rem 1rem;
        }

        .nav-sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-sidebar .nav-link.active {
            background: linear-gradient(90deg, #3498DB, #2980B9);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .nav-sidebar .nav-link.active i {
            color: white;
        }

        .nav-sidebar .nav-link p {
            margin-left: 10px;
            font-weight: 500;
        }

        .nav-sidebar .nav-icon {
            transition: all 0.3s;
        }

        .nav-sidebar .nav-link:hover .nav-icon {
            transform: scale(1.1);
        }
    </style>
</aside>