<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bill;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public $is_user_page = true;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderby('id', 'ASC')->get();
        return view('user.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::find($id);
        $bills = Bill::where('idUser', $id)->get();
        return view('user.index', [
            'user' => $user,
            'is_user_page' => $this->is_user_page,
            'bills' => $bills
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $data = $request->validate(
        [
            'tennguoidung' => ['required', 'string', 'max:255', Rule::unique('users', 'name')->ignore($id)],
            'diachi' => ['max:255'],
            'ngaysinh' => ['nullable', 'date', 'before:today'], // Kiểm tra ngày sinh không thể là ngày trong tương lai
            'gioitinh' => ['in:nam,nữ', 'nullable'],
        ],
        [
            'tennguoidung.required' => 'Tên người dùng không được để trống',
            'tennguoidung.string' => 'Tên người dùng phải là các ký tự',
            'tennguoidung.max' => 'Tên người dùng không được nhiều hơn 255 ký tự',
            'tennguoidung.unique' => 'Tên người dùng đã được sử dụng',

            'diachi.max' => 'Địa chỉ không được nhiều hơn 255 ký tự',

            'ngaysinh.date' => 'Ngày sinh không hợp lệ',
            'ngaysinh.before' => 'Ngày sinh không thể là ngày trong tương lai', // Thông báo cho lỗi ngày trong tương lai

            'gioitinh.in' => 'Giới tính chỉ chấp nhận nam hoặc nữ',
        ]
    );

    if (!Auth::check()) {
        return response()->json([
            'status' => 0,
            'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
        ]);
    }

    $user = User::find($id);
    $user->name = $data['tennguoidung'];
    $user->sAdress = $data['diachi'];
    $user->dBirthday = $data['ngaysinh'];
    $user->sGender = $data['gioitinh'];

    $user->save();

    return response()->json([
        'message' => 'Cập nhật thông tin cá nhân thành công',
        'status' => 1
    ]);
}


    public function update_anhdaidien(Request $request, $id)
    {

        $request->validate(
            [
                'anhdaidien' => ['image', 'max:4096'],
            ],
            [
                'anhdaidien.image' => 'File bạn vừa upload không phải là hình ảnh',
                'anhdaidien.max' => 'File ảnh bạn upload phải < 4mb',
            ]
        );

        if (!Auth::check()) {
            return response()->json([
                'status' => 0,
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
            ]);
        }

        $send = [
            'avatar_change_status' => ''
        ];

        $file = $request->file("anhdaidien");
        $user = User::find($id);

        if ($file) {
            $destination = "uploads/user_av";
            $filename = 'time_' . time() . '_file_' . $file->getClientOriginalName();
            if ($file->move($destination, $filename)) {
                $send = [
                    'avatar_change' => 'Cập nhật Avatar thành công',
                    'avatar_change_status' => 1,
                    'av_link' => url($destination . '/' . $filename)
                ];
                $user->sAvatar = $filename;
            } else {
                $send = [
                    'avatar_change' => 'Cập nhật Avatar thất bại',
                    'avatar_change_status' => 0
                ];
            }
        }

        $user->save();

        return response()->json([
            'status' => 1,
            'av_update' => $send,
        ]);
    }

    public function save_user_setting(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 0,
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
            ]);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 0,
                'errors' => ['Nguoidung' => 'Không tìm thấy người dùng'],
            ]);
        }

        if(Auth::user()->id == $id) {
            $ntp_font = $request['ntp_font'];
            $ntp_mode = $request['ntp_mode'];
            
            $data = array(
                'ntp_font' => $ntp_font,
                'ntp_mode' => $ntp_mode
            );
            
            $json_data = json_encode($data);
            $user->sSetup = $json_data;
            $user->save();
            return response()->json([
                'status' => 1,
                'message' => 'Cài đặt thành công',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'errors' => ['Nguoidung' => 'Bạn không có quyền thay đổi cho nguòi dùng này'],
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function admin($id)
    {
        $user = User::find($id);
        return view('admincp.admin_page.adminpage', [
            'isadmin' => true,
            'user' => $user,
        ]);
    }

    public function danh_sach_user() {
        $users = User::orderBy('id', 'DESC')->where('id','!=',Auth::user()->id)->get();
        return view('admincp.admin_page.admin_danhsach_nguoidung', [
            'isadmin' => true,
            'users' => $users,
        ]);
    }

    public function cap_quyen_user(Request $request, $id) {

        $data = $request->validate(
            [
                'admin_user_role' => ['in:admin,user,author', 'required','string'],
            ],
            [
                'admin_user_role.required' => 'Không có thông tin về quyền được yêu cầu',
                'admin_user_role.string' => 'Thông tin quyền phải là các ký tự',
                'admin_user_role.in' => 'Không tồn tại quyền mà bạn vừa yêu cầu',
            ]
        );
        
        $user = User::find($id);

        if (Auth::check() && Auth::user()->sRole != 'admin') {
            return response()->json([
                'status' => 0,
                'errors' => ['Nguoidung' => 'Bạn không có quyền thay đổi cho nguòi dùng này'],
            ]);
        } 

        if($user) {
            $user->sRole = $data['admin_user_role'];
            $user->save();
            return response()->json([
                'status' => 1,
                'message' => 'Cập nhật quyền cho người dùng ' .$user->name .' thành ' . $data['admin_user_role'],
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'errors' => ['Nguoidung' => 'Không tìm thấy người dùng này'],
            ]);
        }
    }

    public function khoa_user(Request $request, $id) {

        $data = $request->validate(
            [
                'admin_user_status' => ['required', 'integer', 'in:0,1'],
            ],
            [
                'admin_user_status.required' => 'Hệ thống không nhận được thông tin nào.',
                'admin_user_status.in' => 'Bạn chỉ có thẻ cập nhật 0 hoặc 1',
            ]
        );

        if (Auth::check() && Auth::user()->sRole != 'admin') {
            return response()->json([
                'status' => 0,
                'errors' => ['Nguoidung' => 'Bạn không có quyền khóa tài khoản của người dùng'],
            ]);
        } 

        $user = User::find($id);
        if($user) {
            $user->iStatus = $data['admin_user_status'];
            $user->save();
            $mes ='';
            if($data['admin_user_status'] == 1) {
                $mes ='Đã mở khóa tài khoản ' .$user->name;
            } else {
                $mes ='Đã khóa tài khoản ' .$user->name;
            }
            return response()->json([
                'status' => 1,
                'message' => $mes
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'errors' => ['Nguoidung' => 'Không tìm thấy người dùng này'],
                
            ]);
        }
    }

    public function khoa_comment_user(Request $request, $id) {
        $data = $request->validate(
            [
                'admin_user_comment' => ['required', 'integer', 'in:0,1'],
            ],
            [
                'admin_user_comment.required' => 'Hệ thống không nhận được thông tin nào.',
                'admin_user_comment.in' => 'Bạn chỉ có thẻ cập nhật 0 hoặc 1',
            ]
        );

        if (Auth::check() && Auth::user()->sRole != 'admin') {
            return response()->json([
                'status' => 0,
                'errors' => ['Nguoidung' => 'Bạn không có quyền khóa tính năng bình luận của người dùn'],
            ]);
        } 

        $user = User::find($id);
        if($user) {
            $user->iComment = $data['admin_user_comment'];
            $user->save();
            $mes ='';
            if($data['admin_user_comment'] == 1) {
                $mes ='Đã mở khóa tính năng bình luận của ' .$user->name;
            } else {
                $mes ='Đã khóa  tính năng bình luận của ' .$user->name;
            }
            return response()->json([
                'status' => 1,
                'message' => $mes
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'errors' => ['Nguoidung' => 'Không tìm thấy người dùng này'],
            ]);
        }
    }
}
