<?php

use App\Models\User;
use App\Models\Author;
use App\Models\Novel;
use App\Models\Chapter;

$novels = Novel::orderBy('id', 'DESC')->get();
$title = 'Danh sách truyện';

?>

<div class="container" id="ntp_admin_novel_list_wrap">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px;">{{ $title }}</div>
                @guest
                    <div class="card-body">
                        @include('layouts.404_traiphep')
                    </div>
                @else
                    @auth
                        @if (Auth::user()->sRole == 'admin')
                            <div class="card-body overflow-auto ntp_custom_ver_scrollbar" style="height: 1000px; background-color: #fff5e6; border: 1px solid #f7d9c4;">
                                <table class="table table-hover ntp_novel_list">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tên truyện</th>
                                            <th scope="col">Tác giả</th>
                                            <th scope="col">Ngày khởi tạo</th>
                                            <th scope="col">Số chương chưa qua kiểm duyệt</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Trạng thái xét duyệt</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($novels as $key => $novel)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td class="name">{{ $novel->sNovel }}</td>
                                                <td>
                                                    <?php
                                                    $author = Author::where('idUser', $novel->idUser)->first();
                                                    echo $author? $author->sNickName : null;
                                                    ?>
                                                </td>
                                                <td>{{ $novel->dCreateDay }}</td>
                                                <td>
                                                    <?php
                                                    $un_Publish_chapter_count = Chapter::where('idNovel', $novel->id)
                                                        ->where('iPublishingStatus', 0)
                                                        ->get()
                                                        ->count();
                                                    $chapter_count = Chapter::where('idNovel', $novel->id)
                                                        ->get()
                                                        ->count();
                                                    echo '<span class="text text-danger">' . $un_Publish_chapter_count . '</span> / ' . $chapter_count;
                                                    ?>
                                                </td>
                                                <td>
                                                    @if ($novel->iStatus == 1)
                                                        <span class="text text-success">Đăng tải</span>
                                                    @else
                                                        <span class="text text-danger">Gỡ bỏ</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($novel->iLicense_Status == 0)
                                                        <span class="text text-warning">Chưa xét duyệt</span>
                                                    @elseif ($novel->iLicense_Status == 1)
                                                        <span class="text text-success">Xét duyệt thành công</span>
                                                    @elseif ($novel->iLicense_Status == 3)
                                                        <span class="text text-danger">Xét duyệt thất bại</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="btn-group ntp_dropdown">
                                                        <button type="button" class="btn dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-align-justify"></i> Tác vụ quản lý
                                                            truyện </button>
                                                        <ul class="dropdown-menu dropdown-menu-lg-end">
                                                            <li>
                                                                <a class="dropdown-item ntp_chitiettruyen"
                                                                    data-bs-toggle="modal" data-bs-target="#ntp_edit_novel_poup"
                                                                    href="javascript:void(0);"
                                                                    data-link="{{ route('Novel.chi_tiet_truyen', [$novel->id]) }}"><i class="fa-solid fa-toolbox"></i> Quản lý truyện</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('Novel.page_kiem_duyet_chuong', [$novel->id]) }}"> <i class="fa-solid fa-file-circle-check"></i> Kiểm duyệt chương</a>
                                                            </li>
                                                        </ul>
                                                    </div>


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
