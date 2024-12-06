<?
?>
<div class="card">
    <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px; ">
        <div id="pills-tab" role="tablist" class="d-flex flex-wrap">
            <button class="border-0 ntp_view_child active px-3 py-2 w-auto bg-transparent" id="user_report_list-tab"
                data-bs-toggle="pill" data-bs-target="#user_report_list" type="button" role="tab"
                aria-controls="user_report_list" aria-selected="true"  data-link="{{route('Report.bao_cao_list_user')}}"><i class="fa-solid fa-list"></i> Danh sách tố cáo của tôi</button>
        </div>

    </div>

    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="user_report_list" role="tabpanel"
                aria-labelledby="user_report_list-tab">
                <div class="user_reports">

                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade ntp_report_detail" id="ntp_report_detail" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ntp_report_detailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ntp_report_detailLabel">Chi tiết tố cáo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body pb-0">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary ntp_report_detail_update"><i class="fa-solid fa-paper-plane"></i> Cập nhật</button>
            </div>
        </div>
    </div>
</div>
