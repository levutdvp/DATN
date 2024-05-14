<?php


use App\Http\Controllers\Admin\CategoryPostController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Client\PostController as ClientPost;

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryRoomController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\ChangeInfoController;
use App\Http\Controllers\Admin\SurroundingController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\RoomPostController as CLientRoomPost;
use App\Http\Controllers\Admin\RoomPostController as AdminRoomPost;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Client\ServicesController as ClientServices;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportRevenueController;
use App\Http\Controllers\Admin\ReportRoomPostControler;
use App\Http\Controllers\Client\PaymentVNPayController;
use App\Http\Controllers\Client\TransactionController;
use App\Http\Controllers\HomeController as ControllersHomeController;
use App\Http\Controllers\Client\NotificationController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Admin\ReportPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

//CLIENT

Route::get('home-client', function () {
    return view('client.layouts.master');
})->name('home-client');

//Trang chủ
Route::get('trang-chu', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('dashboard-client', function () {
    return view('client.layouts.home'); // Trang chủ
});

//Đăng nhập, đăng ký
Route::get('client-signup', function () {
    return view('client.auth.register');
});
Route::get('client-login', function () {
    return view('client.auth.login');
});

//Google Authen
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

//Facebook login
Route::get('auth/facebook', [LoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

//Thay đổi mật khẩu,thông tin
Route::resource('changeinfo', ChangeInfoController::class);
Route::resource('changepassword', ChangePasswordController::class);
Route::get('fogotpassword', function () {
    return view('client.auth.fogotPassword');
});

//Bài viết
Route::resource('posts-client', ClientPost::class); // Danh sách bài viết
Route::get('tin-tuc/{slug}', [ClientPost::class, 'postDetail'])->name('posts-detail');

//Lọc và Tìm kiếm
// Route::post('fillter', [HomeController::class, 'filter_list']);
Route::get('search', [HomeController::class, 'index'])->name('search');
Route::match(['get', 'post'], 'search-filter', [HomeController::class, 'filter_list'])->name('search-filter');
// Route::match(['get', 'post'], 'search-fillter', [HomeController::class, 'filter_list_room_post_detail'])->name('search-fillter');
Route::get('tin-dang/{slug}', [HomeController::class, 'roomPostDetail'])->name('room-post-detail');

Route::get('/tags/posts/{slug}', [TagController::class, 'searchTagPost'])->name('tags-show');

Route::get('bookmarks', [HomeController::class, 'listBookmark'])->name('list-bookmark');
Route::get('bookmark', [HomeController::class, 'bookmark'])->name('bookmark');
Route::delete('/unbookmark/{room_post_id}', [HomeController::class, 'unBookmark'])->name('unbookmark');
Route::delete('unbookmarkbm/{id}', [HomeController::class, 'unBookmarkbm'])->name('unbookmarkbm');


// Thanh toán VNpay
Route::post('vnpay-payment', [PaymentVNPayController::class, 'payment_vnpay'])->name('vnpay-payment');
Route::get('vnpay-return', [PaymentVNPayController::class, 'return_vnpay'])->name('vnpay-return');


//thong bao
Route::get('notification-all', function () {
    return view('client.notification.index');
})->name('notification-all');
Route::resource('notifications', NotificationController::class);
//Phân quyền start
Route::group(['middleware' => 'checkRole:vendor'], function () {
    // route dành cho vendor ở đây

    //Dịch vụ client
    Route::resource('services-room-posts', ClientServices::class);

    // Thanh toán
    Route::get('display-QR', function () {
        return view('client.pay.display-QR');
    });
    Route::get('notification-pay', function () {
        return view('client.payment-status.notification-pay');
    })->name('notification-pay');

    Route::get('notification-fail', function () {
        return view('client.payment-status.notification-fail');
    })->name('notification-fail');

    // Thanh toán Online
    Route::post('points', [TransactionController::class, 'store'])->name('points.store');
    Route::get('points-history', [TransactionController::class, 'history'])->name('points.history');


    // Room-Post-Client
    Route::resource('room-posts', CLientRoomPost::class);
    Route::get('room-posts-deleted', [CLientRoomPost::class, 'deleted'])->name('room-posts-deleted');
    Route::delete('room-posts-permanently/{id}', [CLientRoomPost::class, 'permanentlyDelete'])->name('room-posts-permanently-delete');
    Route::get('room-posts-restore/{id}', [CLientRoomPost::class, 'restore'])->name('room-posts-restore');
    Route::post('create-room-posts-image', [CLientRoomPost::class, 'createImage'])->name('create-room-post-image');
    Route::post('update-room-posts-image', [CLientRoomPost::class, 'editMultiImage'])->name('update-room-posts-image');
    Route::get('delete-room-posts-image/{id}', [CLientRoomPost::class, 'deleteMultiImage'])->name('delete-room-posts-image');
    // BookMark


    // Mã giảm giá
    Route::post('apply-discount', [TransactionController::class, 'applyDiscount'])->name('apply-discount');
});
Route::group(['middleware' => 'checkRole:admin'], function () {
    // Route dành cho admin ở đây

    // ADMIN
    Route::get('home-admin', function () {
        return view('admin.layouts.home-admin');
    })->name('home-admin');

    Route::get('admin-notification-all', function () {
        return view('admin.notification.index');
    })->name('admin-notification-all');
    Route::get('dashboard-admin', [DashboardController::class, 'index'])->name('dashboard-admin');

    //Báo cáo doanh thu
    Route::get('/admin-report-revenue', [ReportRevenueController::class, 'index'])->name('admin-report-revenue');
    Route::post('/admin-report-revenue', [ReportRevenueController::class, 'fillterRevenue'])->name('admin-report-revenue');
    Route::get('/admin-export-revenue', [ReportRevenueController::class, 'exportRevenue'])->name('admin-export-revenue');

    //báo cáo tin đăng
    Route::get('/admin-report-roompost', [ReportRoomPostControler::class, 'index'])->name('admin-report-roompost');
    Route::post('/admin-report-roompost', [ReportRoomPostControler::class, 'fillterRoompost'])->name('admin-report-roompost');
    Route::get('/admin-export-roompost', [ReportRoomPostControler::class, 'exportRoomPost'])->name('admin-export-roompost');


    //báo cáo bài viết
    Route::get('/admin-report-post', [ReportPostController::class, 'index'])->name('admin-report-post');
    Route::post('/admin-report-post', [ReportPostController::class, 'fillterPost'])->name('admin-report-post');

    // Room-Post-Admin
    Route::resource('admin-room-posts', AdminRoomPost::class);
    Route::get('admin-room-posts-deleted', [AdminRoomPost::class, 'deleted'])->name('admin-room-posts-deleted');
    Route::delete('admin-room-posts-permanently/{id}', [AdminRoomPost::class, 'permanentlyDelete'])->name('admin-room-posts-permanently-delete');
    Route::get('admin-room-posts-restore/{id}', [AdminRoomPost::class, 'restore'])->name('admin-room-posts-restore');
    Route::post('admin-create-room-posts-image', [CLientRoomPost::class, 'createImage'])->name('admin-create-room-post-image');
    Route::post('admin-update-room-posts-image', [CLientRoomPost::class, 'editMultiImage'])->name('admin-update-room-posts-image');
    Route::get('admin-delete-room-posts-image/{id}', [CLientRoomPost::class, 'deleteMultiImage'])->name('admin-delete-room-posts-image');
    Route::get('admin-room-posts-status', [AdminRoomPost::class, 'changeStatus'])->name('admin-room-posts-status');

    // Category Home
    Route::resource('category-rooms', CategoryRoomController::class);
    Route::get('category-rooms-deleted', [CategoryRoomController::class, 'deleted'])->name('category-rooms-deleted');
    Route::delete('category-rooms-permanently/{id}', [CategoryRoomController::class, 'permanentlyDelete'])->name('category-rooms-permanently-delete');
    Route::get('category-rooms-restore/{id}', [CategoryRoomController::class, 'restore'])->name('category-rooms-restore');
    Route::get('category-rooms-status', [CategoryRoomController::class, 'changeStatus'])->name('category-rooms-status-change');

    // Facility
    Route::resource('facilities', FacilityController::class);
    Route::get('facilities-deleted', [FacilityController::class, 'listDeleted'])->name('facilities-deleted');
    Route::delete('facilities-permanently/{id}', [FacilityController::class, 'permanentlyDelete'])->name('facilities-permanently-delete');
    Route::get('facilities-restore/{id}', [FacilityController::class, 'restore'])->name('facilities-restore');


    // Setting
    Route::resource('settings', SettingController::class);

    // Banner
    Route::resource('banners', BannerController::class);
    Route::get('banners-deleted', [BannerController::class, 'deleted'])->name('banners-deleted');
    Route::delete('banners-permanently/{id}', [BannerController::class, 'permanentlyDelete'])->name('banners-permanently-delete');
    Route::get('banners-restore/{id}', [BannerController::class, 'restore'])->name('banners-restore');
    Route::get('banners-status', [BannerController::class, 'changeStatus'])->name('banners-status-change');


    // Advertisement (ảnh quảng cáo)
    Route::resource('advertisements', AdvertisementController::class);
    Route::get('advertisements-deleted', [AdvertisementController::class, 'deleted'])->name('advertisements-deleted');
    Route::delete('advertisements-permanently/{id}', [AdvertisementController::class, 'permanentlyDelete'])->name('advertisements-permanently-delete');
    Route::get('advertisements-restore/{id}', [AdvertisementController::class, 'restore'])->name('advertisements-restore');
    Route::get('/advertisements-status', [AdvertisementController::class, 'changeStatus'])->name('advertisements-status-change');


    //Post
    Route::resource('posts', PostController::class);
    Route::get('posts-deleted', [PostController::class, 'deleted'])->name('posts-deleted');
    Route::delete('posts-permanently/{id}', [PostController::class, 'permanentlyDelete'])->name('posts-permanently-delete');
    Route::get('posts-restore/{id}', [PostController::class, 'restore'])->name('posts-restore');
    Route::get('posts-status', [PostController::class, 'changeStatus'])->name('posts-status-change');

    // Category Post
    Route::resource('category-posts', CategoryPostController::class);
    Route::get('category-posts-deleted', [CategoryPostController::class, 'deleted'])->name('category-posts-deleted');
    Route::delete('category-posts-permanently/{id}', [CategoryPostController::class, 'permanentlyDelete'])->name('category-posts-permanently-delete');
    Route::get('category-posts-restore/{id}', [CategoryPostController::class, 'restore'])->name('category-posts-restore');
    Route::get('category-posts-status', [CategoryPostController::class, 'changeStatus'])->name('category-posts-status-change');

    // Tag
    Route::resource('tags', TagController::class);
    Route::get('tags-deleted', [TagController::class, 'deleted'])->name('tags-deleted');
    Route::delete('tags-permanently/{id}', [TagController::class, 'permanentlyDelete'])->name('tags-permanently-delete');
    Route::get('tags-restore/{id}', [TagController::class, 'restore'])->name('tags-restore');
    Route::get('tags-status', [TagController::class, 'changeStatus'])->name('tags-status-change');

    // Dịch vụ
    Route::resource('services', ServicesController::class);
    Route::get('services-deleted', [ServicesController::class, 'deleted'])->name('services-deleted');
    Route::delete('services-permanently/{id}', [ServicesController::class, 'permanentlyDelete'])->name('services-permanently-delete');
    Route::get('services-restore/{id}', [ServicesController::class, 'restore'])->name('services-restore');

    // Mã giảm giá
    Route::resource('coupons', CouponController::class);
    Route::get('coupons-deleted', [CouponController::class, 'deleted'])->name('coupons-deleted');
    Route::delete('coupons-permanently/{id}', [CouponController::class, 'permanentlyDelete'])->name('coupons-permanently-delete');
    Route::get('coupons-restore/{id}', [CouponController::class, 'restore'])->name('coupons-restore');
    Route::get('coupons-status', [CouponController::class, 'changeStatus'])->name('coupons-status-change');


    //Quản lý người dùng
    Route::resource('users', UserController::class);
    Route::get('users-deleted', [UserController::class, 'deleted'])->name('users-deleted');
    Route::delete('users-permanently/{id}', [UserController::class, 'permanentlyDelete'])->name('users-permanently-delete');
    Route::get('users-restore/{id}', [UserController::class, 'restore'])->name('users-restore');


    // Facility
    Route::resource('surroundings', SurroundingController::class);
    Route::get('surroundings-deleted', [SurroundingController::class, 'listDeleted'])->name('surroundings-deleted');
    Route::delete('surroundings-permanently/{id}', [SurroundingController::class, 'permanentlyDelete'])->name('surroundings-permanently-delete');
    Route::get('surroundings-restore/{id}', [SurroundingController::class, 'restore'])->name('surroundings-restore');

    //Admin/chang info
    Route::get('admin-change-info/{id}', [ChangeInfoController::class, 'adminEdit'])->name('admin-edit-info');
    Route::put('admin-change-info/{id}', [ChangeInfoController::class, 'adminUpdate'])->name('admin-change-info');

    //Admin/chang password
    Route::get('admin-change-password/{id}', [ChangePasswordController::class, 'adminEditPassword'])->name('admin-edit-password');
    Route::put('admin-change-password/{id}', [ChangePasswordController::class, 'adminUpdatePassword'])->name('admin-change-password');

    // Quyền
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions-deleted', [PermissionController::class, 'deleted'])->name('permissions.deleted');
    Route::delete('permissions/permanently/{id}', [PermissionController::class, 'permanentlyDelete'])->name('permissions.permanently.delete');
    Route::get('permissions/restore/{id}', [PermissionController::class, 'restore'])->name('permissions.restore');

    Route::get('permissions-import', [PermissionController::class, 'importPermission'])->name('permissions-import');
    Route::get('permissions-export', [PermissionController::class, 'Export'])->name('permissions-export');
    Route::post('permissions-import', [PermissionController::class, 'Import'])->name('import');

    // vai trò
    Route::resource('roles', RoleController::class);
    Route::get('roles-deleted', [RoleController::class, 'deleted'])->name('roles.deleted');
    Route::delete('roles/permanently/{id}', [RoleController::class, 'permanentlyDelete'])->name('roles.permanently.delete');
    Route::get('roles/restore/{id}', [RoleController::class, 'restore'])->name('roles.restore');

    // Vai trò và quyền
    Route::resource('roles-permissions', RolePermissionController::class);

    // Quản lí admin
    Route::resource('admins', AdminController::class);
    Route::get('admins-deleted', [AdminController::class, 'deleted'])->name('admins-deleted');
    Route::delete('admins-permanently/{id}', [AdminController::class, 'permanentlyDelete'])->name('admins-permanently-delete');

    //Quản lí points
    Route::get('points', [TransactionController::class, 'index'])->name('points.index');
    Route::put('/update-status/{id}', [TransactionController::class, 'updateStatus'])->name('updatePoint.status');
});
