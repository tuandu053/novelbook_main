<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Author;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdraw;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->validate(
            [
                'butdanh' => ['required', 'string', 'max:100', Rule::unique('tblauthor', 'sNickName'),],
                'mota' => ['required', 'string', 'max:3000'],
                'nganhang' => ['required'],
                'maso_nganhhang'=>['required','string','max:20',],
                'camket' => ['file', 'mimes:pdf', 'max:10240'],
                'cccd' => ['required','file', 'mimes:pdf', 'max:10240'],
                'id_user' => ['required',Rule::unique('tblauthor', 'idUser')]
            ],
            [
                'butdanh.required' => 'Bút danh không được để trống',
                'butdanh.max' => 'Bút danh không được dài quá 100 ký tự',
                'butdanh.unique' => 'Bút danh đã được sử dụng',

                'mota.required' => 'Mô tả không được để trống',
                'mota.max' => 'Mô tả không được dài quá 3000 ký tự',

                'nganhang.required' => 'Ngân hàng không được để trống',

                'maso_nganhhang.required' => 'Mã số ngân hàng khong được bỏ trống',

                'camket.file' => 'Tệp cam kết phải là tệp hợp lệ',
                'camket.mimes' => 'Tệp cam kết phải là tệp PDF',
                'camket.max' => 'Tệp cam kết không được vượt quá 10MB',

                'cccd.file' => 'Tệp ảnh CCCD phải là tệp hợp lệ',
                'cccd.mimes' => 'Tệp ảnh CCCD phải là tệp PDF',
                'cccd.required' => 'Tệp ảnh CCCD không được để trống',
                'cccd.max' => 'Tệp ảnh CCCD không được vượt quá 10MB',

                'id_user.required' => 'Mã người dùng không có hãy chắc rằng bạn đã đăng nhập nếu không hãy reload lại trang',
            ]
        );
        $file = $request->file("camket");
        $file_cccd = $request->file("cccd");

        $author = new Author();
        $user = User::find($data['id_user']);
        
        $author->sNickName = $data['butdanh'];
        $author->sDes = $data['mota'];
        $author->idUser = $data['id_user'];
        $author->sBankAccountNumber = $data['maso_nganhhang'];
        $author->sBank = $data['nganhang'];
        
        if ($user->sRole == 'admin') {
            $author->iStatus = 1;
        } else {
            $author->iStatus = 0;
        }

        $destination = "uploads/camket";
        $destination_cccd = "uploads/cccd";

        if($file_cccd) {
            $filename_cccd = 'time_'.time().'_file_'.$file_cccd->getClientOriginalName();
            if ($file_cccd->move($destination_cccd, $filename_cccd)) {
                $author->sImg_identity = $filename_cccd;
            }
        }

        if($file) {
            $filename = 'time_'.time().'_file_'.$file->getClientOriginalName();
            if ($file->move($destination, $filename)) {
                $author->sCommit = $filename;
            }
        }

        $author->save();

        return response()->json([
            'message' => 'xin cấp quyền thành công hãy đợi quản trị viên xét duyệt ( quá trình mất 2 -3 ngày)',
            'status' =>1,
            'file' => url($destination.'/'.$author->sCommit),
            'file' => url($destination_cccd.'/'.$author->sImg_identity)
        ]);
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
        $author = Author::where('idUser',$user->id)->first();
        $is_author_page = true;
        return view('author.authorpage',[
            'user' => $user,
            'author' => $author,
            'author_found' => $author ? 1:0,
            'is_author_page' => $is_author_page
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
        $author = Author::find($id);
        return view('admincp.admin_page.admin_chitiet_tacgia',[
            'author' => $author
        ]);
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
        $author = Author::find($id);
        
        $data = $request->validate(
            [
                'butdanh' => ['required', 'string', 'max:100', Rule::unique('tblauthor', 'sNickName')->ignore($id,'id'),],
                'mota' => ['required', 'string', 'max:3000'],
                'nganhang' => ['required'],
                'maso_nganhhang'=>['required','string','max:20'],
                'id_user' => ['required',Rule::unique('tblauthor', 'idUser')->ignore($id,'id')],
                'camket' => ['file', 'mimes:pdf', 'max:10240'],
                'cccd' => ['file', 'mimes:pdf', 'max:10240']
            ],
            [
                'butdanh.required' => 'Bút danh không được để trống',
                'butdanh.max' => 'Bút danh không được dài quá 100 ký tự',
                'butdanh.unique' => 'Bút danh đã được sử dụng',

                'mota.required' => 'Mô tả không được để trống',
                'mota.max' => 'Mô tả không được dài quá 3000 ký tự',

                'nganhang.required' => 'Ngân hàng không được để trống',

                'maso_nganhhang.required' => 'Mã số ngân hàng khong được bỏ trống',

                'id_user.required' => 'Mã người dùng không có hãy chắc rằng bạn đã đăng nhập nếu không hãy reload lại trang',

                'camket.file' => 'Tệp cam kết phải là tệp hợp lệ',
                'camket.mimes' => 'Tệp cam kết phải là tệp PDF',
                'camket.max' => 'Tệp cam kết không được vượt quá 10MB',

                'cccd.file' => 'Tệp ảnh CCCD phải là tệp hợp lệ',
                'cccd.mimes' => 'Tệp ảnh CCCD phải là tệp PDF',
                'cccd.max' => 'Tệp ảnh CCCD không được vượt quá 10MB'
            ]
        );

        $file = $request->file("camket");
        $file_cccd = $request->file("cccd");

        $user = User::find($data['id_user']);

        $author->sNickName = $data['butdanh'];
        $author->sDes = $data['mota'];
        $author->idUser = $data['id_user'];
        $author->sBankAccountNumber = $data['maso_nganhhang'];
        $author->sBank = $data['nganhang'];

        $message = 'cập nhật thông tin xin cấp quyền thành công hãy tiếp tục đợi đợi quản trị viên xét duyệt ( quá trình mất 2 -3 ngày)';

        if($author->iStatus != 1) {
            $author->iStatus = 0;
        }

        if ($user->sRole == 'admin') {
            $author->iStatus = 1;
            $message = 'Admin rồi xin cái j';
        }
        
        $destination = "uploads/camket";
        $destination_cccd = "uploads/cccd";

        if($file) {
            $filename = 'time_'.time().'_file_'.$file->getClientOriginalName();
            if ($file->move($destination, $filename)) {
                $author->sCommit = $filename;
            }
        }

        if($file_cccd) {
            $filename_cccd = 'time_'.time().'_file_'.$file_cccd->getClientOriginalName();
            if ($file_cccd->move($destination_cccd, $filename_cccd)) {
                $author->sImg_identity = $filename_cccd;
            }
        }
        $author->save();

        return response()->json([
            'message' => $message,
            'status' =>1,
            'file' => url($destination.'/'.$author->sCommit),
            'file_cccd' => url($destination_cccd.'/'.$author->sImg_identity),
            'author_found' => $author ? 1:0
        ]);
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

    public function xetduyet(Request $request,$id) {

        $data = $request->validate(
            [
                'xuly' => ['required'],
            ],
            [
                'xuly.required' => 'Bạn cần lựa chọn đồng ý hoặc từ chối xin cấp quyền trước khi cập nhật',
            ]
        );
        $author = Author::find($id);
       
        $user = User::find($author->idUser);
        if( $user->sRole == 'admin') {
            return response()->json([
                'message' => 'Người dùng này đang là admin bạn không thể gỡ quyền của người này',
                'status' =>1
            ]);
        }
        $author->iStatus = $data['xuly'];
        
        if ($data['xuly'] == 1) {
            $user->sRole = 'author';
            $user->save();
        } elseif ($data['xuly'] == 0) {
            $user->sRole = 'user';
            $user->save();
        }
       
        $author->save();
        return response()->json([
            'message' => 'Xử lý thông tin xin cấp quyền thành công',
            'status' =>1
        ]);
    }

    public function danhsach_xetduyet() {
        return view('admincp.admin_page.admin_xetduyet_tacgia');
    }

    public function baocao_thongke(Request $request) {
        
        $data = $request->validate(
            [
                'Ngay_batdau' => ['date','nullable'],
                'Ngay_ketthuc' => ['date','nullable'],
            ],
            [
                'Ngay_batdau.datetime' => 'Ngày bắt đầu lọc phải có định dạng là date',
                'Ngay_ketthuc.datetime' => 'Ngày kết thúc lọc phải có định dạng là date',
            ]
        );

        if (Auth::check()) {
            $id = Auth::user()->id;

            $pdf = Pdf::loadView('author.thongke_baocao', [
                'author_id' => $id,
                'nguoilapbaocao' => Auth::user()->name,
                'day_start_filter' =>$data['Ngay_batdau'],
                'day_end_filter' =>$data['Ngay_ketthuc'],
                'is_pdf' => true
            ]);

            // Mail::send('emails.mail_baocao', $data, function($message)use($data, $pdf) {

            //     $message->to(Auth::user()->email, Auth::user()->email)
            //             ->subject('Báo cáo thống kê của '.Auth::user()->name)
            //             ->attachData($pdf->output(), Str::slug('Báo cáo thống kê của '.Auth::user()->name).'.pdf');
            // });

            $pdfContent = $pdf->output();
            $pdfBase64 = base64_encode($pdfContent);
            $pdfFileName = Str::slug('Báo cáo thống kê của ' . Auth::user()->name) . '.pdf';

            return response()->json([
                'status' => 1,
                'message' => 'Tạo báo cáo thành công',
                'html' => view('author.thongke_baocao', [
                    'author_id' => $id,
                    'nguoilapbaocao' => Auth::user()->name,
                    'day_start_filter' =>$data['Ngay_batdau'],
                    'day_end_filter' =>$data['Ngay_ketthuc'],
                ])->render(),
                'pdfBase64' => $pdfBase64,
                'pdfFileName' => $pdfFileName,
            ]);

        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }

    public function Tim_kiem_tacgia($nickname) {
        $html= '';
        $authors = Author::select('sNickName', 'idUser')
        ->where('sNickName', 'LIKE', '%' . $nickname . '%')
        ->get();
        
        foreach ($authors as $author) {
             $html .= ' <a class="ntp_item_tacgia link-primary text-decoration-none" href="javascript:void(0);" data-iduser="' . $author->idUser . '">' . $author->sNickName . '</a><hr>';
        }
        
        return response()->json([
            'html' =>  $html,
            'status' => 1
        ]);
    }

    public function author_withdraw(Request $request) {
        $data = $request->validate(
            [
                'coint' => ['integer','min:100','required'],
            ],[
                'coint.integer' => 'Số xu phải là một con số',
                'coint.min' => 'Số xu phải bé nhất phải là 100 xu',
                'coint.required' => 'Số xu không được bỏ trống',
            ]
        );

        if (Auth::check()) {
            $id = Auth::user()->id;
            $user = User::find($id);
            $author = Author::where('idUser',$id)->first();
            $startOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
            $endOfMonth = Carbon::now()->endOfMonth()->toDateTimeString();

            // $hasRecordsThisMonth = Withdraw::where('idUser', $id)
            //             ->whereBetween('dCreateDay', [$startOfMonth, $endOfMonth])
            //             ->exists();

            // if ($hasRecordsThisMonth) {
            //     return response()->json([
            //         'errors' => ['Thongbao' => 'Tháng này bạn đã tạo yêu cầu rút tiền rồi'],
            //         'status' => 0
            //     ]);
            // }

            if(! $author) {
                return response()->json([
                    'errors' => ['Quyen' => 'Bạn chưa là tác giả bạn không thể rút số dư từ tài khoản thu nhập'],
                    'status' => 0
                ]);
            }

            if(Auth::user()->iCoint_receive <  $data['coint']) {
                return response()->json([
                    'errors' => ['Sodu' => 'Số dư của bạn không đủ'],
                    'status' => 0
                ]);
            }

            $withdraw = new Withdraw();
            $withdraw->iCoint =  $data['coint'];
            $withdraw->idUser =  $id;
            $withdraw->sBank = $author->sBank;
            $withdraw->sBankAccountNumber =  $author->sBankAccountNumber;
            $withdraw->save();

            $user->iCoint_receive = $user->iCoint_receive - $data['coint'];
            $user->save();

            return response()->json([
                'status' => 1,
                'message' => 'Tạo yêu cầu rút tiền thành công'
            ]);
            

        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }

    public function author_withdraw_cancel($id_withdraw) {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $user = User::find($id);
            $withdraw = Withdraw::find($id_withdraw);

            if (!$withdraw) {
                return response()->json([
                    'errors' => ['Thongbao' => 'Không tồn tại yêu cầu bạn muốn hủy'],
                    'status' => 0
                ]);
            }

            if(Auth::user()->id != $withdraw->idUser) {
                return response()->json([
                    'errors' => ['Thongbao' => 'Bạn không có quyền hủy yêu cầu rút tiền này'],
                    'status' => 0
                ]);
            }

            
            $user->iCoint_receive += $withdraw->iCoint;
            $user->save();

            $withdraw->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Hủy yêu cầu rút tiền thành công'
            ]);
            

        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0
            ]);
        }
    }
}
