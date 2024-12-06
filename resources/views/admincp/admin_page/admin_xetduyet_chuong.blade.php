<?php
use App\Models\Categories;
use App\Models\Classify;
use App\Models\Chapter;
use Illuminate\Support\Str;
use Carbon\Carbon;

$cats = Categories::orderBy('id', 'DESC')->where('iStatus', 1)->get();
$count = Chapter::orderBy('iChapterNumber', 'ASC')
    ->where('idNovel', $novel->id)
    ->get()
    ->count();
$matchingIds = [];
$theloai = Classify::orderby('id', 'ASC')
    ->where('idNovel', $novel->id)
    ->get();
foreach ($theloai as $loai) {
    foreach ($cats as $cat) {
        if ($cat->id == $loai->idCategories) {
            $matchingIds[] = $cat->id;
        }
    }
}
?>
@extends('layouts.app')

@section('content')
    @guest
        <div class="container">
            @include('layouts.404_traiphep')
        </div>
    @else
        @auth
            @if (Auth::user()->sRole == 'admin')
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 mb-5">
                            <!-- Profile picture card-->
                            <div class="card  mb-xl-0">
                                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Ảnh bìa truyện</div>
                                <div class="card-body ntp_anh_bia_wrap text-center" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                                    <!-- Profile picture image-->
                                    <img class="ntp_anh_bia ntp_detail_novel mb-2 w-100"
                                        src="{{ asset('uploads/images/' . $novel->sCover) }}" alt="{{$novel->sCover}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 mb-5">
                            <!-- Account details card-->
                            <div class="card ">
                                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Thông tin chi tiết truyện</div>
                                <div class="card-body" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                                    <div class="mb-3">
                                        Tên truyện:<span class="text-success"> {{ $novel->sNovel }}</span>
                                    </div>
                                    <div class="mb-3">
                                        Mô tả: <div class="text-success">{!! htmlspecialchars_decode($novel->sDes) !!}</div>
                                    </div>
                                    <div class="gx-3 mb-3">
                                        <span>Thể loại:&nbsp;</span>
                                        @foreach ($cats as $key => $cat)
                                            @if (in_array($cat->id, $matchingIds))
                                                <span class="text-success">&nbsp;{{ $cat->sCategories }}&nbsp;</span>|
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="gx-3 mb-3">Tiến độ:
                                        <?php
                                            if ($novel->sProgress == '1') {
                                                echo '<span class="text-success"> Còn tiếp</span>';
                                            } elseif ($novel->sProgress == '2') {
                                                echo '<span class="text-danger"> Tạm ngừng</span>';
                                            } elseif ($novel->sProgress == '3') {
                                                echo '<span class="text-success"> Hoàn thành</span>';
                                            }
                                        ?>
                                    </div>
                                    <div class="gx-3 mb-3">
                                        <a class="btn btn-outline-success"
                                            href="{{ route('Novel.show', [$novel->id]) }}">Trang truyện</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="card">
                                <div class="card-header" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Danh sách chương kiểm duyệt</div>
                                <div class="card-body"  style="background-color: #fff5e6; border: 1px solid #f7d9c4;" id="ntp_mucluc">
                                    @include('admincp.admin_page.admin_mucluc')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 mb-5">
                            {{-- @include('author.novel.single_mucluc') --}}
                        </div>
                    </div>
                </div>

                

                <div class="modal fade ntp_chapter_detail_admin" id="ntp_chapter_detail_admin"
                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="ntp_chapter_detail_adminLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ntp_chapter_detail_adminLabel">Thông tin chi tiết chương truyện</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    Tên chương: <span class="text-primary sChapter">Loading...</span>
                                    <input type="hidden" class="id" id="idChapter">
                                </div>
                                <div class="mb-3">
                                    Số thứ tự chương: <span class="text-primary iChapterNumber ntp_load">Loading...</span>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">Ngày đăng: <span class="text-primary dCreateDay ntp_load">Loading...</span></div>
                                    <div class="col-md-6">Ngày cập nhật gần nhất: <span class="text-primary dUpdateDay ntp_load">Loading...</span></div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">Tính phí: <span class="text-primary icharges ntp_load">Loading...</span></div>
                                    <div class="col-md-6">Giá tiền: <span class="text-primary iPrice ntp_load">Loading...</span></div>
                                </div>

                                <div class="mb-3">
                                    Nội dung: <div class="sContent ntp_load border-1 border mt-2 rounded-2 p-2">Loading...</div>
                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <form method="POST" class="d-flex gap-3 flex-wrap justify-content-center align-content-center" id="ntp_form_chapter_check" 
                                action="{{route('Chapter.kiem_duyet_chuong')}}">
                                    @csrf
                                    <div class="alert alert-success ntp_hidden" role="alert"></div>
                                    <div class="alert alert-danger ntp_hidden" role="alert"></div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="xuly" id="xuly_chapter">
                                        <label class="form-check-label" for="xuly_chapter">Tình trạng kiểm duyệt</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="trangthai" id="trangthai_chapter">
                                        <label class="form-check-label" for="trangthai_chapter">Tình trạng đăng tải</label>
                                    </div>
                                </form>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="button" data-id-novel="{{$novel->id}}" class="btn btn-primary ntp_chapter_detail_admin_check">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="container">
                    @include('layouts.404_traiphep')
                </div>
            @endif
        @endauth
    @endguest
@endsection
