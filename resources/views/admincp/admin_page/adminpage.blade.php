@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">


                @guest
                    <div class="card-body">
                        @include('layouts.404_traiphep')
                    </div>
                @else
                    @auth
                        @if (Auth::user()->id == $user->id)
                            <div class="card">
                                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">

                                    <div class="btn-group d-flex flex-wrap" id="pills-tab" role="tablist">
                                        <div class="btn-group ntp_dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-layer-group"></i> Quản lý thể loại truyện
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                                <li>
                                                    <button class="dropdown-item" id="them_theoloai-tab" data-bs-toggle="pill"
                                                        data-bs-target="#them_theoloai" type="button" role="tab"
                                                        aria-controls="them_theoloai" aria-selected="false"><i
                                                            class="fa-solid fa-folder-plus"></i> Thêm thể loại</button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item active" id="danh_sach_theloai-tab"
                                                        data-bs-toggle="pill" data-bs-target="#danh_sach_theloai" type="button"
                                                        role="tab" aria-controls="danh_sach_theloai"
                                                        data-link="{{ route('Categories.index') }}" aria-selected="true"><i
                                                            class="fa-solid fa-list-ol"></i> Danh sách thể loại</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group ntp_dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa-solid fa-users-gear"></i> Quản lý nguời dùng
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                                <li>
                                                    <button class="dropdown-item" id="xet_duyet_tacgia-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xet_duyet_tacgia" type="button" role="tab"
                                                        aria-controls="xet_duyet_tacgia" aria-selected="false"
                                                        data-link="{{ route('Author.danhsach_xetduyet') }}"><i
                                                            class="fa-solid fa-users-line"></i> Danh sách tác giả</button>

                                                    <button class="dropdown-item" id="danh_sach_nguoi_dung-tab"
                                                        data-bs-toggle="pill" data-bs-target="#danh_sach_nguoi_dung" type="button"
                                                        role="tab" aria-controls="danh_sach_nguoi_dung" aria-selected="false"
                                                        data-link="{{ route('User.danh_sach_user') }}"><i
                                                            class="fa-solid fa-people-group"></i> Danh sách người dùng</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group ntp_dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-book"></i> Quản lý tác phẩm
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                                <li>
                                                    <button class="dropdown-item" id="xet_duyet_tacpham-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xet_duyet_tacpham" type="button" role="tab"
                                                        aria-controls="xet_duyet_tacpham" aria-selected="false"
                                                        data-link="{{ route('Novel.danhsach_xetduyet') }}"><i class="fa-solid fa-ballot"></i>
                                                         Danh sách tác phẩm</button>
                                                    <button class="dropdown-item" id="danh_sach_tac_pham_chua_duyet-tab" data-bs-toggle="pill"
                                                        data-bs-target="#danh_sach_tac_pham_chua_duyet" type="button" role="tab"
                                                        aria-controls="danh_sach_tac_pham_chua_duyet" aria-selected="false"
                                                        data-link="{{ route('Novel.danhsach_truyencochuongchuaduocxetduyet') }}"><i
                                                            class="fa-solid fa-check-to-slot"></i> Xét duyệt chương</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group ntp_dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-flag"></i> Quản lý tố cáo
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-lg-end">
                                                <li>
                                                    <button class="dropdown-item xu_ly_bao_cao_tab" id="xu_ly_bao_cao_0-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xu_ly_bao_cao_0" type="button" role="tab"
                                                        aria-controls="xu_ly_bao_cao_0" aria-selected="false"
                                                        data-link="{{ route('Report.bao_cao_list_admin', [0]) }}"><i class="fa-solid fa-circle-minus"></i> Tố cáo chưa xử lý</button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item xu_ly_bao_cao_tab" id="xu_ly_bao_cao_3-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xu_ly_bao_cao_3" type="button" role="tab"
                                                        aria-controls="xu_ly_bao_cao_3" aria-selected="false"
                                                        data-link="{{ route('Report.bao_cao_list_admin', [3]) }}"><i class="fa-solid fa-circle-xmark"></i> Tố cáo từ chối xử lý</button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item xu_ly_bao_cao_tab" id="xu_ly_bao_cao_1-tab" data-bs-toggle="pill"
                                                        data-bs-target="#xu_ly_bao_cao_1" type="button" role="tab"
                                                        aria-controls="xu_ly_bao_cao_1" aria-selected="false"
                                                        data-link="{{ route('Report.bao_cao_list_admin', [1]) }}"><i class="fa-solid fa-circle-check"></i> Tố cáo đã xử lý</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group ntp_dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa-solid fa-chart-simple"></i> Báo cáo thông kê
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-lg-end">
                                            <li>
                                                <button class="dropdown-item bao_cao_thong_ke_nap-tab" id="bao_cao_thong_ke_nap-tab" data-bs-toggle="pill"
                                                    data-bs-target="#bao_cao_thong_ke_nap" type="button" role="tab"
                                                    aria-controls="bao_cao_thong_ke_nap" aria-selected="false"
                                                    data-link=""><i class="fa-solid fa-file-invoice-dollar"></i> Báo cáo việc nạp tiền</button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item bao_cao_thong_ke_rut_tien-tab" id="bao_cao_thong_ke_rut_tien-tab"      
                                                    data-bs-toggle="pill"
                                                    data-bs-target="#bao_cao_thong_ke_rut_tien" type="button" role="tab"
                                                    aria-controls="bao_cao_thong_ke_rut_tien" aria-selected="false"
                                                    data-link=""><i class="fa-solid fa-file-invoice-dollar"></i> Báo cáo việc rút tiền</button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item bao_cao_thong_ke_author" id="bao_cao_thong_ke_author-tab" data-bs-toggle="pill"
                                                    data-bs-target="#bao_cao_thong_ke_author" type="button" role="tab"
                                                    aria-controls="bao_cao_thong_ke_author" aria-selected="false"
                                                    data-link=""><i class="fa-solid fa-person"></i> Báo cáo riêng tác giả</button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item bao_cao_thong_ke_web" id="bao_cao_thong_ke_web-tab" data-bs-toggle="pill"
                                                    data-bs-target="#bao_cao_thong_ke_web" type="button" role="tab"
                                                    aria-controls="bao_cao_thong_ke_web" aria-selected="false"
                                                    data-link=""><i class="fa-solid fa-globe"></i> Báo cáo tổng thể tất cả tác phẩm</button>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade" id="them_theoloai" role="tabpanel"
                                            aria-labelledby="them_theoloai-tab">
                                            @include('admincp.Categories.create')
                                        </div>
                                        <div class="tab-pane fade active show" id="danh_sach_theloai" role="tabpanel"
                                            aria-labelledby="danh_sach_theloai-tab">
                                        </div>
                                        <div class="tab-pane fade" id="xet_duyet_tacgia" role="tabpanel"
                                            aria-labelledby="xet_duyet_tacgia-tab">
                                            @include('admincp.admin_page.admin_xetduyet_tacgia')
                                        </div>
                                        <div class="tab-pane fade" id="danh_sach_nguoi_dung" role="tabpanel"
                                            aria-labelledby="danh_sach_nguoi_dung-tab">
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacgia') --}}
                                        </div>
                                        <div class="tab-pane fade" id="xet_duyet_tacpham" role="tabpanel"
                                            aria-labelledby="xet_duyet_tacpham-tab">
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacpham') --}}
                                        </div>
                                        <div class="tab-pane fade" id="danh_sach_tac_pham_chua_duyet" role="tabpanel"
                                            aria-labelledby="danh_sach_tac_pham_chua_duyet-tab">
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacpham') --}}
                                        </div>
                                        <div class="tab-pane fade" id="xu_ly_bao_cao_0" role="tabpanel"
                                            aria-labelledby="xu_ly_bao_cao_0-tab">
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacpham') --}}
                                        </div>
                                        <div class="tab-pane fade" id="xu_ly_bao_cao_1" role="tabpanel"
                                            aria-labelledby="xu_ly_bao_cao_1-tab">
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacpham') --}}
                                        </div>
                                        <div class="tab-pane fade" id="xu_ly_bao_cao_3" role="tabpanel"
                                            aria-labelledby="xu_ly_bao_cao_3-tab">
                                            {{-- @include('admincp.admin_page.admin_xetduyet_tacpham') --}}
                                        </div>
                                        <div class="tab-pane fade" id="bao_cao_thong_ke_nap" role="tabpanel"
                                            aria-labelledby="bao_cao_thong_ke_nap-tab">
                                            <div class="row gx-3 mb-3">
                                                <form method="POST" class="row col-md-10" action="{{route('Report.thongke_nap')}}" id="admin_form_thongke_nap">
                                                    <div class="alert alert-success ntp_hidden" role="alert"></div>
                                                    <div class="alert alert-danger ntp_hidden" role="alert"></div>
                                                    <div class="col-md-12">
                                                        <label class="small mb-1 text-danger">Nếu bạn không chọn ngày thì hệ thống sẽ thống kê tất cả dữ liệu từ trước đến nay</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="Ngay_batdau">Ngày bắt đầu báo cáo</label>
                                                        <input class="form-control" id="Ngay_batdau" type="date" name="Ngay_batdau" placeholder="Chọn ngày bạn muốn bắt đầu báo cáo">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="Ngay_ketthuc">Ngày kết thúc báo cáo</label>
                                                        <input class="form-control" id="Ngay_ketthuc" type="date" name="Ngay_ketthuc" placeholder="Chọn ngày bạn muốn kết thúc báo cáo">
                                                    </div>
                                                </form>
                                                <div class="col-md-2 d-lg-flex align-content-end flex-wrap">
                                                    <button class="btn btn-outline-success w-100 mt-3 btn_get_thongke" data-form="#admin_form_thongke_nap"  target=".ntp_admin_thongke_nap">Lập báo cáo</button>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header fw-bold d-flex justify-content-between">Nội dung báo cáo <a href="javascript:void(0);" class="ntp_hidden downloadReport"><i class="fa-solid fa-download"></i> Tải báo cáo</a></div>
                                                <div class="card-body ntp_admin_thongke_nap text-center">
                                                    {{-- @include('author.thongke_baocao') --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="bao_cao_thong_ke_rut_tien" role="tabpanel"
                                        aria-labelledby="bao_cao_thong_ke_rut_tien-tab">
                                            <div class="row gx-3 mb-3">
                                                <form method="POST" class="col-md-10" action="{{route('Report.thongke_ruttien')}}" id="admin_form_thongke_rut_tien">
                                                    <div class="alert alert-success ntp_hidden" role="alert"></div>
                                                    <div class="alert alert-danger ntp_hidden" role="alert"></div>
                                                    <div class="col-md-12">
                                                        <label class="small mb-1 text-danger">Nếu bạn không chọn tháng bạn muốn báo cáo thì hệ thống sẽ lấy tháng hiện tại làm mặc định</label>
                                                    </div>
                                                    <div class="">
                                                        <label class="small mb-1" for="Thang_bao_cao">Tháng bạn muốn báo cáo</label>
                                                        <input class="form-control" id="Thang_bao_cao" type="date" name="Thang_bao_cao" placeholder="Chọn ngày bạn muốn bắt đầu báo cáo">
                                                    </div>
                                                </form>
                                                <div class="col-md-2 d-lg-flex align-content-end flex-wrap">
                                                    <button class="btn btn-outline-success w-100 mt-3 btn_get_thongke" data-form="#admin_form_thongke_rut_tien"  target=".ntp_admin_thongke_rut_tien">Lập báo cáo</button>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header fw-bold d-flex justify-content-between">Nội dung báo cáo <a href="javascript:void(0);" class="ntp_hidden downloadReport"><i class="fa-solid fa-download"></i> Tải báo cáo</a></div>
                                                <div class="card-body ntp_admin_thongke_rut_tien text-center">
                                                    {{-- @include('author.thongke_baocao') --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="bao_cao_thong_ke_author" role="tabpanel" 
                                            aria-labelledby="bao_cao_thong_ke_author-tab"> 
                                            <form method="POST" class="row" action="{{route('Report.thongke_tacgia')}}" id="admin_form_thongke_tacgia">
                                                <div class="alert alert-success ntp_hidden" role="alert"></div>
                                                <div class="alert alert-danger ntp_hidden" role="alert"></div>
                                                <div class="col-md-12">
                                                    <label class="small mb-1 text-danger">Nếu bạn không chọn ngày thì hệ thống sẽ thống kê tất cả dữ liệu từ trước đến nay</label>
                                                </div>
                                                <div class="col-md-12 timkiem_tacgia_wrap">
                                                    <label class="small mb-1" for="Tim_kiemtacgia">TÌm kiếm tác giả</label>
                                                    <input class="form-control admin_search_tacgia" id="Tim_kiemtacgia" data-link="{{route('Author.Tim_kiem_tacgia','')}}" type="text" name="tac_gia" placeholder="Tìm kiếm tác giả bạn buốn lập báo cáo (bút danh)">
                                                    <div class="card ntp_drop_down_search_author">
                                                        <div class="card-header">
                                                          Kết quả tìm kiếm
                                                        </div>
                                                        <div class="card-body">
                                                          
                                                        </div>
                                                      </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="small mb-1" for="Ngay_batdau">Ngày bắt đầu báo cáo</label>
                                                    <input class="form-control" id="Ngay_batdau" type="date" name="Ngay_batdau" placeholder="Chọn ngày bạn muốn bắt đầu báo cáo">
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="small mb-1" for="Ngay_ketthuc">Ngày kết thúc báo cáo</label>
                                                    <input class="form-control" id="Ngay_ketthuc" type="date" name="Ngay_ketthuc" placeholder="Chọn ngày bạn muốn kết thúc báo cáo">
                                                </div>
                                                <div class="col-md-2 d-lg-flex align-content-end flex-wrap">
                                                    <a class="btn btn-outline-success w-100 mt-3 btn_get_thongke" data-form="#admin_form_thongke_tacgia" target=".ntp_admin_thongke_tacgia">Lập báo cáo</button>
                                                    </a>
                                                </div>
                                            </form>

                                               
                                            <div class="card mt-3">
                                                <div class="card-header fw-bold d-flex justify-content-between">Nội dung báo cáo <a href="javascript:void(0);" class="ntp_hidden downloadReport"><i class="fa-solid fa-download"></i> Tải báo cáo</a></div>
                                                <div class="card-body ntp_admin_thongke_tacgia text-center">
                                                    {{-- @include('author.thongke_baocao') --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="bao_cao_thong_ke_web" role="tabpanel" 
                                            aria-labelledby="bao_cao_thong_ke_web-tab"> 
                                            <div class="row gx-3 mb-3">
                                                <form method="POST" class="row col-md-10" action="{{route('Report.thongke_tacpham')}}" id="admin_form_thongke_tacpham">
                                                    <div class="alert alert-success ntp_hidden" role="alert"></div>
                                                    <div class="alert alert-danger ntp_hidden" role="alert"></div>
                                                    <div class="col-md-12">
                                                        <label class="small mb-1 text-danger">Nếu bạn không chọn ngày thì hệ thống sẽ thống kê tất cả dữ liệu từ trước đến nay</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="Ngay_batdau">Ngày bắt đầu báo cáo</label>
                                                        <input class="form-control" id="Ngay_batdau" type="date" name="Ngay_batdau" placeholder="Chọn ngày bạn muốn bắt đầu báo cáo">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="Ngay_ketthuc">Ngày kết thúc báo cáo</label>
                                                        <input class="form-control" id="Ngay_ketthuc" type="date" name="Ngay_ketthuc" placeholder="Chọn ngày bạn muốn kết thúc báo cáo">
                                                    </div>
                                                </form>
                                                <div class="col-md-2 d-lg-flex align-content-end flex-wrap">
                                                    <button class="btn btn-outline-success w-100 mt-3 btn_get_thongke" data-form="#admin_form_thongke_tacpham"  target=".ntp_admin_thongke_tacpham">Lập báo cáo</button>
                                                </div>
                                            </div>
                                            <div class="card mt-3">
                                                <div class="card-header fw-bold d-flex justify-content-between">Nội dung báo cáo <a href="javascript:void(0);"  class="ntp_hidden downloadReport"><i class="fa-solid fa-download"></i> Tải báo cáo</a></div>
                                                <div class="card-body ntp_admin_thongke_tacpham text-center">
                                                    {{-- @include('author.thongke_baocao') --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade ntp_edit_cat_ppoup" id="ntp_edit_cat_ppoup" data-bs-keyboard="false"
                                        tabindex="-1" aria-labelledby="ntp_edit_cat_ppoupLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ntp_edit_cat_ppoupLabel">Chỉnh sửa thể loại</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="button" class="btn btn-primary ntp_btn_update_cat">Sửa</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade ntp_author_detail" id="ntp_author_detail" data-bs-keyboard="false"
                                        tabindex="-1" aria-labelledby="ntp_author_detailLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ntp_author_detailLabel">Đơn xin xét duyệt quyền
                                                        tác giả của <span id="ntp_name"></span></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body pb-0">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                    <button type="button" class="btn btn-primary ntp_author_detail_update">Cập
                                                        nhật</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade ntp_edit_novel_poup" id="ntp_edit_novel_poup" data-bs-keyboard="false"
                                        tabindex="-1" aria-labelledby="ntp_edit_novel_poupLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ntp_edit_novel_poupLabel">Chỉnh sửa tiểu thuyết
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body pb-0">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="button" class="btn btn-primary ntp_admin_btn_update_novel">Xác
                                                        thực</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade ntp_report_detail admin_update" id="ntp_report_detail" data-bs-keyboard="false"
                                        tabindex="-1" aria-labelledby="ntp_report_detailLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ntp_report_detailLabel">Chi tiết tố cáo</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                    <button type="button" class="btn btn-primary ntp_report_admin_detail_update"><i
                                                            class="fa-solid fa-paper-plane"></i> Cập nhật</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        @else
                            <div class="card-body">
                                @include('layouts.404_traiphep')
                            </div>
                        @endif


                    @endauth
                @endguest
            </div>
        </div>
    </div>
@endsection
