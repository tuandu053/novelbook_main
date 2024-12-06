@php
    use App\Models\User;
    use App\Models\Novel;
    use App\Models\Categories;
    use App\Models\Chapter;
    use App\Models\Author;
    use App\Models\Classify;
    use App\Models\Bookmarks;
    use App\Models\Reading_history;
    use App\Models\Purchase_history;
    use App\Models\Comment;
    use Carbon\Carbon;

    // if (!isset($author_id) && Auth::check()) {
    //     $author_id = Auth::user()->id;
    // }

    $day_start = $day_start_filter != '' ? \Carbon\Carbon::createFromFormat('Y-m-d', $day_start_filter)->format('d-m-Y') :'';
    $day_end = $day_end_filter != '' ? \Carbon\Carbon::createFromFormat('Y-m-d', $day_end_filter)->format('d-m-Y'):'';

    $novels = Novel::where('idUser', $author_id)->where('iLicense_Status', 1)->get();

    $user = User::find($author_id);
    $author_infor = Author::where('idUser', $author_id)->first();

    $currentDate = Carbon::now();
    $day = $currentDate->day;
    $month = $currentDate->month;
    $year = $currentDate->year;

    $formattedDate = '......., Ngày ' . $day . ', tháng ' . $month . ', năm ' . $year;

    $tong_thunhap = 0;
@endphp
@if (isset($is_pdf) && $is_pdf == true )
    <style>
        * {
            font-family: DejaVu Sans;
            font-size: 14px !important;
        }
        .p-0 {
            padding: 0 !important;
        }
        .mb-3 {
            margin-bottom: 1rem !important;
        }
        .justify-content-center {
            justify-content: center !important;
        }
        .flex-column {
            flex-direction: column !important;
        }
        .d-flex {
            display: flex !important;
        }
        .text-center {
            text-align: center !important;
        }
        .fw-bolder {
            font-weight: bolder !important;
        }
        .text-start {
            text-align: left !important;
        }
        .p-0 {
            padding: 0 !important;
        }
        .mb-5 {
            margin-bottom: 3rem !important;
        }
        .table > :not(caption) > * > * {
            padding: 0.5rem 0.5rem;
        }
        thead, tbody, tfoot, tr, td, th {
            border-color: #000;
            border-style: solid;
            border-width: 1px;
            text-align: center !important;
        }
    </style>

@endif
<div class="container-xl p-0 mb-3 d-flex justify-content-center flex-column align-content-center">
    <h3 class="text text-center fw-bolder">BÁO CÁO THỐNG KÊ</h3>
    <span class="text text-center fw-bolder">Trong khoảng thời gian từ {{$day_start}} đến {{$day_end}}</span>
    <span class="text text-center fw-bolder">{!!$formattedDate!!}</span>
</div>
<div class="container-xl p-0 mb-3 text-start">
    <div class="row gx-3 mb-2">
        <div class="col-md-4">
            <label class="small mb-1 fw-bolder"  >Báo cáo thu nhập của: </label><span>{{ ' '.$user->name }}</span>
        </div>
        <div class="col-md-4">
            <label class="small mb-1 fw-bolder" >Bút danh tác giả: </label><span>{{  ' '.$author_infor->sNickName }}</span>
        </div>
    </div>
    <div class="mb-2">
        <label class="small mb-1 fw-bolder" >Email:  </label><span>{{ ' '.$user->email }}</span>
    </div>
    <div class="row gx-3 mb-2">
        <div class="col-md-4">
            <label class="small mb-1 fw-bolder" >Ngày sinh: </label><span>{{ ' '.$user->dBirthday }}</span>
        </div>
        <div class="col-md-6">
            <label class="small mb-1 fw-bolder" >Giới tính: </label> <span> {{ ' '.($user->sGender == 'nam' ? 'Nam' : 'Nữ') }}</span>
        </div>
    </div>
    <div class="mb-2">
        <label class="small mb-1 fw-bolder" >Địa chỉ: </label><span>{{ ' '.$user->sAdress }}</span>
    </div>
