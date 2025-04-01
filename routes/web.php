<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\GroupPermissionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\BookTourController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Page\Auth\LoginController as PageLoginController;
use App\Http\Controllers\Page\Auth\RegisterController as PageRegisterController;
use App\Http\Controllers\Page\Auth\ForgotPasswordController as PageForgotPasswordController;
use App\Http\Controllers\Page\AccountController;
use App\Http\Controllers\Page\HomeController as PageHomeController;
use App\Http\Controllers\Page\ArticleController as PageArticleController;
use App\Http\Controllers\Page\TourController as PageTourController;
use App\Http\Controllers\Page\HotelController as PageHotelController;
use App\Http\Controllers\Page\CommentController as PageCommentController;
use App\Http\Controllers\Admin\BookRoomController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;



Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::get('errors-403', function () {
    return view('errors.403');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::group(['namespace' => 'Auth'], function () {
        Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'postLogin']);
        Route::get('/register', [RegisterController::class, 'getRegister'])->name('admin.register');
        Route::post('/register', [RegisterController::class, 'postRegister']);
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('/forgot/password', [ForgotPasswordController::class, 'forgotPassword'])->name('admin.forgot.password');

        // Thêm route cho reset password
        Route::get('/password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])
            ->name('password.reset');
        // Thêm route thực hiện reset mật khẩu
        Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword'])
            ->name('admin.password.reset.post');
        Route::get('/password/sent', function () {
            return view('admin.auth.password-sent');
        })->name('admin.password.sent');
    });

    Route::get('password/forgot', function () {
        return view('admin.auth.forgot-password');
    })->name('admin.password.request');

    Route::post('password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('admin.password.email');

    Route::post('/password/update', [ForgotPasswordController::class, 'updatePassword'])
        ->name('admin.password.update');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/home', [HomeController::class, 'index'])->name('admin.home')->middleware('permission:truy-cap-he-thong|full-quyen-quan-ly');

        Route::group(['prefix' => 'group-permission'], function () {
            Route::get('/', [GroupPermissionController::class, 'index'])->name('group.permission.index');
            Route::get('/create', [GroupPermissionController::class, 'create'])->name('group.permission.create');
            Route::post('/create', [GroupPermissionController::class, 'store']);
            Route::get('/update/{id}', [GroupPermissionController::class, 'edit'])->name('group.permission.update');
            Route::post('/update/{id}', [GroupPermissionController::class, 'update']);
            Route::get('/delete/{id}', [GroupPermissionController::class, 'destroy'])->name('group.permission.delete');
        });

        Route::group(['prefix' => 'permission'], function () {
            Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
            Route::get('/create', [PermissionController::class, 'create'])->name('permission.create');
            Route::post('/create', [PermissionController::class, 'store']);
            Route::get('/update/{id}', [PermissionController::class, 'edit'])->name('permission.update');
            Route::post('/update/{id}', [PermissionController::class, 'update']);
            Route::get('/delete/{id}', [PermissionController::class, 'delete'])->name('permission.delete');
        });

        Route::group(['prefix' => 'role'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('role.index')->middleware('permission:danh-sach-vai-tro|full-quyen-quan-ly');
            Route::get('/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:them-moi-vai-tro|full-quyen-quan-ly');
            Route::post('/create', [RoleController::class, 'store']);
            Route::get('/update/{id}', [RoleController::class, 'edit'])->name('role.update')->middleware('permission:chinh-sua-vai-tro|full-quyen-quan-ly');
            Route::post('/update/{id}', [RoleController::class, 'update']);
            Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete')->middleware('permission:xoa-vai-tro|full-quyen-quan-ly');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index'])->name('user.index')->middleware('permission:danh-sach-nguoi-dung|full-quyen-quan-ly');
            Route::get('/create', [UserController::class, 'create'])->name('user.create')->middleware('permission:them-moi-nguoi-dung|full-quyen-quan-ly');
            Route::post('/create', [UserController::class, 'store']);
            Route::get('/update/{id}', [UserController::class, 'edit'])->name('user.update')->middleware('permission:chinh-sua-nguoi-dung|full-quyen-quan-ly');
            Route::post('/update/{id}', [UserController::class, 'update']);
            Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete')->middleware('permission:xoa-nguoi-dung|full-quyen-quan-ly');
        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('category.index')->middleware('permission:danh-sach-danh-muc|full-quyen-quan-ly');
            Route::get('/create', [CategoryController::class, 'create'])->name('category.create')->middleware('permission:them-moi-danh-muc|full-quyen-quan-ly');
            Route::post('/create', [CategoryController::class, 'store']);
            Route::get('/update/{id}', [CategoryController::class, 'edit'])->name('category.update')->middleware('permission:chinh-sua-danh-muc|full-quyen-quan-ly');
            Route::post('/update/{id}', [CategoryController::class, 'update']);
            Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete')->middleware('permission:xoa-danh-muc|full-quyen-quan-ly');
        });

        Route::group(['prefix' => 'article'], function () {
            Route::get('/', [ArticleController::class, 'index'])->name('article.index')->middleware('permission:danh-sach-bai-viet|full-quyen-quan-ly');
            Route::get('/create', [ArticleController::class, 'create'])->name('article.create')->middleware('permission:them-moi-bai-viet|full-quyen-quan-ly');
            Route::post('/create', [ArticleController::class, 'store']);
            Route::get('/update/{id}', [ArticleController::class, 'edit'])->name('article.update')->middleware('permission:chinh-sua-bai-viet|full-quyen-quan-ly');
            Route::post('/update/{id}', [ArticleController::class, 'update']);
            Route::get('/delete/{id}', [ArticleController::class, 'delete'])->name('article.delete')->middleware('permission:xoa-bai-viet|full-quyen-quan-ly');
        });

        Route::group(['prefix' => 'location'], function () {
            Route::get('/', [LocationController::class, 'index'])->name('location.index')->middleware('permission:danh-sach-dia-diem|full-quyen-quan-ly');
            Route::get('/create', [LocationController::class, 'create'])->name('location.create')->middleware('permission:them-moi-dia-diem|full-quyen-quan-ly');
            Route::post('/create', [LocationController::class, 'store']);
            Route::get('/update/{id}', [LocationController::class, 'edit'])->name('location.update')->middleware('permission:chinh-sua-dia-diem|full-quyen-quan-ly');
            Route::post('/update/{id}', [LocationController::class, 'update']);
            Route::get('/delete/{id}', [LocationController::class, 'delete'])->name('location.delete')->middleware('permission:xoa-dia-diem|full-quyen-quan-ly');
        });

        Route::group(['prefix' => 'tour'], function () {
            Route::get('/', [TourController::class, 'index'])->name('tour.index')->middleware('permission:danh-sach-tour|full-quyen-quan-ly');
            Route::get('/create', [TourController::class, 'create'])->name('tour.create')->middleware('permission:them-moi-tour|full-quyen-quan-ly');
            Route::post('/create', [TourController::class, 'store']);
            Route::get('/update/{id}', [TourController::class, 'edit'])->name('tour.update')->middleware('permission:chinh-sua-tour|full-quyen-quan-ly');
            Route::post('/update/{id}', [TourController::class, 'update']);
            Route::get('/delete/{id}', [TourController::class, 'delete'])->name('tour.delete')->middleware('permission:xoa-tour|full-quyen-quan-ly');
        });

        Route::group(['prefix' => 'hotel'], function () {
            Route::get('/', [HotelController::class, 'index'])->name('hotel.index')->middleware('permission:danh-sach-khach-san|full-quyen-quan-ly');
            Route::get('/create', [HotelController::class, 'create'])->name('hotel.create')->middleware('permission:them-moi-khach-san|full-quyen-quan-ly');
            Route::post('/create', [HotelController::class, 'store'])->name('hotel.store');
            Route::get('/update/{id}', [HotelController::class, 'edit'])->name('hotel.update')->middleware('permission:chinh-sua-khach-san|full-quyen-quan-ly');
            Route::put('/update/{id}', [HotelController::class, 'update'])->name('hotel.update');
            Route::get('/delete/{id}', [HotelController::class, 'delete'])->name('hotel.delete')->middleware('permission:xoa-khach-san|full-quyen-quan-ly');
        });

        Route::group(['prefix' => 'book-tour'], function () {
            Route::get('/', [BookTourController::class, 'index'])->name('book.tour.index')->middleware('permission:danh-sach-book-tour|full-quyen-quan-ly');
            Route::get('/update/{status}/{id}', [BookTourController::class, 'updateStatus'])->name('book.tour.update.status')->middleware('permission:xoa-va-cap-nhat-trang-thai|full-quyen-quan-ly');
            Route::get('/delete/{id}', [BookTourController::class, 'delete'])->name('book.tour.delete')->middleware('permission:xoa-book-tour|full-quyen-quan-ly');
        });

        Route::group(['prefix' => 'comment'], function () {
            Route::get('/', [CommentController::class, 'index'])->name('comment.index')->middleware('permission:danh-sach-binh-luan|full-quyen-quan-ly');
            Route::get('/update/{status}/{id}', [CommentController::class, 'updateStatus'])->name('comment.update.status');
            Route::get('/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete')->middleware('permission:xoa-binh-luan|full-quyen-quan-ly');
        });

        // Route cho danh sách đặt phòng
        Route::group(['prefix' => 'book-room'], function () {
            Route::get('/', [App\Http\Controllers\Admin\BookRoomController::class, 'index'])->name('book.room.index');
            Route::post('/create', [App\Http\Controllers\Admin\BookRoomController::class, 'store'])->name('post.book.room');
            Route::get('/delete/{id}', [App\Http\Controllers\Admin\BookRoomController::class, 'delete'])->name('book.room.delete');
            Route::get('/update-status/{status}/{id}', [App\Http\Controllers\Admin\BookRoomController::class, 'updateStatus'])->name('book.room.update.status');
            Route::post('/dat-phong/{id}/{slug}', [BookRoomController::class, 'store'])->name('post.book.room');
        });
    });
});

