<?php

use App\Models\User;
use App\Models\Author;

$authors = Author::orderBy('id', 'DESC')->get();

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">Danh sách người dùng xin cấp quyền tác giả</div>
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
                                            {{-- <th scope="col">Mã người dùng</th> --}}
                                            <th scope="col">Tên người dùng</th>
                                            <th scope="col">Bút danh đăng ký</th>
                                            <th scope="col">Ngày xin cấp</th>
                                            <th scope="col">Tình trạng xét duyệt</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                    foreach ($authors as $key => $author) {
                                        $user = User::find($author->idUser);
                                        ?>
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            {{-- <td>{{ $author->idUser }}</td> --}}
                                            <td>{{ $user->name }}</td>
                                            <td >{{ $author->sNickName }}</td>
                                            <td>{{ $author->dCreateDay }}</td>
                                            <td>
                                                @if($author->iStatus == 0)
                                                    <span class="text text-warning">Chưa xét duyệt</span>
                                                @elseif ($author->iStatus == 1)
                                                    <span class="text text-success">Xét duyệt thành công</span>
                                                @elseif ($author->iStatus == 3)
                                                    <span class="text text-danger">Xét duyệt bị từ chối</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary ntp_btn_author_detail" data-bs-toggle="modal" data-bs-target="#ntp_author_detail"
                                                    data-link="{{ route('Author.edit', [$author->id]) }}"
                                                    > Chi tiết</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>
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
