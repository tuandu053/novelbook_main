@php
    use App\Models\User;
    use Carbon\Carbon;


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
    <span class="text text-center fw-bolder">Thống kê rút tiền trong tháng {{$month}} năm {{$year}}</span>
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
            <th scope="col">Số xu rút</th>
            <th scope="col">Thành tiền</th>
            <th scope="col">Ngày yêu cầu</th>
            <th scope="col">Ngân hàng</th>
            <th scope="col">Số tài khoản</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($withdraws as $key => $withdraw)
            @php
                $user = User::find($withdraw->idUser);
                $tong_tien += $withdraw->iCoint;
            @endphp
            <tr>
                <th scope="col">{{ $key + 1 }}</th>
                <td scope="col">{{ $user->name }}</td>
                <td scope="col">{{ $user->email }}</td>
                <td scope="col">{{ $withdraw->iCoint }} <i class="fa-solid fa-coins"></i></td>
                <td scope="col">{{ number_format( $withdraw->iCoint*1000, 0, ',', '.') }} VNĐ</td>
                <td scope="col">{{ $withdraw->dCreateDay }} </td>
                <td scope="col">{{ $withdraw->sBank }} </td>
                <td scope="col">{{ $withdraw->sBankAccountNumber }} </td>
            </tr>
        @endforeach
        <tr>
            <th colspan="4">Tổng tiền rút về là : </th>
            <th colspan="4">{{number_format($tong_tien *1000, 0, ',', '.')}} VNĐ</th>
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

