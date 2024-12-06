
@php
    use App\Models\Novel;
    use App\Models\Author;
use Illuminate\Support\Facades\DB;

$novels = Novel::select(
    'tblnovel.id', 
    'tblnovel.sNovel', 
    'tblnovel.sCover', 
    'tblnovel.sDes', 
    'tblnovel.dCreateDay', 
    'tblnovel.dUpdateDay', 
    'tblnovel.sProgress', 
    'tblnovel.iStatus', 
    'tblnovel.idUser', 
    'tblnovel.iLicense_Status', 
    'tblnovel.sLicense',
    DB::raw('AVG(tblcomment.sPoint) as avg_rating'),
    DB::raw('COUNT(DISTINCT tblreading_history.id) as read_count'),
    DB::raw('COUNT(DISTINCT tblbookmarks.id) as bookmark_count'),
    DB::raw('COUNT(DISTINCT tblchapter.id) as chapter_count')
)
->leftJoin('tblcomment', function($join) {
    $join->on('tblnovel.id', '=', 'tblcomment.idNovel')
        ->where('tblcomment.iDelete', '=', 0)
        ->whereNull('tblcomment.id_Comment_parent');
})
->leftJoin('tblchapter', 'tblnovel.id', '=', 'tblchapter.idNovel')
->leftJoin('tblreading_history', 'tblchapter.id', '=', 'tblreading_history.idChapter')
->leftJoin('tblbookmarks', 'tblnovel.id', '=', 'tblbookmarks.idNovel')
->where('tblnovel.iLicense_Status', '=', 1)
->where('tblnovel.iStatus', '=', 1)
->groupBy(
    'tblnovel.id', 
    'tblnovel.sNovel', 
    'tblnovel.sCover', 
    'tblnovel.sDes', 
    'tblnovel.dCreateDay', 
    'tblnovel.dUpdateDay', 
    'tblnovel.sProgress', 
    'tblnovel.iStatus', 
    'tblnovel.idUser', 
    'tblnovel.iLicense_Status', 
    'tblnovel.sLicense'
)
->orderByDesc('avg_rating')
->take(10)
->get();
@endphp
<div class="card" style="background: transparent; backdrop-filter: blur(4px);">
    <div class="card-header fw-bold ">Truyện được đánh giá cao</div>
    <div class="card-body">
        <div class="ntp_recommend ntp_slick_l_p0">
            @foreach ($novels as $key => $novel)
            
                <div class="ntp_item d-flex gap-2">
                    <div class="w-50 ntp_img mb-4 mb-md-0">
                        {{-- Ảnh bìa --}}
                        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                            <a href="{{route('Novel.show',[$novel->id])}}">
                                <img class="w-100 ntp_anh_bia" src="{{ asset('uploads/images/'.$novel->sCover) }}" class="img-fluid"
                                    alt="{{$novel->sCover}}">
                            </a>
                        </div>
                    </div>
                    <div class="w-50 ntp_infor  overflow-Y overflow-Xh  ntp_custom_ver_scrollbar">
                        {{-- Thông tin --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-xl-3">
                                    <p class="mb-0 fw-bold">Tên truyện</p>
                                </div>
                                <div class="col-sm-12 col-xl-9">
                                    <p class="fw-bold mb-0"> {{$novel->sNovel}} </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <p class="mb-0 fw-bold">Số chương {{$novel->chapter_count}}</p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xl-3">
                                    <p class="mb-0 fw-bold">Giới thiệu</p>
                                </div>
                                <div class="col-sm-12 col-xl-9 ntl_tomtat overflow-auto ntp_custom_ver_scrollbar">
                                    {!! htmlspecialchars_decode($novel->sDes) !!}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xl-3">
                                    <p class="mb-0 fw-bold">Tác giả</p>
                                </div>
                                <div class="col-sm-12 col-xl-9">
                                    @php
                                        $author_info = Author::where('idUser',$novel->idUser)->first();
                                    @endphp
                                    <a href="#!" class=" w-50">
                                        <p class="mb-0 fw-bold"><i class="fa-solid fa-user me-2"></i> {{$author_info->sNickName}}
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xl-3">
                                    <p class="mb-0 fw-bold">Tiến độ</p>
                                </div>
                                <div class="col-sm-12 col-xl-3">
                                    <?php
                                        if ($novel->sProgress == '1') {
                                            echo '<span class="fw-bold"> Còn tiếp</span>';
                                        } elseif ($novel->sProgress == '2') {
                                            echo '<span class="fw-bold"> Tạm ngừng</span>';
                                        } elseif ($novel->sProgress == '3') {
                                            echo '<span class="fw-bold"> Hoàn thành</span>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xl-3">
                                    <p class="mb-0 fw-bold">Thông số</p>
                                </div>
                                <div class="col-sm-12 col-xl-9">
                                    <div class="row w-100">
                                        <p class="fw-bold mb-0 col-sm-12 col-md-6">{{$novel->read_count}} lượt đọc</p>
                                        <p class="fw-bold mb-0 col-sm-12 col-md-6">{{$novel->bookmark_count}} đánh dấu</p>
                                    </div>
                                    <hr>
                                    <div class="row w-100">
                                        <p class=" mb-0 fw-bold">Đánh giá: {{round($novel->avg_rating, 1)}} <i class="fas fa-star fa-sm text-warning " ></i></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12 col-xl-3">
                                </div>
                                <div class="col-sm-12 col-xl-3 d-flex">
                                    <a href="{{route('Novel.show',[$novel->id])}}" class=" w-100">
                                        <p class=" mb-0 fw-bold"><i class="fa-solid fa-book-open me-2"></i>Đọc luôn
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            @endforeach
        </div>
    </div>
</div>