/////////////////////////////////////////////////////////////////////////////////////////////////


Route::group(['namespace' => 'Page'], function () {

    Route::group(['namespace' => 'Auth'], function () {
        Route::get('/dang-nhap.html', [PageLoginController::class, 'login'])->name('page.user.account');
        Route::post('/account/login', [PageLoginController::class, 'postLogin'])->name('account.login');
        Route::get('/dang-ky-tai-khoan.html', [PageRegisterController::class, 'register'])->name('user.register');
        Route::post('/account/register', [PageRegisterController::class, 'postRegister'])->name('post.account.register');
        Route::get('/dang-xuat.html', [PageLoginController::class, 'logout'])->name('page.user.logout');
        Route::get('/quen-mat-khau.html', [PageForgotPasswordController::class, 'forgotPassword'])->name('page.user.forgot.password');
        Route::post('/quen-mat-khau.html', [PageForgotPasswordController::class, 'sendResetLinkEmail'])
            ->name('account.forgot.password.post');
        // đăng nhập bằng google
        Route::get('/auth/google', [\App\Http\Controllers\Page\Auth\GoogleController::class, 'redirectToGoogle'])
            ->name('account.google.login');
        // Add callback route:
        Route::get('/auth/google/callback', [\App\Http\Controllers\Page\Auth\GoogleController::class, 'handleGoogleCallback'])
            ->name('account.google.callback');
    });

    Route::group(['middleware' => ['users']], function () {
        Route::get('thong-tin-tai-khoan.html', [AccountController::class, 'infoAccount'])->name('info.account');
        Route::get('danh-sach-tour.html', [AccountController::class, 'myTour'])->name('my.tour');
        Route::post('/update/info/account/{id}', [AccountController::class, 'updateInfoAccount'])->name('update.info.account');
        Route::get('thay-doi-mat-khau.html', [AccountController::class, 'changePassword'])->name('change.password');
        Route::post('change/password', [AccountController::class, 'postChangePassword'])->name('post.change.password');
        Route::post('cancel/order/tour/{status}/{id}', [AccountController::class, 'updateStatus'])->name('post.cancel.order.tour');
    });

    Route::get('account/forgot-password', [AccountController::class, 'forgotPassword'])
        ->name('account.forgot.password');

    // Add POST route for forgot password
    Route::post('account/forgot-password', [AccountController::class, 'sendResetLinkEmail'])
        ->name('account.forgot.password.post');

    // NEW: Add a route for the page password reset form
    Route::get('password/reset/{token}', [\App\Http\Controllers\Page\Auth\ResetPasswordController::class, 'showResetForm'])
        ->name('page.password.reset');

    // NEW: Route to handle password update from the reset form
    Route::post('password/reset', [\App\Http\Controllers\Page\AccountController::class, 'resetPassword'])
        ->name('account.password.update');

    Route::get('/', [PageHomeController::class, 'index'])->name('page.home');
    Route::get('/loi', [PageTourController::class, 'loi'])->name('loi.loi');
    Route::get('/tin-tuc.html', [PageArticleController::class, 'index'])->name('articles.index');
    Route::get('/tin-tuc/{id}/{slug}.html', [PageArticleController::class, 'detail'])->name('articles.detail');
    Route::get('/ve-chung-toi.html', [PageHomeController::class, 'about'])->name('about.us');
    Route::get('/lien-he.html', [PageHomeController::class, 'contact'])->name('contact.index');
    Route::get('/tour.html', [PageTourController::class, 'index'])->name('tour');
    Route::get('book-tour/{id}/{slug}.html', [PageTourController::class, 'bookTour'])->name('book.tour');
    Route::post('book/tour/{id}', [PageTourController::class, 'postBookTour'])->name('post.book.tour');
    Route::post('book/tourvnpay/{id}', [PageTourController::class, 'postBookTourVNPay'])->name('post.book.tour.vnpay');

    Route::get('/{id}/thanhtoan.html', [PageTourController::class, 'getFromPayMent'])->name('get.from.payment');
    Route::post('/{id}/thanhtoan.html', [PageTourController::class, 'processPayment'])->name('process.payment');
    Route::post('/post/payment', [PageTourController::class, 'createPayMent'])->name('post.payment');
    Route::post('payment/online', [App\Http\Controllers\Page\TourController::class, 'createPayMent'])->name('payment.online');
    Route::get('vnpay/return', [PageTourController::class, 'vnPayReturn'])->name('vnpay.return');
    Route::post('vnpay/create', [App\Http\Controllers\Page\TourController::class, 'createPayMent'])->name('vnpay.create');
    Route::get('/tour/{id}/{slug}.html', [PageTourController::class, 'detail'])->name('tour.detail');
    Route::get('/khach-san.html', [PageHotelController::class, 'index'])->name('hotel');
    Route::get('/khach-san/{id}/{slug?}.html', [PageHotelController::class, 'detail'])->name('hotel.detail');
    Route::post('/comment', [PageCommentController::class, 'comment'])->name('comment');

    Route::group(['prefix' => 'hotel'], function () {
        Route::post('/rate/{id}', [\App\Http\Controllers\Page\HotelController::class, 'rateHotel'])->name('hotel.rate');
    });
    Route::post('tour/{id}/comment', [PageTourController::class, 'comment'])->name('tour.comment');
    Route::post('tour/rate/{id}', [\App\Http\Controllers\Page\TourController::class, 'rate'])->name('tour.rate');
    
    Route::get('/gioi-thieu-chung.html', function () {
        return view('page.info.gioi-thieu-chung');
    })->name('page.info.gioithieuchung');

    Route::get('/tam-nhin-su-menh.html', function () {
        return view('page.info.tam-nhin-su-menh');
    })->name('page.info.tamninhsumenh');

    Route::get('/dinh-huong-phat-trien.html', function () {
        return view('page.info.dinh-huong-phat-trien');
    })->name('page.info.dinhhuongphattrien');

    Route::get('/chinh-sach-bao-mat.html', function () {
        return view('page.info.chinh-sach-bao-mat');
    })->name('page.info.chinhsachbaomat');

    Route::get('/dieu-khoan-su-dung.html', function () {
        return view('page.info.dieu-khoan-su-dung');
    })->name('page.info.dieukhoansu-dung');

    // Route thanh toán khách sạn
    Route::get('/{id}/thanhtoan-khach-san.html', [\App\Http\Controllers\Page\HotelController::class, 'getFromPayment'])
        ->name('get.from.payment.hotel');
    Route::post('/{id}/thanhtoan-khach-san.html', [\App\Http\Controllers\Page\HotelController::class, 'processPayment'])
        ->name('process.payment.hotel');
    Route::post('/post/payment/hotel', [\App\Http\Controllers\Page\HotelController::class, 'createPayMent'])
        ->name('post.payment.hotel');
    Route::get('vnpay/return/hotel', [\App\Http\Controllers\Page\HotelController::class, 'vnpayHotelCallback'])
        ->name('vnpay.return.hotel');
    Route::post('vnpay/create/hotel', [\App\Http\Controllers\Page\HotelController::class, 'createPayMent'])
        ->name('vnpay.create.hotel');
    Route::post('hotel/{id}/payment', [App\Http\Controllers\Page\HotelController::class, 'paymentOnline'])
        ->name('post.payment.online.hotel');
    Route::post('/payment/momo/hotel', [PageHotelController::class, 'createMomoHotelPayment'])->name('payment.momo.hotel');
    Route::get('/payment/momo/callback/hotel', [PageHotelController::class, 'momoHotelCallback'])->name('payment.momo.hotel.callback');

    // Add these new routes
    Route::get('/chinh-sach-khach-san', function () {
        return view('page.policies.hotel-policy');
    })->name('hotel.policy');

    Route::get('/dieu-khoan-su-dung-khach-san', function () {
        return view('page.policies.terms-of-use');
    })->name('hotel.terms');

    // Thêm route cho đặt phòng khách sạn
    Route::post('/hotel/booking', [App\Http\Controllers\Page\HotelController::class, 'booking'])
        ->name('hotel.booking');

    // Sửa lại routes cho đặt phòng khách sạn
    Route::get('/dat-phong/{id}/{slug?}.html', [PageHotelController::class, 'bookingForm'])
        ->name('hotel.booking.form');
    
    Route::post('/dat-phong/process/{id}', [PageHotelController::class, 'processBooking'])
        ->name('hotel.booking.process');
});

// contack email
Route::post('/gui-lien-he', [ContactController::class, 'send'])->name('contact.send');


Route::get('/test-email', function () {
    $details = [
        'title' => 'Test Email',
        'body' => 'This is a test email.'
    ];

    Mail::to('nguyendunghk789@gmail.com')->send(new \App\Mail\TestEmail($details));

    return 'Email sent';
});

// Thêm   ánh giá sao:
Route::get('/danh-gia.html', [\App\Http\Controllers\ReviewController::class, 'index'])->name('review');

// Đường dẫn để hủy đánh giá:
Route::delete('/review/{id}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('review.destroy');

// Add the following route:
Route::post('/tour/booking', [App\Http\Controllers\Page\TourController::class, 'booking'])->name('tour.booking');

// thanh toán mômo:
Route::post('/payment/momo', [\App\Http\Controllers\Page\TourController::class, 'createMomoPayment'])->name('payment.momo');
Route::get('/payment/momo/callback', [\App\Http\Controllers\Page\TourController::class, 'momoCallback'])->name('payment.momo.callback');
