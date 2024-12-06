<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Thêm thể loại truyện</div>
                @guest
                    <div class="card-body">
                        @include('layouts.404_traiphep')
                    </div>
                @else
                    @auth
                        @if (Auth::user()->sRole == 'admin')
                            <div class="card-body" style="background-color: #fff5e6; border: 1px solid #f7d9c4;">



                                <form method="POST" class="ntp_cat_create" action="{{ route('Categories.store') }}">
                                    @csrf
                                    <div class="alert alert-success ntp_hidden" role="alert"></div>
                                    <div class="alert alert-danger ntp_hidden" role="alert"></div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{old('tentheloai')}}" name="tentheloai" id="floatingInput"
                                            placeholder="Tên thể loại">
                                        <label for="floatingInput">Tên thể loại</label>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" placeholder="Leave a comment here" name="motatheloai" id="floatingTextarea"
                                            style="height: 300px;">{{old('motatheloai')}}</textarea>
                                        <label for="floatingTextarea">Mô tả</label>

                                    </div>

                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" name="trangthai"
                                            aria-label="Floating label select example">
                                            <option selected value="1">Kích hoạt</option>
                                            <option value="0">Vô hiệu hóa</option>
                                        </select>
                                        <label for="floatingSelect">Trạng thái hoạt động</label>
                                    </div>
                                    <button type="button" class="btn btn-primary ntp_btn_cat_create">Thêm mới</button>
                                </form>

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
</div>