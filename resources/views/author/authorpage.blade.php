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
                            @if ($user->sRole == 'user')
                                <div class="card">
                                    <div class="card-header fw-bold">Bạn chưa là tác giả bạn cần đăng ký tác giả trước</div>

                                    <div class="card-body">
                                        @include('author.authorpage_infor')
                                    </div>

                                </div>
                            @else
                                <div class="card">
                                    <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">

                                        <div id="pills-tab" role="tablist">
                                            <div class="btn-group ntp_dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                    aria-expanded="false">Quản lý thông tin
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                                    <li>
                                                        <button class="active dropdown-item" id="author_infor-tab"
                                                            data-bs-toggle="pill" data-bs-target="#author_infor" type="button"
                                                            role="tab" aria-controls="author_infor"
                                                            aria-selected="true"><?php echo $author_found == 1 && $author->iStatus == 1 ? 'Thông tin tác giả' : 'Xin cấp quyền tác giả'; ?></button>
                                                    </li>
                                                    @if ($author_found == 1 && $author->iStatus == 1)
                                                        <li>
                                                            <button class="dropdown-item" id="rut_tien-tab"
                                                                data-bs-toggle="pill" data-bs-target="#rut_tien" type="button"
                                                                role="tab" aria-controls="rut_tien" aria-selected="false">Rút
                                                                tiền</button>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            @if (($author_found == 1 && $author->iStatus == 1) || ($user->sRole = 'admin' && $author_found == 1))
                                                <div class="btn-group ntp_dropdown">
                                                    <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                                        aria-expanded="false"> Quản lý truyện
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-menu-lg-end">
                                                        <li>
                                                            <button class="dropdown-item" id="danhsach_truyen-tab"
                                                                data-bs-toggle="pill" data-bs-target="#danhsach_truyen"
                                                                type="button" role="tab" aria-controls="danhsach_truyen"
                                                                aria-selected="false"
                                                                data-link="{{ route('Novel.Danh_sachtruyen_tacgia') }}">Truyện của
                                                                tôi</button>
                                                        </li>
                                                        <li>
                                                            <button class="dropdown-item" id="thongke_baocao-tab"
                                                                data-bs-toggle="pill" data-bs-target="#thongke_baocao"
                                                                type="button" role="tab" aria-controls="thongke_baocao"
                                                                aria-selected="false">Thống kê báo cáo</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="card-body" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                                        <div class="tab-content" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="author_infor" role="tabpanel"
                                                aria-labelledby="author_infor-tab">
                                                <div class="card">
                                                    <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Thông tin tác giả</div>

                                                    <div class="card-body" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">
                                                        @include('author.authorpage_infor')
                                                    </div>

                                                </div>
                                            </div>
                                            @if (($author_found == 1 && $author->iStatus == 1) || ($user->sRole = 'admin' && $author_found == 1))
                                                <div class="tab-pane fade" id="thongke_baocao" role="tabpanel"
                                                    aria-labelledby="thongke_baocao-tab">
                                                   

                                                    <div class="row gx-3 mb-3">
                                                        <form method="POST" class="row col-md-10" action="{{route('Author.baocao_thongke')}}" id="author_form_thongke">
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
                                                            <button class="btn btn-outline-success w-100 mt-3 btn_get_thongke" data-form="#author_form_thongke" target=".ntp_author_thongke">Lập báo cáo</button>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="container-xl p-0 mb-3" id="author_static">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="card mb-4 mb-xl-0">
                                                                    <div class="card-header fw-bold">Ảnh đại diện</div>
                                                                    <div class="card-body ntp_av_wrap_thongke text-center">
                                                                        <?php
                                                                        $avatar = Auth::user()->sAvatar != '' ? Auth::user()->sAvatar : 'default-avatar-photo.jpg';
                                                                        ?>
                                                                        <img class="ntp_av rounded-circle mb-2" src="{{ asset('uploads/user_av/' . $avatar) }}" alt="{{$avatar}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md  -8">
                                                                <!-- Account details card-->
                                                                <div class="card mb-4">
                                                                    <div class="card-header fw-bold">Thông tin chi tiết tác giả</div>
                                                                    <div class="card-body">
                                                                            <div class="mb-3">
                                                                                <label class="small mb-1" for="inputUsername">Tên: </label><span>{{ ' '.Auth::user()->name }}</span>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="small mb-1" for="inputEmailAddress">Email:  </label><span>{{ ' '.Auth::user()->email }}</span>
                                                                            </div>
                                                                            <div class="row gx-3 mb-3">
                                                                                <div class="col-md-6">
                                                                                    <label class="small mb-1" for="inputBirthday">Ngày sinh: </label><span>{{ ' '.Auth::user()->dBirthday }}</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label class="small mb-1" for="inputLocation">Giới tính: </label> <span> {{ ' '.(Auth::user()->sGender == 'nam' ? 'Nam' : 'Nữ') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="small mb-1" for="inputLocation">Địa chỉ: </label><span>{{ ' '.Auth::user()->sAdress }}</span>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="small mb-1" for="inputLocation">Bút danh: </label><span>{{  ' '.$author->sNickName }}</span>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="small mb-1" for="inputLocation">Mô tả: </label><div>{{  ' '.$author->sDes }}</div>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header fw-bold d-flex justify-content-between">Nội dung báo cáo <a href="javascript:void(0);" class="ntp_hidden downloadReport"><i class="fa-solid fa-download"></i> Tải báo cáo</a></div>
                                                            <div class="card-body ntp_author_thongke text-center">
                                                                {{-- @include('author.thongke_baocao') --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="rut_tien" role="tabpanel"
                                                    aria-labelledby="rut_tien-tab">
                                                    @include('author.withdraw.author_withdraw')
                                                </div>
                                                <div class="tab-pane fade" id="danhsach_truyen" role="tabpanel"
                                                    aria-labelledby="danhsach_truyen-tab">
                                                    @include('author.novel.novel_infor')
                                                    <div id="ntp_novel_list_wrap"></div>
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                </div>
                            @endif
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
