

<div class="user_infor">
    
</div>
<form method="POST" id="ntp_form_admin_report_update" action="{{ route('Report.update_report_admin', [$report->id]) }}">
    <div class="alert alert-success ntp_hidden" role="alert"></div>
    <div class="alert alert-danger ntp_hidden" role="alert"></div>
    <div class="mb-3">
        <label class="small mb-1" for="report_title">Tiêu đề tố cáo:</label><span> {{$report->sTitle }}</span>
    </div>

    <div class="mb-3">
        <label class="small mb-1">Nội dung tố cáo</label>
        <div>{{$report->sContent}}</div>
    </div>

    <div class="mb-3">
        <label class="small mb-1">Nội dung phản hồi</label>
        <textarea name="report_reply" id="report_reply" rows="10" maxlength="3000" class="w-100">{{ $report->sReply }}</textarea>
    </div>

    <select class="form-select" aria-label="Default select example" name="report_status" id="">
        <option <?php echo($report->iStatus== 0 ? 'selected':'');?> value="0">Chưa xử lý</option>
        <option <?php echo($report->iStatus== 1 ? 'selected':'');?> value="1">Đã xử lý</option>
        <option <?php echo($report->iStatus== 3 ? 'selected':'');?> value="3">Từ chối xử lý</option>
    </select>
</form>
