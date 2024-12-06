<?php

use App\Models\User;
use App\Models\Author;
use App\Models\Novel;
use App\Models\Chapter;

?>

<div class="container" id="ntp_admin_user_list_wrap">
    <div class="alert alert-success ntp_hidden" role="alert"></div>
    <div class="alert alert-danger ntp_hidden" role="alert"></div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold" style="background-color: #ffe6cc; color: #d35400; padding: 12px; ">Danh sách người dùng</div>
                @guest
                    <div class="card-body">
                        @include('layouts.404_traiphep')
                    </div>
                @else
                    @auth
                        @if (Auth::user()->sRole == 'admin')
                            <div class="card-body overflow-auto ntp_custom_ver_scrollbar" style="height: 1000px; background-color: #fff5e6; border: 1px solid #f7d9c4;">
                                <table class="table table-hover ntp_user_list">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Avarta</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Quyền</th>
                                            <th scope="col">kích hoạt tài khoản</th>
                                            <th scope="col">khóa bình luận</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            @if ($user->id !== Auth::user()->id)
                                                <?php
                                                $avtar = $user->sAvatar != '' ? $user->sAvatar : 'default-avatar-photo.jpg';
                                                ?>
                                                <tr class="ntp_user_wrap">
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td class="avrtar"> <img class="ntp_av shadow-lg rounded-5"
                                                            src="{{ asset('uploads/user_av/' . $avtar) }}" alt="{{$avtar}}"></td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        <select
                                                            data-link="{{ route('User.cap_quyen_user', [$user->id]) }}"
                                                            name="admin_user_role" class="admin_user_role_sl">
                                                            <option <?php echo $user->sRole == 'admin' ? 'selected' : ''; ?> value="admin">admin</option>
                                                            <option <?php echo $user->sRole == 'author' ? 'selected' : ''; ?> value="author">author</option>
                                                            <option <?php echo $user->sRole == 'user' ? 'selected' : ''; ?> value="user">user</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-switch p-0 w-auto d-flex justify-content-center align-content-center">
                                                            <input 
                                                                data-link="{{ route('User.khoa_user', [$user->id]) }}"
                                                                class="form-check-input admin_user_status position-static m-0"
                                                                type="checkbox"
                                                                name="admin_user_status"
                                                                 <?php echo $user->iStatus == 1 ? 'checked' : ''; ?>>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="form-check form-switch p-0 w-auto d-flex justify-content-center align-content-center">
                                                            <input
                                                                data-link="{{ route('User.khoa_comment_user', [$user->id]) }}"
                                                                class="form-check-input position-static m-0 admin_user_comment"
                                                                type="checkbox"
                                                                name="admin_user_comment"
                                                                <?php echo $user->iComment == 1 ? 'checked' : ''; ?>>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
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
