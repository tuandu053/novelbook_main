@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- @php var_dump($novel); @endphp --}}
            <div class="col-md-12 mb-5">
                @include('single.thongtintruyen')
            </div>

            <div class="col-md-12 mb-5">
                @include('single.single_mucluc')
            </div>

            <div class="col-md-12 mb-5">
                {{-- truyện được đánh dấu nhiều --}}
                @include('home_template.truyenmoicapnhat')
            </div>

            <div class="col-md-12 mb-5">
                <div class="card ntp_review_wrap" id="ntp_review" style="background: transparent; backdrop-filter: blur(4px);">
                    <div class="card-header fw-bold text-warning  ">Bình luận đánh giá</div>
                    <div class="card-body">
                        <div class="card mb-4 fw-bold " style="background: transparent; backdrop-filter: blur(4px);">
                            <div class="card-header fw-bold text-warning" >Viết bình luận</div>
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="d-flex flex-start w-100 gap-3">
                                        <?php  
                                            $avatar = (Auth::check() && Auth::user()->sAvatar != '')? Auth::user()->sAvatar:'default-avatar-photo.jpg';
                                        ?>
                                        <img class="ntp_av_review rounded-circle shadow-1-strong ntp_av" width="65" height="65"src="{{ asset('uploads/user_av/'.$avatar) }}" alt="{{$avatar}}">
                                        <div class="w-100">
                                            <ul class="ntp_novel_rating mb-3 list-inline d-flex gap-2" data-mdb-toggle="rating">
                                                <li><i class="far fa-star fa-sm text-warning rating-start" data-point="1" title="Bad"></i></li>
                                                <li><i class="far fa-star fa-sm text-warning rating-start" data-point="2" title="Poor"></i></li>
                                                <li><i class="far fa-star fa-sm text-warning rating-start" data-point="3" title="OK"></i></li>
                                                <li><i class="far fa-star fa-sm text-warning rating-start" data-point="4" title="Good"></i></li>
                                                <li><i class="far fa-star fa-sm text-warning rating-start" data-point="5" title="Excellent"></i></li>
                                            </ul>
                                            <form id="ntp_rating_form" action="{{route('Comment.danhgia_novel',[$novel->id])}}" method="post">
                                                <div class="alert alert-success ntp_hidden" role="alert"></div>
                                                <div class="alert alert-danger ntp_hidden" role="alert"></div>
                                                <input type="nummber" class="ntp_hidden rating_start_input" name="ntp_point">
                                                <div data-mdb-input-init class="form-outline mb-3">
                                                    <textarea class="form-control" name="ntp_comment" rows="4" placeholder="viết bình luận đánh giá của bạn vào đây.."></textarea>
                                                </div>
                                                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-success ntp_submit_comment">
                                                    Đăng <i class="fa-solid fa-paper-plane ms-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('single.single_review')
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="ntp_reply_comment" aria-hidden="true" aria-labelledby="ntp_reply_commentLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ntp_reply_commentLabel">Phản hồi bình luận</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="ntp_rating_reply_form"  action="" method="post">
                    <div class="alert alert-success ntp_hidden" role="alert"></div>
                    <div class="alert alert-danger ntp_hidden" role="alert"></div>
                    <div data-mdb-input-init class="form-outline mb-3">
                        <textarea class="form-control" name="ntp_comment" rows="4" placeholder="viết phản hồi đánh giá của bạn vào đây.."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary ntp_comment_reply_submit">Gửi phản hồi</button>
            </div>
          </div>
        </div>
      </div>
        <div class="modal fade" id="ntp_edit_comment" aria-hidden="true" aria-labelledby="ntp_edit_commentLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ntp_edit_commentLabel">Chỉnh sửa bình luận phản hồi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="ntp_update_rating_reply_form"  action="" method="post">
                    <div class="alert alert-success ntp_hidden" role="alert"></div>
                    <div class="alert alert-danger ntp_hidden" role="alert"></div>
                    <div data-mdb-input-init class="form-outline mb-3">
                        <textarea class="form-control" name="ntp_comment_update" rows="4" placeholder="viết phản hồi đánh giá của bạn vào đây.."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary ntp_update_comment_reply_submit">Cập nhật</button>
            </div>
          </div>
        </div>
      </div>
@endsection