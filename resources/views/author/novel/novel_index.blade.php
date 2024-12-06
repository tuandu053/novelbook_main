<?php
use App\Models\Categories;
use Illuminate\Support\Str;

$cats = Categories::orderBy('id', 'DESC')->where('iStatus', 1)->get();

$count = $chapters->count();
$matchingIds = [];

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
            @if (Auth::user()->sRole !== 'user' && Auth::user()->id == $novel->idUser)
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card  mb-xl-0">
                                <div class="card-header fw-bold">Ảnh bìa truyện</div>
                                <div class="card-body ntp_anh_bia_wrap text-center">
                                    <!-- Profile picture image-->
                                    <img class="ntp_anh_bia ntp_detail_novel mb-2 w-100" src="{{ asset('uploads/images/' . $novel->sCover) }}"
                                        alt="{{$novel->sCover}}">
                                    <!-- Profile picture help block-->
                                    <div class="my-3">
                                        <div class="alert alert-success ntp_hidden update_anhdaidien" role="alert"></div>
                                        <div class="alert alert-danger ntp_hidden update_anhdaidien" role="alert"></div>
                                        <label for="ntp_input_anhbiatruyen" class="btn m-0 btn-primary form-label">Chọn ảnh bìa</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <!-- Account details card-->
                            <div class="card ">
                                <div class="card-header fw-bold">Thông tin chi tiết truyện</div>
                                <div class="card-body">
                                    @if ( $novel->iLicense_Status == 3)
                                    <div class="alert alert-danger" role="alert">
                                        <span class="ntp_alert_close bg-danger"><button type="button" class="btn-close"></button></span>
                                        Việc xin kiểm duyệt truyện của bạn đã bị từ chối hãy kiểm tra lại kĩ thông tin bạn cung cấp, và các thông tin mô tả, xác thực bản quyền. Nếu có lỗi làm ơn hãy viết tố cáo. NovelBook Xin cám ơn.</div>
                                    @endif
                                    <form method="POST" id="ntp_form_create_novel"
                                        action="{{ route('Novel.update', [$novel->id]) }}">
                                        @csrf
                                        @method('patch')
                                        <input class="form-control d-none" type="file" id="ntp_input_anhbiatruyen" name="anhbia"
                                            accept="image/*">
                                        <div class="alert alert-success ntp_hidden" role="alert"></div>
                                        <div class="alert alert-danger ntp_hidden" role="alert"></div>

                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputnovelname">Tên truyện</label>
                                            <input class="form-control" id="inputnovelname" maxlength="255"
                                                value="{{ $novel->sNovel }}" name="tentruyen" type="text"
                                                placeholder="Tên truyện là">
                                        </div>
                                        <div class="mb-3">
                                            <label class="small mb-1">Mô tả</label>
                                            <textarea name="motatruyen" id="motatruyen" class="ntp_ckeditor ckeditor w-100" {{-- cols="30" rows="10" --}}>{{ htmlspecialchars_decode($novel->sDes) }}</textarea>
                                        </div>
                                        <div class="gx-3 mb-3 input-group">
                                            <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                                data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false"> Thể
                                                loại</button>
                                            <div class="dropdown-menu dropdown-menu-lg-end">
                                                <div class="d-flex gap-3 flex-wrap p-2 ntp_select_the_loai overflow-auto ntp_custom_ver_scrollbar"
                                                    role="group" aria-label="Basic checkbox toggle button group">

                                                    @foreach ($cats as $key => $cat)
                                                        <input class="form-check-input btn-check"
                                                            {{ in_array($cat->id, $matchingIds) ? 'checked' : '' }} type="checkbox"
                                                            autocomplete="off" value="{{ $cat->id }}" name="theloai[]"
                                                            id="{{ Str::slug($cat->sCategories) . '_' . $cat->id }}">
                                                        <label class="btn btn-outline-primary"
                                                            for="{{ Str::slug($cat->sCategories) . '_' . $cat->id }}">{{ $cat->sCategories }}</label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="gx-3 mb-3">
                                            <label class="small mb-1">Tiến độ</label>
                                            <select class="form-select" name="tiendo" id="inputnovelprogress"
                                                aria-label="Default select example">
                                                <option <?php echo $novel->sProgress == '1' ? 'selected' : ''; ?> value="1">Còn tiếp</option>
                                                <option <?php echo $novel->sProgress == '2' ? 'selected' : ''; ?> value="2">Tạm ngừng</option>
                                                <option <?php echo $novel->sProgress == '3' ? 'selected' : ''; ?> value="3">Hoàn thành</option>
                                            </select>
                                        </div>

                                        <div class="gx-3 mb-3">
                                            <label class="form-label">Minh chứng quyền tác giả / quyền sở hữu với tác phẩm đã cung cấp</label>
                                            <iframe id="ntp_banquyen_da_upload" src="{{asset('uploads/banquyen/' . $novel->sLicense)}}" class="w-100 vh-100"></iframe>
                                        </div>
                                        @if($novel->iLicense_Status != 1)
                                            <div class="gx-3 mb-3">
                                                <label for="upload_banquyen" class="form-label">Minh chứng quyền tác giả hoặc quyền sở hữu với tác phẩm</label>
                                                <input class="form-control mb-3" type="file" name="banquyen" id="upload_banquyen">
                                            </div>
                                        @endif

                                        <!-- Save changes button-->
                                        <button class="btn btn-primary ntp_btn_update_infor_novel" type="button">Cập nhật</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="card">
                                <div class="card-header">Thêm chương mới</div>
                                
                                <div class="card-body">
                                    <form method="POST" id="ntp_form_create_chapter" action="{{ route('Chapter.store') }}">
                                        <div class="alert alert-success ntp_hidden" role="alert"></div>
                                        <div class="alert alert-danger ntp_hidden" role="alert"></div>
                                        <input type="hidden" value="{{ $novel->id }}" name="idNovel">
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputchaptername">Tên chương</label>
                                            <input class="form-control" id="inputchaptername" maxlength="255" name="tenchuong"
                                                type="text" placeholder="Tên chương là">
                                        </div>

                                        <div class="mb-3">
                                            <label class="small mb-1">Nội dung chương</label>
                                            <textarea name="noidungchuong" id="noidungchuong" class="ntp_ckeditor ckeditor w-100"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="small mb-1">Đăng tải không ?</label>
                                            <select class="form-select" name="tinhtrang" aria-label="Default select example">
                                                <option value="1" selected>Đăng tải</option>
                                                <option value="0">Không đăng tải</option>
                                            </select>
                                        </div>
                                        @if ($count>= 10)
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1">Có tính phí không</label>
                                                    <select class="form-select" name="tinhphi" aria-label="Default select example">
                                                        <option value="0" selected>Không tính phí</option>
                                                        <option value="1">Tính phí</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputchapterprice">Giá tiền</label>
                                                    <input class="form-control" id="inputchapterprice" name="giatien" value="1" type="number" min="0" placeholder="Giá tiền bạn đặt cho chương này là (Nếu không nhập sẽ mặc định là 1)">
                                                </div>
                                            </div>
                                        @endif
                                        <!-- Save changes button-->
                                        <button class="btn btn-primary ntp_btn_create_chapter" type="button">Thêm mới</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 mb-5">
                            @include('author.novel.single_mucluc')
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
