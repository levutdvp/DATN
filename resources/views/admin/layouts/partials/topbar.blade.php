<div class="navbar-custom">

    <ul class="list-unstyled topnav-menu float-end mb-0">

        <li class="d-none d-lg-block">
            <form class="app-search">

                <div class="app-search-box">
                    <a href="{{ route('home') }}" style="border-radius:20px;margin:10px;width:200px;" class="btn">Trở về trang người dùng</a>
                    <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h5 class="text-overflow mb-2">Found 22 results</h5>
                        </div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-home me-1"></i>
                            <span>Analytics Report</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-aperture me-1"></i>
                            <span>How can I help you?</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings me-1"></i>
                            <span>User profile settings</span>
                        </a>

                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                        </div>

                        <div class="notification-list">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="d-flex align-items-start">
                                    <img class="d-flex me-2 rounded-circle" src="{{ asset('be/assets/images/users/user-2.jpg') }}" alt="Generic placeholder image" height="32">
                                    <div class="w-100">
                                        <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                        <span class="font-12 mb-0">UI Designer</span>
                                    </div>
                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="d-flex align-items-start">
                                    <img class="d-flex me-2 rounded-circle" src="{{ asset('be/assets/images/users/user-5.jpg') }}" alt="Generic placeholder image" height="32">
                                    <div class="w-100">
                                        <h5 class="m-0 font-14">Jacob Deo</h5>
                                        <span class="font-12 mb-0">Developer</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </form>
        </li>

        <li class="dropdown d-inline-block d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
        </li>

        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id='notification' data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-bell noti-icon"></i>
                <span class="badge bg-danger rounded-circle noti-icon-badge">{{countNotification()}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                <!-- item-->
                <div class="dropdown-item noti-title ">
                    <h5 class="m-0">
                        <span class="float-end">
                            <a href="/notifications" class="text-dark">
                                <small>Đọc tất cả</small>
                            </a>
                        </span>Thông báo
                    </h5>
                </div>

                <div class="noti-scroll" data-simplebar id='notify-content'>

                    <!-- item-->
                    <!-- <a href="javascript:void(0);" class="dropdown-item notify-item active" id="notification">
                                <div class="notify-icon">
                                    <img src="" id='avatar' class="img-fluid rounded-circle" alt="" />
                                </div>
                                <p class="notify-details" id="name_user">jnsancasn</p>
                                <p class="text-muted mb-0 user-msg" id="message-notify">
                                    <small>sajbbjas</small>
                                </p>
                            </a>
                             -->
                    <div id="content-notify">

                    </div>
                </div>

                <!-- All -->
                <div class="dropdown-item text-center text-primary notify-item notify-all">

                <a href="/admin-notification-all" class="dropdown-item text-center text-primary notify-item notify-all">
                                    Xem tất cả
                                </a>
                </div>

            </div>
        </li>

        <li class="dropdown notification-list topbar-dropdown">
            @if (auth()->user())
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ !auth()->user()->avatar == null ? asset(auth()->user()->avatar) : asset('fe/img/logos/no-image-user.jpeg')
 }}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ms-1">

                    {{ auth()->user()->name }}

                </span>
            </a>
            @endif
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Xin chào !</h6>
                </div>

                <!-- item-->
                <a href="{{ route('admin-edit-info', auth()->user()->id) }}" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Cập nhật thông tin</span>
                </a>

                <!-- item-->
                <a href="{{ route('admin-edit-password', auth()->user()->id) }}" class="dropdown-item notify-item">
                    <i class="fe-lock"></i>
                    <span>Đổi mật khẩu</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a class="dropdown-item notify-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fe-log-out"></i>
                    Đăng xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
        </li>

        <li class="dropdown notification-list">
            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                <i class="fe-settings noti-icon"></i>
            </a>
        </li>

    </ul>

    <!-- LOGO -->

    <div class="logo-box">
        <a href="" class="logo logo-light text-center">
            <span class="logo-sm">
                @if ($global_setting->logo && asset($global_setting->logo))
                <img src="{{ asset($global_setting->logo) }}" alt="logo" height="22">
                @else
                <img src="{{ asset('no_image.jpg') }}" alt="logo" height="22">
                @endif
            </span>

            <span class="logo-lg">
                @if ($global_setting->logo && asset($global_setting->logo))
                <img src="{{ asset($global_setting->logo) }}" alt="logo" height="85">
                @else
                <img src="{{ asset('no_image.jpg') }}" alt="logo" height="85">
                @endif
            </span>
        </a>

        <a href="" class="logo logo-dark text-center">
            <span class="logo-sm">
                @if ($global_setting->logo && asset($global_setting->logo))
                <img src="{{ asset($global_setting->logo) }}" alt="logo" height="22">
                @else
                <img src="{{ asset('no_image.jpg') }}" alt="logo" height="22">
                @endif
            </span>
            <span class="logo-lg">
                @if ($global_setting->logo && asset($global_setting->logo))
                <img src="{{ asset($global_setting->logo) }}" alt="logo" height="85">
                @else
                <img src="{{ asset('no_image.jpg') }}" alt="logo" height="85">
                @endif
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li>
            <h4 class="page-title-main"></h4>
        </li>

    </ul>

    <div class="clearfix"></div>
    <input type="hidden" value="{{auth()->user()->id}} " id="user_id">
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#notification').on('click', function() {
            let id = $('#user_id').val();
            $.ajax({
                url: '{{ route('notificatons.index')}}', // Sử dụng id thay vì 'id'
                method: 'GET',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Create an empty string to store the HTML for notifications
                    let notificationsHTML = '';
                    response.forEach(function(data) {
                        // console.log(data);
                        // Generate HTML for each notification
                        let notificationHTML =
                            ` <a href="/notifications/${data.id}/edit" class="dropdown-item notify-item " id="read-notification" data-id="${data.id}" style="background-color:${data.read_at === null ? '#EEEEEE' : ''}">
                                <div class="notify-icon">
                                    <img src="${data.avata ? data.avata : "{{asset('fe/img/logos/no-image-user.jpeg')}}"}" id='avatar' class="img-fluid rounded-circle" alt="" />
                                </div>
                                <div class="d-flex justify-content-between ">
                                <p class="notify-details " id="name_user" style="margin:0px;">${data.name} </p>
                                <small class="text-muted">${data.created_at_about}</small>
                                </div>
                                <p class="text-muted mb-0 user-msg" id="message-notify">
                                    <small>${data.message}</small>
                                </p>
                                </a>
                        `
                        // Append the generated HTML to the notificationsHTML
                        notificationsHTML += notificationHTML;

                        // document.querySelector('#notify-content').innerHTML = notificationsHTML;
                    });
                    // console.log(notificationsHTML);
                    // Append the new notificationsHTML to the .noti-scroll element
                    document.querySelector('#content-notify').innerHTML = notificationsHTML;

                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    });

</script>
@endpush
