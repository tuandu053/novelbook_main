<?php
use App\Models\Categories;
use App\Models\Classify;
use App\Models\Chapter;
use Illuminate\Support\Str;

$cats = Categories::orderBy('id', 'DESC')->where('iStatus', 1)->get();
$matchingIds = [];
$theloai = Classify::orderby('id', 'ASC')->where('idNovel',$novel->id)->get();
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
                                    <img class="ntp_anh_bia ntp_detail_novel mb-2 w-100" src="{{ asset('uploads/images/' . $novel->sCover) }}" alt="{{$novel->sCover}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <!-- Account details card-->
                            <div class="card ">
                                <div class="card-header fw-bold">Thông tin chi tiết truyện</div>
                                <div class="card-body">
                                        <div class="mb-3">
                                            Tên truyện:<span class="text-success"> {{ $novel->sNovel }}</span>
                                        </div>
                                        <div class="mb-3">
                                            Mô tả: <div class="text-success">{!!htmlspecialchars_decode($novel->sDes)!!}</div>
                                        </div>
                                        <div class="gx-3 mb-3 input-group">
                                            <span>Thể loại:&nbsp;</span> 
                                            @foreach ($cats as $key => $cat)
                                                @if (in_array($cat->id, $matchingIds))
                                                    <span class="text-success">&nbsp;{{$cat->sCategories}}&nbsp;</span>|
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="gx-3 mb-3">Tiến độ:	
                                                <?php
                                                    if( $novel->sProgress == '1') {
                                                        echo'<span class="text-success"> Còn tiếp</span>';
                                                    } elseif ($novel->sProgress == '2') {
                                                        echo'<span class="text-danger"> Tạm ngừng</span>';
                                                    } elseif ($novel->sProgress == '3') {
                                                        echo'<span class="text-success"> Hoàn thành</span>';
                                                    }
                                                ?>
                                        </div>
                                        <div class="gx-3 mb-3">
                                            <a class="btn btn-outline-success" href="{{route('Novel.quan_ly_truyen',[$novel->id])}}">Quay lại trang chi tiết truyện</a>
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
                                <div class="card-header">Sửa chương</div>
                                <div class="card-body">
                                    <form method="POST" id="ntp_form_update_chapter" action="{{ route('Chapter.update',[$chapters->id]) }}">
                                        @method('patch')
                                        @csrf
                                        <div class="alert alert-success ntp_hidden" role="alert"></div>
                                        <div class="alert alert-danger ntp_hidden" role="alert"></div>
                                        <input type="hidden" value="{{ $novel->id }}" name="idNovel">
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputchaptername">Tên chương</label>
                                            <input class="form-control" id="inputchaptername" maxlength="255" name="tenchuong"
                                                type="text" value="{{$chapters->sChapter}}" placeholder="Tên chương là">
                                        </div>

                                        <div class="mb-3">
                                            <label class="small mb-1">Nội dung chương</label>
                                            <textarea name="noidungchuong" id="noidungchuong" class="ntp_ckeditor ckeditor w-100">{{htmlspecialchars_decode($chapters->sContent)}}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="small mb-1">Đăng tải không ?</label>
                                            <select class="form-select" name="tinhtrang" aria-label="Default select example">
                                                <option value="1"<?php echo($chapters->iStatus == 1 ? 'selected':'');?>>Đăng tải</option>
                                                <option value="0"<?php echo($chapters->iStatus == 0 ? 'selected':'');?>>Không đăng tải</option>
                                            </select>
                                        </div>
                                        @if ($chapters->iChapterNumber>= 10)
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1">Có tính phí không</label>
                                                    <select class="form-select" name="tinhphi" aria-label="Default select example">
                                                        <option value="0" <?php echo($chapters->icharges == 0 ? 'selected':'');?>>Không tính phí</option>
                                                        <option value="1" <?php echo($chapters->icharges == 1 ? 'selected':'');?>>Tính phí</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputchapterprice">Giá tiền</label>
                                                    <input class="form-control" id="inputchapterprice" name="giatien" value="{{$chapters->iPrice}}" type="number" min="0" placeholder="Giá tiền bạn đặt cho chương này là (Nếu không nhập sẽ mặc định là 1)">
                                                </div>
                                            </div>
                                        @endif
                                        <!-- Save changes button-->
                                        <button class="btn btn-primary ntp_btn_update_chapter" type="button">Cập nhật chương</button>
                                    </form>
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
            @else
            <div class="container">
                @include('layouts.404_traiphep')
            </div> 
            @endif
        @endauth
    @endguest
@endsection
