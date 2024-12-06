<div class="ntp_footer py-3 mt-4 border-top" style="background: transparent; backdrop-filter: blur(4px);" >
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="{{ url('/') }}" class="nav-link px-2 text-muted"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted"><i class="fa-solid fa-address-book"></i> Liên hệ</a></li>
        <li class="nav-item"><a href="{{ url('/Huong-dan') }}" class="nav-link px-2 text-muted"><i class="fa-brands fa-glide"></i> Tài liệu hướng dẫn</a></li>
        
        @if(Auth::check())
            <li class="nav-item"><a class="nav-link px-2 text-muted" href="{{route('User.show', [Auth::user()->id,'view=user_report-tab']) }}"><i class="fa-solid fa-flag"></i> Tố cáo</a></li>
            <li class="nav-item"><a class="nav-link px-2 text-muted" href="{{ route('User.show', [Auth::user()->id]) }}"><i class="fa-solid fa-user"></i> Trang cá nhân</a></li>
        @endif
    </ul>
    <p class="text-center fw-bold text-light">© 2024 NovelBook - Đồ án - HOU</p>
    <p class="text-center fw-bold text-light">Đồ án website đọc tiểu thuyết (Novel) được thực hiện bởi bộ 3 Anh Tài ^^. Nhằm mục đích mang đến cho các bạn trẻ một nơi giải trí và cũng đề cao tinh thần trách nhiệm bản quyền </p>
    <div class="alert alert-success ntp_alert_public ntp_hidden" role="alert"></div>
    <div class="alert alert-danger ntp_alert_public ntp_hidden" role="alert"></div>
</div>
<div class="ntp_default_img" 
    data_img_novel_df="{{ asset('uploads/images/bookcover256.jpg') }}"
    data_img_av_df="{{ asset('uploads/user_av/default-avatar-photo.jpg') }}"    
></div>

<!-- Modal trigger button -->
<div class="ntp_popup_btn position-fixed bottom-0 end-0 translate-middle">
    @if(Auth::check() && Auth::user()->email_verified_at != null)
        <button type="button" class="btn btn-secondary btn-lg shadow-lg ntp_user_report mb-3" data-bs-toggle="modal" data-bs-target="#ntp_user_report">
            <i class="fa-solid fa-flag"></i>
        </button>
    @endif
    <button type="button" class="btn btn-secondary btn-lg shadow-lg ntp_user_seting" data-bs-toggle="modal" data-bs-target="#ntp_user_seting">
        <i class="fa-solid fa-user-gear"></i>
    </button>
    
</div>
@if(Auth::check() && Auth::user()->email_verified_at != null)
<div class="modal fade" id="ntp_user_report" tabindex="-1"data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content col-10">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Tố cáo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert ntp_default ntp_alert_static alert-success" role="alert">
                    <h4 class="alert-heading">NovelBook Xin chào {{Auth::user()->name}}!</h4>
                    <p>Vì để tránh trường hợp người dùng spam tố cáo gây quá tải hệ thống chúng tôi giới hạn mỗi người dùng chỉ có thể tố cáo 1 lần / ngày.</p>
                    <hr>
                    <p class="mb-0">Nếu có gì cần bổ sung bạn có thể thêm vào tố cáo của ngày hôm nay. NovelBook xin cám ơn bạn</p>
                </div>
                <form method="POST" id="ntp_form_user_report" action="{{ route('Report.bao_cao') }}">
                    <div class="alert alert-success ntp_hidden" role="alert"></div>
                    <div class="alert alert-danger ntp_hidden" role="alert"></div>
                    <div class="mb-3">
                        <label class="small mb-1" for="report_title">Tiêu đề tố cáo</label>
                        <input class="form-control" id="report_title" maxlength="255" name="report_title"
                            type="text" placeholder="Tiêu đề tố cáo là">
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1">Nội dung tố cáo</label>
                        <textarea name="content_report" id="content_report" rows="10" maxlength="3000" class="w-100"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Đóng
                </button>
                <button type="button" class="btn btn-primary ntp_btn_report">Lưu</button>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="ntp_user_seting" tabindex="-1"data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Cài đặt cá nhân
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (Auth::check())
                    <form action="{{ route('User.save_user_setting', [Auth::user()->id]) }}" id="ntp_form_user_seting" data-setting="{{Auth::user()->sSetup}}">
                @else
                    <form action="" id="ntp_form_user_seting" class="ntp_locall_store">
                @endif
                <div class="alert alert-success ntp_default ntp_hidden" role="alert"></div>
                <div class="alert alert-danger ntp_default ntp_hidden" role="alert"></div>
                <div class="mb-3">
                    <label for="ntp_font_set" class="form-label">Chọn font chữ</label>
                    <select id="ntp_font_set" name="ntp_font_set" class="form-select">
                        <option value="Georgia, serif">Georgia, serif</option>
                        <option value="Gill Sans, sans-serif">Gill Sans, sans-serif</option>
                        <option value="sans-serif">sans-serif</option>
                        <option value="serif">serif</option>
                        <option value="cursive">cursive</option>
                        <option value="system-ui">system-ui</option>
                    </select>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <label class="form-check-label" for="ntp_dark_mode"> Dark mode </label>
                        <input class="form-check-input" type="checkbox" id="ntp_dark_mode" />
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Đóng
                </button>
                <button type="button" class="btn btn-primary ntp_user_seting_save">Lưu</button>
            </div>
        </div>
    </div>
</div>


@guest
    <div class="modal fade" id="ntp_login_register_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="ntp_login_register_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body">
                    <div id="carouselExampleControls" class="carousel slide" data-interval="false">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                @if (Route::has('login'))
                                    @include('auth.login_popup')
                                @endif
                            </div>
                            <div class="carousel-item">

                                @if (Route::has('register'))
                                    @include('auth.register_popup')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary ntp_hidden ntp-cookie-ask-btn" data-bs-toggle="modal" data-bs-target="#ntp-cookie-ask"></button>
  
  <!-- Modal -->
  <div class="modal fade" id="ntp-cookie-ask" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ntp-cookie-ask-Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ntp-cookie-ask-Label">Quyền sử dung Cookie</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <p>Trang web này sử dụng cookie với mục đích lưu trữ thông tin lịch sử đọc, đánh đấu, cài đặt cá nhân để cung cấp cho bạn trải nghiệm phù hợp. <br> Để có trải nghiệm web tốt hơn hãy đông ý việc website sử dụng cookie.</p> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-ask="no" data-bs-dismiss="modal">Không đồng ý</button>
          <button type="button" class="btn btn-primary" data-ask="yes" data-bs-dismiss="modal">Đồng ý</button>
        </div>
      </div>
    </div>
  </div>
@endguest