</div>
<table class="table table-hover mb-5">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên truyện</th>
            <th scope="col">Số chương</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Tiến độ</th>
            <th scope="col">Đánh giá</th>
            <th scope="col">Lượt đọc</th>
            <th scope="col">Thu nhập</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($novels as $key => $novel)
            <tr>
                @php
                    $chapter_count = Chapter::where('idNovel', $novel->id)->count();

                    $averagePoint = Comment::where('idNovel', $novel->id)
                        ->where('iDelete', 0)
                        ->whereNull('id_Comment_parent')
                        ->avg('sPoint');

                    $readingCount = Reading_history::join( 'tblchapter', 'tblreading_history.idChapter', '=', 'tblchapter.id', )->where('tblchapter.idNovel', $novel->id);
                    $readingCount = $day_start_filter != ''? $readingCount->whereDate('tblreading_history.dCreateDay', '>=', $day_start_filter) : $readingCount ;
                    $readingCount = $day_end_filter != ''? $readingCount->whereDate('tblreading_history.dCreateDay', '<=', $day_end_filter) : $readingCount;
                    $readingCount =  $readingCount->count();

                    $totalRevenue = Purchase_history::join( 'tblchapter', 'tblpurchase_history.idChapter', '=', 'tblchapter.id', )
                        ->where('tblchapter.idNovel', $novel->id);
                    $totalRevenue = $day_start_filter != ''? $totalRevenue ->whereDate('tblpurchase_history.dCreateDay', '>=', $day_start_filter) : $totalRevenue;
                    $totalRevenue = $day_end_filter != ''? $totalRevenue->whereDate('tblpurchase_history.dCreateDay', '<=', $day_end_filter) : $totalRevenue;
                    $totalRevenue= $totalRevenue->sum('tblpurchase_history.iprice')*0.7;

                    $tong_thunhap += $totalRevenue;

                @endphp
                <th scope="row">{{ $key + 1 }}</th>
                <td scope="col">{{ $novel->sNovel }}</td>
                <td scope="col">{{ $chapter_count }}</td>
                <td scope="col">
                    @if ($novel->iStatus == 1)
                        <span class="text text-success">Đăng tải</span>
                    @else
                        <span class="text text-danger">Gỡ bỏ</span>
                    @endif
                </td>
                <td scope="col">
                    @if ($novel->sProgress == 2)
                        <span class="text text-warning">Tạm ngưng</span>
                    @elseif ($novel->sProgress == 1)
                        <span class="text text-success">Còn tiếp</span>
                    @elseif ($novel->sProgress == 3)
                        <span class="text text-danger">Hoàn thành</span>
                    @endif
                </td>
                <td scope="col">{{ round($averagePoint, 1) }} <i class="fas fa-star fa-sm text-warning"></i></td>
                <td scope="col">{{ $readingCount }}</td>
                <td scope="col">{{ round($totalRevenue, 1) }} <i class="fa-solid fa-coins"></i></td>
            </tr>
        @endforeach
        <tr>
            <th>Tổng thu nhập</th>
            <th>{{round($tong_thunhap,1)}} <i class="fa-solid fa-coins"></i></th>
            <th colspan="3">Quy đổi ra giá trị tiền mặt (1<i class="fa-solid fa-coins"></i>) = 1.000 VNĐ</th>
            <th colspan="3">{{ number_format($tong_thunhap*1000, 0, ',', '.');}} VNĐ</th>
        </tr>
    </tbody>
</table>
<div class="container-xl p-0 mb-3 d-flex justify-content-around align-content-center">
    <div></div>
    <div class="mb-4">
        <span class="text text-center fw-bolder">{!!$formattedDate!!}</span>
        <h4 class="text text-center mt-2 fw-bolder">Người lập báo cáo</h4>
        <span class="text text-center fw-bolder">{{$nguoilapbaocao}}</span>
    </div>
</div>

