<nav class="ntp_nav navbar navbar-expand-lg  bg-body shadow-sm ">
    <div class="container col-md-11 justify-content-between">
        <div>

        </div>
        <a class="navbar-brand" href="{{ url('/') }}"><img class="ntp_logo me-2"
            src="{{ asset('uploads/logo/Logo.jpg') }}" alt="">
            <span class="ntp_title ">NovelBook</span> 
                @if (isset($isadmin) && $isadmin)
                - Admin
                @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 d-flex align-items-center">
                <!-- <li class="nav-item ms-auto">
                    <a class="nav-link d-flex align-items-center gap-2 flex-wrap h-100" href="{{ url('/Gioi-thieu') }}"><i class="fa-solid fa-newspaper"></i> Giới thiệu</a>
                </li>
                <li class="nav-item ms-auto">
                    <a class="nav-link d-flex align-items-center gap-2 flex-wrap h-100" href="{{ url('/Lien-he') }}"><i class="fa-solid fa-address-book"></i> Liên hệ</a>
                </li>-->
                
                @guest
                    <li class="nav-item">
                        <a class="nav-link d-flex gap-2 align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#ntp_login_register_modal"><i class="fa-regular fa-user"></i>Đăng nhập / Đăng ký</a>
                    </li>
                @else
                    <li class="nav-item dropdown ntp_dropdown">
                        <a id="navbarDropdown" class="ntp_user_loged nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                            <div class="ntp_av_nav overflow-hidden rounded-circle">
                                <?php  
                                    $avatar = Auth::user()->sAvatar != ''? Auth::user()->sAvatar:'default-avatar-photo.jpg';
                                ?>
                                <img class="ntp_av_nav ntp_av" src="{{ asset('uploads/user_av/'.$avatar) }}" alt="{{$avatar}}">
                            </div>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg-end dropdown-menu dropdown-menu-lg-end-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                            </a>

                            <a class="dropdown-item" href="{{ route('User.show', [Auth::user()->id]) }}"><i class="fa-solid fa-user"></i> Trang cá nhân</a>

                            <a class="dropdown-item" href="{{route('User.show', [Auth::user()->id,'view=user_bill-tab']) }}"><i class="fa-solid fa-coins"></i> Ví tiền và hóa đơn</a>

                            @if (Auth::user()->email_verified_at == null)
                                <a class="dropdown-item" href="{{ route('verification.notice')}}"><i class="fa-solid fa-envelope"></i> Xác thực email</a>
                            @else
                                <a class="dropdown-item" href="{{route('User.show', [Auth::user()->id,'view=user_report-tab']) }}"><i class="fa-solid fa-flag"></i> Tố cáo</a>
                                @if (Auth::user()->sRole == 'admin')
                                    <a class="dropdown-item" href="{{ route('User.admin',[Auth::user()->id])}}"><i class="fa-solid fa-user-tie"></i> Trang quản trị</a>
                                @endif

                                <a class="dropdown-item" href="{{ route('Author.show',[Auth::user()->id])}}"><i class="fa-solid fa-pen-nib"></i> Trang tác giả</a>
                            @endif
                        
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>