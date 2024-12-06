<?php

use App\Models\User;
?>
@guest
    <div class="card-body">
        @include('layouts.404_traiphep')
    </div>
@else
    @auth
    <div class="card-body overflow-auto ntp_custom_ver_scrollbar" style="height: 500px;">
        @foreach ($reports as $key => $report)
            @php
                $class = ' alert-info';
                $class = $report->iStatus == 1? 'alert-success': $class;
                $class = $report->iStatus == 3? ' alert-danger': $class;

                $status = 'Chưa xử lý';
                $status = $report->iStatus == 1? 'Đã xử lý': $status;
                $status = $report->iStatus == 3? 'Từ chối xử lý': $status;
            @endphp
            <div class="alert ntp_default ntp_alert_static {{$class}}" role="alert">
                <h4 class="alert-heading">Tiêu đề: {{$report->sTitle}}</h4>
                <?php
                $user = User::find($report->idUser);
                ?>
                <div class="d-flex justify-content-between flex-wrap">
                    <span class="mb-0">Nguời tố cáo: {{$user->name}}</span> 
                    <span class="mb-0">Email: {{$user->email}}</span> 
                    <span class="mb-0">Trạng thái xử lý: {{$status}}</span> 
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span class="mb-0">Ngày khởi tạo tố cáo: {{$report->dCreateDay}}</span> 
                    <a href="#" class="btn btn-primary ntp_btn_report_detail_user" data-bs-toggle="modal" data-bs-target="#ntp_report_detail" data-link="{{ route('Report.chitiet_report_user', [$report->id]) }}">Chi tiết</a>
                </div>
                
            </div>
        @endforeach
    </div>
    @endauth
@endguest
