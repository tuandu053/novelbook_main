<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Novel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function danhgia_novel(Request $request,$id_novel) {
        
        $data = $request->validate(
            [
                'ntp_comment' => ['required','string','max:500'],
                'ntp_point' => ['required','min:1','max:5','integer'],
            ],
            [
                'ntp_comment.required' => 'Nội dung bình luận không được để trống',
                'ntp_comment.string' => 'Nội dung bình luận phải là các ký tự',
                'ntp_comment.max' => 'Nội dung bình luận không được nhiều hơn 500 ký tự',

                'ntp_point.max' => 'Số sao lớn nhất là 5 sao',
                'ntp_point.required' => 'Bạn chưa cho đánh giá sao',
                'ntp_point.integer' => 'Đánh giá sao phải là một giá trị số',
                'ntp_point.min' => 'Số sao nhỏ nhất là 1 sao'
            ]
        );

        if(Auth::check()) {
            $novel = Novel::find($id_novel);
            if(Auth::user()->iComment != 0) {
                if ($novel) {
                    $comment = new Comment();
                    $comment->sContent = $data['ntp_comment'];
                    $comment->sPoint = $data['ntp_point'];
                    $comment->idUser  = Auth::user()->id;
                    $comment->idNovel = $id_novel;
                    $comment->save();
    
                    return response()->json([
                        'message' => 'Bạn đã đánh giá thành công truyện '.$novel->sNovel,
                        'status' => 1
                    ]);
    
                } else {
                    return response()->json([
                        'errors' => ['NOvel' => 'Không tìm thấy truyện bạn muốn đánh giá'],
                        'status' => 0
                    ]);
                }

            } else {
                return response()->json([
                    'errors' => ['Comment' => 'Bạn đã bị khóa tính năng bình luận đánh giá để biết thêm chi tiết hãy liên hệ đội ngũ quản trị viên'],
                    'status' => 0
                ]);
            }

        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }

    public function danhgia_list($id_novel) {
        $novel = Novel::find($id_novel);

        if(!$novel) {
            return response()->json([
                'html' => '<h1>Không tìm thấy truyện</h1>'
            ]);
        }

        return response()->json([
            'html' => view('single.single_review',[
                'novel' =>$novel
            ])->render()
        ]);
    }

    public function danhgia_reply(Request $request,$id_commentpa) {
        $data = $request->validate(
            [
                'ntp_comment' => ['required','string','max:500'],
            ],
            [
                'ntp_comment.required' => 'Nội dung phản hồi không được để trống',
                'ntp_comment.string' => 'Nội dung phản hồi phải là các ký tự',
                'ntp_comment.max' => 'Nội dung phản hồi không được nhiều hơn 255 ký tự',
            ]
        );
        
        if(Auth::check()) {
            $comment_pa = Comment::find($id_commentpa);
            if (! $comment_pa || $comment_pa->id_Comment_parent != null ) {
                return response()->json([
                    'errors' => ['NOvel' => 'Không tìm thấy đánh giá bạn ,muốn phản hồi'],
                    'status' => 0
                ]);
            }

            if(Auth::user()->iComment != 0) {
                $comment_c = new Comment();
                $comment_c->sContent = $data['ntp_comment'];
                $comment_c->sPoint = 0;
                $comment_c->idUser  = Auth::user()->id;
                $comment_c->idNovel = $comment_pa->idNovel ;
                $comment_c->id_Comment_parent = $comment_pa->id ;
                $comment_c->save();

                return response()->json([
                    'message' => 'Bạn đã phản hồi đánh giá thành công',
                    'status' => 1
                ]);

            } else {
                return response()->json([
                    'errors' => ['Comment' => 'Bạn đã bị khóa tính năng bình luận đánh giá để biết thêm chi tiết hãy liên hệ đội ngũ quản trị viên'],
                    'status' => 0
                ]);
            }

        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }

    public function danhgia_phanhoi_update(Request $request,$id_comment) {
        
        $data = $request->validate(
            [
                'ntp_comment_update' => ['required','string','max:500'],
                // 'ntp_point' => ['required','min:1','max:5','integer'],
            ],
            [
                'ntp_comment_update.required' => 'Nội dung bình luận không được để trống',
                'ntp_comment_update.string' => 'Nội dung bình luận phải là các ký tự',
                'ntp_comment_update.max' => 'Nội dung bình luận không được nhiều hơn 255 ký tự',

                // 'ntp_point.max' => 'Số sao lớn nhất là 5 sao',
                // 'ntp_point.required' => 'Bạn chưa cho đánh giá sao',
                // 'ntp_point.integer' => 'Đánh giá sao phải là một giá trị số',
                // 'ntp_point.min' => 'Số sao nhỏ nhất là 1 sao'
            ]
        );

        if(Auth::check()) {
            if(Auth::user()->iComment != 0) {
                $comment = Comment::find($id_comment);
                
                if ($comment) {
                    if (Auth::user()->sRole == 'admin' ||Auth::user()->id ==  $comment->idUser ) {
                        $comment->sContent = $data['ntp_comment_update'];
                        $comment->save();
        
                        return response()->json([
                            'message' => 'Bạn đã cập nhật thành công đánh giá phản hồi',
                            'status' => 1
                        ]);
                    } else {
                        return response()->json([
                            'errors' => ['Role' => 'Bạn không có quyền cập nhật đnahs giá phản hồi này'],
                            'status' => 0
                        ]);
                    }
    
                } else {
                    return response()->json([
                        'errors' => ['Novel' => 'Không tìm thấy nội dung đánh giá phản hồi bạn muốn cập nhật'],
                        'status' => 0
                    ]);
                }

            } else {
                return response()->json([
                    'errors' => ['Comment' => 'Bạn đã bị khóa tính năng bình luận đánh giá để biết thêm chi tiết hãy liên hệ đội ngũ quản trị viên'],
                    'status' => 0
                ]);
            }

        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }

    public function danhgia_phanhoi_hide(Request $request) {
        if(Auth::check()) {
            $comment = Comment::find($request['id_comment']);
            if (Auth::user()->id == $comment->idUser || Auth::user()->sRole == 'admin') {
                $value = $request['value'];

                if ($value !== '0' && $value !== '1') {
                    $value = '1';
                }

                if ($comment) {
                    $comment->iDisplay = $value;
                    $comment->save();

                    return response()->json([
                        'message' => 'Bạn đã cập nhật thành công thạng thái hiển thị của đánh giá phản hồi',
                        'status' => 1
                    ]);
                }

            } else {
                return response()->json([
                    'errors' => ['Nguoidung' => 'Bạn không có quyền ẩn hiện đánh giá phản hồi này'],
                    'status' => 0
                ]);
            }
            
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }

    public function danhgia_phanhoi_delete(Request $request) {
        if(Auth::check()) {
            $comment = Comment::find($request['id_comment']);
            if (Auth::user()->sRole == 'admin') {
                $value = $request['value'];

                if ($value !== '0' && $value !== '1') {
                    $value = '1';
                }

                if ($comment) {
                    $comment->iDelete = $value;
                    $comment->save();

                    return response()->json([
                        'message' => 'Bạn đã cập nhật thành công thạng thái của đánh giá phản hồi',
                        'status' => 1
                    ]);
                }

            } else {
                return response()->json([
                    'errors' => ['Nguoidung' => 'Bạn không có quyền thay đổi đánh giá phản hồi này'],
                    'status' => 0
                ]);
            }
            
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }
}
