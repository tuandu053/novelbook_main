<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fw-bold d-flex justify-content-between align-items-center">Đăng ký 
                    <button type="button" class="btn btn-secondary p-0 fs-2 d-flex rounded-circle bg-transparent border-0" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <div class="card-body">
                    <form method="POST" id="ntp_register_form" action="{{ route('register') }}">
                        @csrf
                        <div class="alert alert-success ntp_default ntp_hidden" role="alert"></div>
                        <div class="alert alert-danger ntp_default ntp_hidden" role="alert"></div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Tên người dùng</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email_register" class="col-md-4 col-form-label text-md-end">Địa chỉ email</label>

                            <div class="col-md-6">
                                <input id="email_register" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_register" class="col-md-4 col-form-label text-md-end">Mật khẩu</label>

                            <div class="col-md-6 ntp_pass_wrap">
                                <input id="password_register" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <a href="javascript:void(0);" class="ntp-show-hide-pass text-success"><i class="fa-solid fa-eye"></i></a>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Xác nhận mật khẩu</label>

                            <div class="col-md-6 ntp_pass_wrap">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <a href="javascript:void(0);" class="ntp-show-hide-pass text-success"><i class="fa-solid fa-eye"></i></a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <a class="btn btn-link p-0" href="#" data-bs-target="#carouselExampleControls" data-bs-slide="next"> Đăng nhập </a>
                            </div>
                            
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary ntp_submit_register">
                                    Đăng ký
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>