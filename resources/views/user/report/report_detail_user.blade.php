@if($report->iStatus != 1)
    <form method="POST" id="ntp_form_user_report_update" action="{{ route('Report.update_report_user',[$report->id]) }}">
        <div class="alert alert-success ntp_hidden" role="alert"></div>
        <div class="alert alert-danger ntp_hidden" role="alert"></div>
        <div class="mb-3">
            <label class="small mb-1" for="report_title"><strong>Tiêu đề tố cáo: </strong></label>
            <input class="form-control" id="report_title" maxlength="255" name="report_title"
                type="text" value="{{$report->sTitle}}" placeholder="Tiêu đề tố cáo là">
        </div>

        <div class="mb-3">
            <label class="small mb-1"><strong>Nội dung tố cáo: </strong></label>
            <textarea name="content_report" id="content_report" rows="10" maxlength="3000" class="w-100">{{$report->sContent}}</textarea>
        </div>

        @if($report->iStatus != 0)
            <div class="mb-3">
                @php
                $class = 'alert-success';
                    if($report->iStatus == 3) {
                        $class = 'alert-danger';
                    } elseif ($report->iStatus == 1) {
                        $class = 'alert-success';
                    }
                @endphp
                <label class="small mb-1"><Strong>Nội dung phản hồi: </Strong></label>
                <div class="alert ntp_default ntp_alert_static {{ $class}}" >{!!$report->sReply!!}</div>
            </div>
        @endif
    </form>
@else
    <div class="mb-3">
        <label class="small mb-1"><strong>Nội dung tố cáo:</strong></label>
        <div>{{$report->sContent}}</div>
    </div>

    <div class="mb-3">
        @php
        $class = 'alert-success';
            if($report->iStatus == 3) {
                $class = 'alert-danger';
            } elseif ($report->iStatus == 1) {
                $class = 'alert-success';
            }
        @endphp
        <label class="small mb-1"><Strong>Nội dung phản hồi: </Strong></label>
        <div class="alert ntp_default ntp_alert_static {{ $class}}" >{!!$report->sReply!!}</div>
    </div>
@endif