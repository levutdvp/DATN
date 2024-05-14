<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">

            <img src="{{ !auth()->user()->avatar == null ? asset(auth()->user()->avatar) : 'https://worldapheresis.org/wp-content/uploads/2022/04/360_F_339459697_XAFacNQmwnvJRqe1Fe9VOptPWMUxlZP8.jpeg' }}" alt="user-img" title="Mat Helme"
                class="rounded-circle img-thumbnail avatar-md">
            <div class="dropdown">
                <a href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown"
                    aria-expanded="false">{{ auth()->user()->name }}</a>
            </div>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">


            <ul id="side-menu">
                <li class="menu-title">Thống kê</li>
                @if (Auth::user()->can('dashboard'))
                    <li>
                        <a href="{{ route('dashboard-admin') }}">
                            <i class="fe-folder-minus"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->can('report-resource'))
                    <li>
                        <a href="{{ asset('./be/#baocao') }}" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Báo cáo</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="baocao">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{route( 'admin-report-revenue' )}}">- Doanh thu</a>
                                </li>
                                <li>
                                    <a href="{{route( 'admin-report-roompost' )}}">- Tin đăng </a>
                                </li>
                                <li>
                                    <a href="{{route( 'admin-report-post' )}}">- Bài viết </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="menu-title mt-2">Quản lý Phòng</li>
                @if (Auth::user()->can('category-room-post-resource'))
                    <li>
                        <a href="{{ asset('./be/#dmp') }}" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Danh mục phòng </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="dmp">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('category-rooms.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('category-rooms.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('category-rooms-deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if (Auth::user()->can('room-post-resource'))
                    <li>
                        <a href="{{ asset('./be/#tdp') }}" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Tin đăng phòng</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="tdp">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('admin-room-posts.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin-room-posts.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin-room-posts-deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->can('facility-resource'))
                    <li>
                        <a href="{{ asset('./be/#tienich') }}" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Tiện ích</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="tienich">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('facilities.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('facilities.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('facilities-deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="menu-title mt-2">Quản lý bài viết</li>
                @if (Auth::user()->can('category-post-resource'))
                    <li>
                        <a href="{{ asset('./be/#dmbv') }}" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Danh mục bài viết </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="dmbv">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('category-posts.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('category-posts.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('category-posts-deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->can('post-resource'))
                    <li>
                        <a href="{{ asset('./be/#bv') }}" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Bài viết </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="bv">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('posts.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('posts.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('posts-deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->can('tag-resource'))
                    <li>
                        <a href="#tag" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Tag</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="tag">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('tags.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('tags.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('tags-deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                <li class="menu-title mt-2">Quản lý tài khoản</li>
                @if (Auth::user()->can('user-resource'))
                    <li>
                        <a href="{{ asset('./be/#tk') }}" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Tài khoản</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="tk">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('users.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('users.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('users-deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->can('permission-resource'))
                    <li>
                        <a href="#permissions" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Quyền</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="permissions">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('permissions.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('permissions.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('permissions.deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if (Auth::user()->can('role-permission-resource'))
                    <li>
                        <a href="#role-permission" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Vai trò và quyền</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="role-permission">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('roles-permissions.create') }}">- Thêm vai trò và gán quyền</a>
                                </li>
                                <li>
                                    <a href="{{ route('roles-permissions.index') }}">- Danh sách vai trò và quyền
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('roles.deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->can('admin-resource'))
                    <li>
                        <a href="#admin" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Admin</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="admin">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('admins.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('admins.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('admins-deleted') }}">- Thùng rác </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->can('point-resource'))
                    <li class="menu-title mt-2">Quản lý đơn hàng</li>

                    <li>
                        <a href="{{ route('points.index') }}" data-bs-toggle="">
                            <i class="fe-folder-minus"></i>
                            <span>Xác nhận nạp ví</span>
                        </a>

                    </li>
                @endif
                @if (Auth::user()->can('coupon-resource'))
                    <li>
                        <a href="#coupon" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Mã giảm giá</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="coupon">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('coupons.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('coupons.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('coupons-deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->can('service-resource'))
                    <li>
                        <a href="{{ asset('./be/#goidichvu') }}" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Gói dịch vụ</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="goidichvu">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('services.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('services.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('services-deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="menu-title mt-2">Setting</li>
                @if (Auth::user()->can('setting-resource'))
                    <li>
                        <a href="{{ asset('./be/#setting') }}" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Setting</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="setting">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('settings.index') }}">- Danh sách </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->can('banner-resource'))
                    <li>
                        <a href="#banner" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Banner</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="banner">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('banners.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('banners.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('banners-deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::user()->can('advertisement-resource'))
                    <li>
                        <a href="#quangcao" data-bs-toggle="collapse">
                            <i class="fe-folder-minus"></i>
                            <span>Quảng cáo</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="quangcao">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('advertisements.create') }}">- Thêm mới</a>
                                </li>
                                <li>
                                    <a href="{{ route('advertisements.index') }}">- Danh sách </a>
                                </li>
                                <li>
                                    <a href="{{ route('advertisements-deleted') }}">- Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
