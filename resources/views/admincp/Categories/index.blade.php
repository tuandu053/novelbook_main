<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Danh sách thể loại truyện</div>
                @guest
                <div class="card-body">
                    @include('layouts.404_traiphep')
                </div>
            @else
                @auth
                    @if (Auth::user()->sRole == 'admin')
                    <div class="card-body overflow-auto ntp_custom_ver_scrollbar" style="height: 1000px; background-color: #fff5e6; border: 1px solid #f7d9c4;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    {{-- <th scope="col">Mã thể loại</th> --}}
                                    <th scope="col">Tên thể loại</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Ngày khởi tạo</th>
                                    <th scope="col">Cập nhật lần cuối</th>
                                    <th scope="col">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($cats as $key => $cat)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        {{-- <td>{{ $cat->id }}</td> --}}
                                        <td>{{ $cat->sCategories }}</td>
                                        <td>
                                            @if ($cat->iStatus == 1)
                                                <span class="text text-success">kích hoạt</span>
                                            @else
                                                <span class="text text-danger">Không kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>{{ ($cat->dCreateDay)->format('d-m-Y')}}</td>
                                        <td>{{ ($cat->dUpdateDay)->format('d-m-Y') }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary ntp_cat_edit" data-bs-toggle="modal" data-link="{{route('Categories.show',[$cat -> id])}}" data-bs-target="#ntp_edit_cat_ppoup"> Chi tiết</a>    
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
