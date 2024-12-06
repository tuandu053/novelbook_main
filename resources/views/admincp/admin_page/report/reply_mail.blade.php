

<?php
    $xuly = 'Đã xử lý';
    $xuly = $report->iStatus== 3 ? 'Từ chối xử lý': $xuly;
    $xuly = $report->iStatus== 0 ? 'Chưa xử lý': $xuly
?>

<div class="mb-3">
    <h2> Xin chào {{$user->name}}, NovelBook đã nhận được tố cáo của bạn về "{{$report->sTitle }}" </h2>
</div>

<div class="mb-3">
    <p><strong>Tiêu đề tố cáo: </strong> {{$report->sTitle }}</p>
</div>

<div class="mb-3">
    <p><strong>Tình trạng xử lý: </strong>{{$xuly}}</p>
</div>

<div class="mb-3">
    <p><strong>Nội dung tố cáo: </strong>{{$report->sContent}}</p>
</div>

<div class="mb-3">
    <p><strong>Nội dung phản hồi: </strong>{{ $report->sReply }}</p>
</div>

<div class="mb-3">
    <p>Nếu bạn không dùng maill này để đăng ký với chúng tôi xin lỗi vì đã làm phiền</p>
</div>