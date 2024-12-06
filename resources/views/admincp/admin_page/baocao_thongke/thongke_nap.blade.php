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


    // $day_start_filter ='2024-06-06';
    // $day_end_filter = '2024-06-06';

    $day_start = $day_start_filter != '' ? \Carbon\Carbon::createFromFormat('Y-m-d', $day_start_filter)->format('d-m-Y') :'...........';
    $day_end = $day_end_filter != '' ? \Carbon\Carbon::createFromFormat('Y-m-d', $day_end_filter)->format('d-m-Y'):'..............';

    $results_charges = DB::table('tblbill')
        ->join('users', 'tblbill.idUser', '=', 'users.id');

    $results_charges = $day_start_filter != ''? $results_charges->whereDate('tblbill.dCreateDay', '>=', $day_start_filter) : $results_charges ;
    $results_charges = $day_end_filter != ''? $results_charges->whereDate('tblbill.dCreateDay', '<=', $day_end_filter) : $results_charges;

    $results_charges = $results_charges->where('tblbill.iStatus', 1)
        ->groupBy('users.id', 'users.name', 'users.email', 'users.email_verified_at', 'users.password', 'users.sRole', 'users.remember_token', 'users.created_at', 'users.updated_at', 'users.sAdress', 'users.dBirthday', 'users.sGender', 'users.sAvatar', 'users.sSetup', 'users.iCoint', 'users.iCoint_receive', 'users.iStatus', 'users.iComment')
        ->select('users.id', 'users.name', 'users.email', 'users.email_verified_at', 'users.password', 'users.sRole', 'users.remember_token', 'users.created_at', 'users.updated_at', 'users.sAdress', 'users.dBirthday', 'users.sGender', 'users.sAvatar', 'users.sSetup', 'users.iCoint as user_coint', 'users.iCoint_receive', 'users.iStatus as user_status', 'users.iComment', DB::raw('SUM(tblbill.iCoint) as total_coint, SUM(tblbill.iMoney) as total_money'))
        ->get();
    // dd($results_charges);

    $currentDate = Carbon::now();
    $day = $currentDate->day;
    $month = $currentDate->month;
    $year = $currentDate->year;

    $formattedDate = '......., Ngày ' . $day . ', tháng ' . $month . ', năm ' . $year;

    $tong_tien = 0;
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
            <label class="small mb-1 fw-bolder" for="inputUsername">Người lập cáo cáo: </label><span>{{ ' '.Auth::user()->name }}</span>
        </div>
        <div class="col-md-8">
            <label class="small mb-1 fw-bolder" for="inputEmailAddress">Email:  </label><span>{{ ' '.Auth::user()->email }}</span>
        </div>
    </div>

</div>
<table class="table table-hover mb-5">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên người dùng</th>
            <th scope="col">Email</th>
            <th scope="col">Số xu có</th>
            <th scope="col">Thu nhập</th>
            <th scope="col">Số xu đã nạp</th>
            <th scope="col">Số tiền đã nạp</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($results_charges as $key => $results_charge)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td scope="col">{{ $results_charge->name }}</td>
                <td scope="col">{{ $results_charge->email }}</td>
                <td scope="col">{{ $results_charge->user_coint }} <i class="fa-solid fa-coins"></i></td>
                <td scope="col">{{ $results_charge->iCoint_receive }} <i class="fa-solid fa-coins"></i></td>
                <td scope="col">{{ $results_charge->total_coint }} <i class="fa-solid fa-coins"></i></td>
                <td scope="col">{{ number_format($results_charge->total_money, 0, ',', '.')}} VNĐ</td>
            </tr>
            @php
                $tong_tien += $results_charge->total_money;
            @endphp
        @endforeach
        <tr>
            <th colspan="6">Tổng tiền thu về là : </th>
            <th>{{number_format($tong_tien, 0, ',', '.')}} VNĐ</th>
        </tr>
    </tbody>
</table>
<div class="container-xl p-0 mb-3 d-flex justify-content-around align-content-center">
    <div></div>
    <div class="mb-4 d-flex justify-content-center align-content-center flex-column">
        <span class="text text-center fw-bolder">{!!$formattedDate!!}</span>
        <h4 class="text text-center mt-2 fw-bolder">Người lập báo cáo</h4>
        <span class="text text-center fw-bolder">{{Auth::user()->name}}</span>
    </div>
</div>

