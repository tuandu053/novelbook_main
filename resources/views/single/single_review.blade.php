<?php

use App\Models\Comment;
use App\Models\Novel;
use App\Models\User;

$comments_pa = Comment::whereNull('id_Comment_parent')->where('idNovel',$novel->id)->orderBy('dCreateDay', 'DESC')->get();
?>
<div class="card "  style="background: transparent; backdrop-filter: blur(4px);" id="ntp_novel_review" data-link="{{route('Comment.danhgia_list',[$novel->id])}}">
    <div class="card-header fw-bold text-warning" > Các đánh giá</div>
    <div class="card-body">
        <div class="overflow-auto ntp_custom_ver_scrollbar p-3 ps-0" style="height: 500px;">
            @foreach ($comments_pa as $key => $comment_pa)
                <div class="d-flex ntp_review_item flex-start mb-4 gap-3">
                    @php
                        $user = User::find($comment_pa->idUser);
                        $avt =
                            $user->sAvatar == null
                                ? 'default-avatar-photo.jpg'
                                : $user->sAvatar;
                    @endphp
                    <img class="ntp_av_review ntp_av rounded-circle shadow-1-strong" src="{{ asset('uploads/user_av/' . $avt) }}"
                        alt="{{ $avt }}">
                    <div class="card comment_item w-100">
                        <div class="p-2">
                            <p class="mb-2"> <strong>{{ $user->name }}</strong> đánh giá lúc {{ $comment_pa->dCreateDay }}</p>
                            @if ($comment_pa->iDisplay == 1 && $comment_pa->iDelete == 0)
                                <ul class="ntp_novel_rating mb-2 list-inline d-flex gap-2" data-mdb-toggle="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @php
                                            $class = $i <= $comment_pa->sPoint ? 'fa-solid' : 'far';
                                        @endphp
                                        <li><i class="{{ $class }} fa-star fa-sm text-warning rating-star-view"
                                                data-point="{{ $i }}"></i></li>
                                    @endfor
                                </ul>
                                <p class="mb-2 comment_content">
                                    {{ $comment_pa->sContent }}
                                </p>
                            @elseif ($comment_pa->iDelete == 1)
                                <p class="mb-2 text text-danger">Phản hồi này đã bị xóa</p>
                            @else
                                <p class="mb-2 text text-danger">Phản hồi này đã bị ẩn </p>
                            @endif

                            <div class="d-flex justify-content-end gap-3 flex-wrap align-items-center">
                                <a class="ntp_comment_reply" data-bs-toggle="modal" href="#ntp_reply_comment" data-link="{{route('Comment.danhgia_reply',[$comment_pa->id])}}" role="button"><i class="fas fa-reply me-1"></i> Phản hồi</a>
                                @auth
                                    @if (Auth::user()->id == $comment_pa->idUser || Auth::user()->sRole=='admin')
                                        <a href="javascript:void(0);" 
                                            data-link="{{route('Comment.danhgia_phanhoi_hide')}}" 
                                            data-value="{{$comment_pa->iDisplay == '1' ?'0':'1'}}" 
                                            data-id-comment="{{$comment_pa->id}}" 
                                            class="link-muted ntp_show_hide_comment">
                                            @if ($comment_pa->iDisplay == '1')
                                                <i class="fa-solid fa-eye-slash"></i> Ẩn
                                            @else
                                                <i class="fa-solid fa-eye"></i> Hiện
                                            @endif
                                        </a>

                                        @if ($comment_pa->iDelete != 1 && $comment_pa->iDisplay != 0)
                                            <a data-bs-toggle="modal" 
                                                class="ntp_comment_update" 
                                                href="#ntp_edit_comment" 
                                                data-link="{{route('Comment.danhgia_phanhoi_update',[$comment_pa->id])}}" 
                                                role="button">
                                                <i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa
                                            </a>
                                        @endif
                                        
                                        @if (Auth::user()->sRole=='admin')
                                            <a href="javascript:void(0);" 
                                                data-id-comment="{{$comment_pa->id}}" 
                                                data-value="{{$comment_pa->iDelete == '1' ? '0':'1'}}" 
                                                data-link="{{route('Comment.danhgia_phanhoi_delete')}}" 
                                                class="link-muted ntp_delete_comment">
                                                @if ($comment_pa->iDelete == '0')
                                                    <i class="fa-solid fa-trash"></i> Gỡ bỏ
                                                @else
                                                    <i class="fa-solid fa-trash-can-arrow-up"></i> Khôi phục
                                                @endif
                                            </a>
                                        @endif
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $comment_childs = Comment::where('id_Comment_parent', $comment_pa->id)->where('idNovel',$novel->id)->orderBy('dCreateDay', 'ASC')->get();
                @endphp

                @if ($comment_childs)
                    @foreach ($comment_childs as $key => $comment_child)
                        <div class="d-flex  ntp_review_item ntp_review_item_child flex-start mb-4 gap-3">
                            @php
                                $user_child = User::find($comment_child->idUser);
                                $avtc =  $user_child->sAvatar == null ? 'default-avatar-photo.jpg'
                                        : $user_child->sAvatar;
                            @endphp
                            <img class="ntp_av_review rounded-circle ntp_av shadow-1-strong" src="{{ asset('uploads/user_av/'.$avtc) }}" alt="{{$avtc}}">
                            <div class="card comment_item w-100">
                                <div class="p-2">
                                    <p class="mb-2"> <strong>{{ $user_child->name }}</strong> phản hồi lúc {{ $comment_child->dCreateDay }}</p>
                                    @if ($comment_child->iDisplay == 1 && $comment_child->iDelete == 0)
                                        <p class="mb-2 comment_content">
                                            {{ $comment_child->sContent }}
                                        </p>
                                    @elseif ($comment_child->iDelete == 1)
                                        <p class="mb-2 text text-danger">Phản hồi này đã bị ẩn xóa</p>
                                    @else
                                        <p class="mb-2 text text-danger">Phản hồi này đã bị ẩn </p>
                                    @endif
                                    @auth
                                        <div class="d-flex justify-content-end gap-3 flex-wrap align-items-center">
                                            @if (Auth::user()->id == $comment_child->idUser || Auth::user()->sRole=='admin')

                                            <a href="javascript:void(0);" 
                                                class="link-muted ntp_show_hide_comment" 
                                                data-id-comment="{{$comment_child->id}}" 
                                                data-value="{{$comment_child->iDisplay == '1' ?'0':'1'}}" 
                                                data-link="{{route('Comment.danhgia_phanhoi_hide')}}">
                                                @if ($comment_child->iDisplay == '1')
                                                    <i class="fa-solid fa-eye-slash"></i> Ẩn
                                                @else
                                                    <i class="fa-solid fa-eye"></i> Hiện
                                                @endif
                                            </a>

                                            @if ($comment_child->iDelete != 1 && $comment_child->iDisplay != 0)
                                                <a data-bs-toggle="modal" 
                                                    href="#ntp_edit_comment" 
                                                    data-link="{{route('Comment.danhgia_phanhoi_update',[$comment_child->id])}}" 
                                                    class="ntp_comment_update"  
                                                    role="button">
                                                    <i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa
                                                </a>
                                            @endif
                                                @if (Auth::user()->sRole=='admin')
                                                <a href="javascript:void(0);" 
                                                    class="link-muted ntp_delete_comment" 
                                                    data-value="{{$comment_child->iDelete == '1' ?'0':'1'}}" 
                                                    data-id-comment="{{$comment_child->id}}" 
                                                    data-link="{{route('Comment.danhgia_phanhoi_delete')}}">
                                                    @if ($comment_child->iDelete == '0')
                                                        <i class="fa-solid fa-trash"></i> Gỡ bỏ
                                                    @else
                                                        <i class="fa-solid fa-trash-can-arrow-up"></i> Khôi phục
                                                    @endif
                                                </a>
                                                @endif
                                            @endif
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
</div>
