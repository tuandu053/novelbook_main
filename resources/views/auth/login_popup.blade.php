<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fw-bold d-flex justify-content-between align-items-center">Đăng nhập
                    <button type="button" class="btn btn-secondary p-0 fs-2 d-flex rounded-circle bg-transparent border-0" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <div class="card-body">
                    <form id="ntp_login_form" action="{{ route('login') }}">
                        @csrf
                        <div class="alert alert-success ntp_default ntp_hidden" role="alert"></div>
                        <div class="alert alert-danger ntp_default ntp_hidden" role="alert"></div>
                        <div class="row mb-3">
                            <label for="email_login" class="col-md-4 col-form-label text-md-end">Tài khoản (Email)</label>

                            <div class="col-md-6">
                                <input id="email_login" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_login" class="col-md-4 col-form-label text-md-end">Mật khẩu</label>

                            <div class="col-md-6 ntp_pass_wrap">
                                <input id="password_login" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"><a href="javascript:void(0);" class="ntp-show-hide-pass text-success"><i class="fa-solid fa-eye"></i></a>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Ghi nhớ đăng nhập
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                            <a class="btn btn-link p-0" href="#" data-bs-target="#carouselExampleControls" data-bs-slide="prev"> Bạn chưa có tài khoản ? </a>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" class="btn ntp_submit_login btn-primary">
                                    Đăng nhập
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Quên mật khẩu
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
