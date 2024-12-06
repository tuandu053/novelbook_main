<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['checkUserStatus'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/Gioi-thieu', function () {
        return view('Gioi_thieu');
    });

    Route::get('/Lien-he', function () {
        return view('Lien_he');
    });

    Route::get('/Huong-dan', function () {
        return view('Huong_dan');
    });
    
    Auth::routes([
        'verify' => true
    ]);
    
    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->middleware('auth')->name('verification.notice');
    
    // Route::post('/them-the-loai',[TestController::class,'themtheloai']);
    
    Route::post('/them-the-loai',[CategoriesController::class,'store'])->name('Categories.store');
    Route::get('/danh-sach-the-loai',[CategoriesController::class,'index'])->name('Categories.index');
    Route::post('/sua-the-loai/{id}',[CategoriesController::class,'update'])->name('Categories.update');
    Route::get('/chi-tiet-the-loai/{id}',[CategoriesController::class,'show'])->name('Categories.show');
    
    
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');
    // Route::resource('/Categories', CategoriesController::class);
    // Route::resource('/User', UserController::class);
    Route::resource('/Novel', NovelController::class);
    Route::resource('/Chapter', ChapterController::class);
    Route::resource('/Bookmark', BookmarksController::class);
    // Route::resource('/Author', AuthorController::class);
    
    Route::get('/Xoa-danh-dau/{id}',[BookmarksController::class,'bookmark_remove'])->name('Bookmark.bookmark_remove');
    
    Route::get('/Chi-tiet-chuong-tacgia/{id}',[ChapterController::class,'page_chitiet_chuong_author'])->name('Chapter.page_chitiet_chuong_author');
    Route::get('/Chi-tiet-chuong-kiemduyet/{id}',[ChapterController::class,'admin_kiemquyet_chuong'])->name('Chapter.admin_kiemquyet_chuong');
    Route::post('/Ketqua-kiem-duyet-chuong-truyen',[ChapterController::class,'kiem_duyet_chuong'])->name('Chapter.kiem_duyet_chuong');
    Route::get('/Xoa-lich-su-doc/{id}',[ChapterController::class,'xoa_lichsu_doc'])->name('Chapter.xoa_lichsu_doc');
    Route::get('/Mua-chuong/{id}',[ChapterController::class,'mua_chuong'])->name('Chapter.mua_chuong');
    
    Route::post('/Danh-sachtruyen-tacgia',[NovelController::class,'Danh_sachtruyen_tacgia'])->name('Novel.Danh_sachtruyen_tacgia');
    Route::get('/Quan-ly-truyen/{id}',[NovelController::class,'quan_ly_truyen'])->name('Novel.quan_ly_truyen');
    Route::get('/Danh_sach_truyen',[NovelController::class,'danhsach_xetduyet'])->name('Novel.danhsach_xetduyet');
    Route::post('/Xet-duyet-ban-quyen-truyen/{id}',[NovelController::class,'xetduyet'])->name('Novel.xetduyet');
    Route::get('/Chi-tiet-truyen/{id}',[NovelController::class,'chi_tiet_truyen'])->name('Novel.chi_tiet_truyen');
    Route::get('/Kiem-duyet-chuong-truyen/{id}',[NovelController::class,'page_kiem_duyet_chuong'])->name('Novel.page_kiem_duyet_chuong');
    Route::post('/Tim-kiem',[NovelController::class,'page_tim_kiem'])->name('Novel.page_tim_kiem');
    Route::get('/Truyen-chua-xet-duyet',[NovelController::class,'danhsach_truyencochuongchuaduocxetduyet'])->name('Novel.danhsach_truyencochuongchuaduocxetduyet');
    
    
    Route::post('/them-thong-tin-tac-gia',[AuthorController::class,'store'])->name('Author.store');
    Route::get('/xem-thong-tin-tac-gia/{id}',[AuthorController::class,'show'])->name('Author.show');
    Route::post('/cap-nhat-thong-tin-tac-gia/{id}',[AuthorController::class,'update'])->name('Author.update');
    Route::post('/xet-duyet-tac-gia/{id}',[AuthorController::class,'xetduyet'])->name('Author.xetduyet');
    Route::post('/chi-tiet-tac-gia/{id}',[AuthorController::class,'edit'])->name('Author.edit');
    Route::get('/danh-sach-xet-duyet-tac-gia',[AuthorController::class,'danhsach_xetduyet'])->name('Author.danhsach_xetduyet');
    Route::post('/Bao-cao-thong-ke-tacgia', [AuthorController::class, 'baocao_thongke'])->name('Author.baocao_thongke');
    Route::post('/Tim-kiem-tac-gia/{nickname}', [AuthorController::class, 'Tim_kiem_tacgia'])->name('Author.Tim_kiem_tacgia');
    Route::post('/Rut-tien', [AuthorController::class, 'Author_withdraw'])->name('Author.Author_withdraw');
    Route::post('/Huy-rut-tien/{id}', [AuthorController::class, 'author_withdraw_cancel'])->name('Author.author_withdraw_cancel');
    
    Route::get('/User/{id}/admin', [UserController::class, 'admin'])->name('User.admin');
    Route::post('/User-update/{id}', [UserController::class, 'update'])->name('User.update');
    Route::get('/User/{id}/show', [UserController::class, 'show'])->name('User.show');
    Route::post('/update-anhdaidien/{id}', [UserController::class, 'update_anhdaidien'])->name('User.update_anhdaidien');
    Route::post('/User-setting/{id}', [UserController::class, 'save_user_setting'])->name('User.save_user_setting');
    Route::get('/User-list', [UserController::class, 'danh_sach_user'])->name('User.danh_sach_user');
    Route::post('/User-cap-quyen/{id_user}', [UserController::class, 'cap_quyen_user'])->name('User.cap_quyen_user');
    Route::post('/User-khoa-tai-khoan/{id_user}', [UserController::class, 'khoa_user'])->name('User.khoa_user');
    Route::post('/User-lhoa-binhluan/{id_user}', [UserController::class, 'khoa_comment_user'])->name('User.khoa_comment_user');
    
    Route::post('/Nap-tien', [BillController::class, 'Naptien'])->name('Bill.Naptien');
    Route::get('/Nap-tien-thanh-cong/{id}', [BillController::class, 'Naptienthanhcong'])->name('Bill.Naptienthanhcong');
    
    Route::post('/Bao-cao', [ReportController::class, 'bao_cao'])->name('Report.bao_cao');
    Route::get('/Bao-cao-list', [ReportController::class, 'bao_cao_list_user'])->name('Report.bao_cao_list_user');
    Route::get('/Bao-cao-chitiet-user/{id}', [ReportController::class, 'chitiet_report_user'])->name('Report.chitiet_report_user');
    Route::post('/Bao-cao-capnhat-user/{id}', [ReportController::class, 'update_report_user'])->name('Report.update_report_user');
    Route::get('/Bao-cao-list-admin/{status}', [ReportController::class, 'bao_cao_list_admin'])->name('Report.bao_cao_list_admin');
    Route::post('/Bao-cao-capnhat-admin/{id}', [ReportController::class, 'update_report_admin'])->name('Report.update_report_admin');
    Route::post('/Bao-cao-thong-ke-nap-tien', [ReportController::class, 'thongke_nap'])->name('Report.thongke_nap');
    Route::post('/Bao-cao-thong-ke-tac-gia', [ReportController::class, 'thongke_tacgia'])->name('Report.thongke_tacgia');
    Route::post('/Bao-cao-thong-ke-tac-pham', [ReportController::class, 'thongke_tacpham'])->name('Report.thongke_tacpham');
    Route::post('/Bao-cao-thong-ke-rut-tien', [ReportController::class, 'thongke_ruttien'])->name('Report.thongke_ruttien');
    
    
    Route::post('/Danh-gia-truyen/{id_novel}', [CommentController::class, 'danhgia_novel'])->name('Comment.danhgia_novel');
    Route::get('/Danh-gia-list/{id_novel}', [CommentController::class, 'danhgia_list'])->name('Comment.danhgia_list');
    Route::post('/Danh-gia-phanhoi/{id_comment}', [CommentController::class, 'danhgia_reply'])->name('Comment.danhgia_reply');
    Route::post('/Danh-gia-Phan-hoi-capnhat/{id_comment}', [CommentController::class, 'danhgia_phanhoi_update'])->name('Comment.danhgia_phanhoi_update');
    Route::post('/Danh-gia-Phan-hoi-an', [CommentController::class, 'danhgia_phanhoi_hide'])->name('Comment.danhgia_phanhoi_hide');
    Route::post('/Danh-gia-Phan-hoi-go', [CommentController::class, 'danhgia_phanhoi_delete'])->name('Comment.danhgia_phanhoi_delete');
});










