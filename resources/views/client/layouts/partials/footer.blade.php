<footer class="main-footer clearfix">
    <div class="container">
        <!-- Footer info-->
        <div class="footer-info">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer-item newsletter">
                        <div class="main-title-2">
                            <h1>Trọ ơi</h1>
                        </div>
                        <div class="newsletter-inner">
                            <p>
                                Website tìm kiếm phòng trọ hàng đầu Việt Nam.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                    <div class="footer-item">
                        <div class="main-title-2">
                            <h1>Về trang chủ</h1>
                        </div>
                        <ul class="links">
                            <li>
                                <a href="rooms-col-3.html">Trang chủ</a>
                            </li>
                            <li>
                                <a href="rooms-details.html">Giới thiệu</a>
                            </li>
                            <li>
                                <a href="rooms-col-2.html">Tin tức</a>
                            </li>
                            <li>
                                <a href="#">Dich vụ</a>
                            </li>
                            <li>
                                <a href="rooms-col-3.html">Phòng cho thuê</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
                    <div class="footer-item">
                        <div class="main-title-2">
                            <h1>Hỗ trợ khách hàng</h1>
                        </div>
                        <ul class="links">
                            <li>
                                <a href="about.html">Câu hỏi thường gặp</a>
                            </li>
                            <li>
                                <a href="blog-right-sidebar.html">Hướng dẫn đăng tin</a>
                            </li>
                            <li>
                                <a href="booking-system.html">Quy định đăng tin</a>
                            </li>
                            <li>
                                <a href="gallery-3column.html">Giải quyết khiếu nại</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="footer-item">
                        <div class="main-title-2">
                            <h1>Liên hệ</h1>
                        </div>
                        <ul class="personal-info">
                            <li>
                                <i class="fa fa-map-marker"></i>
                                Địa chỉ: {{ $global_setting ? $global_setting->address : '' }}
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                Email: <a
                                    href="mailto:{{ $global_setting ? $global_setting->email : '' }}">{{ $global_setting ? $global_setting->email : '' }}</a>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                Điện thoại hỗ trợ: <a
                                    href="tel:+{{ $global_setting ? $global_setting->support_phone : '' }}">{{ $global_setting ? $global_setting->support_phone : '' }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <p>
                        &copy; 2024
                        <a href="http://themevessel.com/" target="_blank">Trọ ơi</a>.
                        All Rights Reserved.
                    </p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="clearfix pull-right">
                        <div class="blog-share">

                            {{-- <ul class="social-list">
                                {!! $shareComponent !!}
                            </ul> --}}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


