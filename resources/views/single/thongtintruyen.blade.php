
<?php
    use App\Models\Chapter;
    use App\Models\Categories;
    use App\Models\Bookmarks;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Auth;

    $firtschapter = Chapter::where('idNovel',$novel->id)->where('iChapterNumber', 1)->first(); 

    $cats = Categories::orderBy('id', 'DESC')->where('iStatus', 1)->get();

    $matchingIds = [];

    foreach ($theloai as $loai) {
        foreach ($cats as $cat) {
            if ($cat->id == $loai->idCategories) {
                $matchingIds[] = $cat->id;
            }
        }
    }
?>
<div class="card ntp_novel_single" data-novel-id="{{$novel->id}}" style="background: transparent; backdrop-filter: blur(4px);">
    <div class="card-header fw-bold">Thông tin truyện </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 ntp_novel_single_img mb-4 mb-md-0">
                {{-- Ảnh bìa --}}
                <div class="bg-image hover-overlay rounded  overflow-hidden ripple" data-mdb-ripple-color="light">
                    <a href="{{ route('Novel.show', [$novel->id]) }}">
                        <img src="{{ asset('uploads/images/'.$novel->sCover) }}" class=" w-100 img-fluid ntp_anh_bia"
                            alt="{{$novel->sCover}}">
                    </a>
                </div>
            </div>
            <div class="col-md-9 ntp_novel_single_infor overflow-Y overflow-Xh  ntp_custom_ver_scrollbar" >
                {{-- Thông tin --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Tên truyện</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="fw-bold mb-0 ntp_novel_name"> {{$novel->sNovel}} </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Tác giả</p>
                        </div>
                        <div class="col-sm-9">

                            <a href="#!" class=" w-50">
                                <p class="mb-0 fw-bold"><i class="fa-solid fa-user me-2"></i>{{$author->sNickName}}
                                </p>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Số chương</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="fw-bold mb-0"> {{$count}} chương </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Giới thiệu</p>
                        </div>
                        <div class="col-sm-9 ntl_tomtat overflow-auto ntp_custom_ver_scrollbar">
                            {!!htmlspecialchars_decode($novel->sDes)!!}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Thể loại</p>
                        </div>
                        <div class="col-sm-9 d-flex flex-row flex-wrap gap-3 fw-bold">
                            @foreach ($cats as $key => $cat)
                                @if (in_array($cat->id, $matchingIds))
                                    <span>{{ $cat->sCategories}}</span> |
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Tiến độ</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-0 fw-bold">
                                @if ($novel->sProgress == 1)
                                    <span class="text fw-bold">Còn tiếp</span>
                                @elseif ($novel->sProgress == 2)
                                    <span class="text fw-bold">Tạm ngưng</span>
                                @elseif ($novel->sProgress == 3)
                                    <span class="text fw-bold">Hoàn thành</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Thông số</p>
                        </div>
                        <div class="col-sm-9">
                            <div class="row w-100">
                                <p class="fw-bold mb-0 w-50">{{$readingHistory}} lượt đọc</p>
                                <p class="fw-bold mb-0 w-50 ntp_count_bookmark">{{$bookmark}} đánh dấu</p>
                            </div>
                            <hr>
                            <div class="row w-100">
                                <p class="fw-bold mb-0 w-25">Đánh giá: {{round($averagePoint, 1)}} <i class="fas fa-star fa-sm text-warning "></i></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0 fw-bold">Thao tác</p>
                        </div>
                        <div class="col-sm-9">
                            <div class="row w-100">

                                @if ($firtschapter)
                                    <a href="{{route('Chapter.show', [$firtschapter->id])}}" class=" w-50">
                                        <p class="fw-bold mb-0"><i class="fa-solid fa-book-open me-2"></i>Đọc luôn
                                        </p>
                                    </a>
                                @endif

                                <?php
                                    $text = 'Đánh dấu';
                                    $class = 'text-success';
                                    if(Auth::check()) {
                                        $bookmark = Bookmarks::where('idUser',Auth::user()->id)->where('idNovel', $novel->id)->first();

                                        if($bookmark) {
                                            $text = 'Hủy đánh dấu';
                                            $class = 'text-danger';
                                        }
                                    }
                                ?>
                                <a href="javascript:void(0);" data-name="{{$novel->sNovel}}"  data-novel-link="{{route('Novel.show',[$novel->id])}}" data-link="{{route('Bookmark.store')}}" data-novel-id="{{$novel->id}}" class="ntp_mark w-50">
                                    <p class="{{$class}} mb-0"><i class="fa-solid fa-bookmark me-2"></i>{{$text}}</p>
                                </a>
                            </div>
                            <hr>
                            <div class="row w-100">
                                <a href="#ntp_mucluc" class=" w-50">
                                    <p class="fw-bold mb-0"><i class="fa-solid fa-bars me-2"></i>Mục lục
                                    </p>
                                </a>
                                <a href="#ntp_review" class=" w-50">
                                    <p class="fw-bold mb-0 "><i class="fas fa-comment me-2 "></i>Binh luận đánh giá</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
