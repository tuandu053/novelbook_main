<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Novel;
use App\Models\Reading_history;
use App\Models\Categories;
use App\Models\Classify;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Purchase_history;
use Illuminate\Validation\Rule;

class ChapterController extends Controller
{
    public $is_chapter_page = true;
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
        if (Auth::check()) {

            $data = $request->validate(
                [
                    'tenchuong' => ['required', 'string', 'max:255',Rule::unique('tblchapter', 'sChapter')->where(function ($query) use ($request) {
                        return $query->where('idNovel', $request->idNovel);
                    }),],
                    'noidungchuong' => ['required'],
                    'tinhphi' => ['in:1,0'],
                    'tinhtrang' => ['required', 'in:1,0'],
                    'idNovel' => ['required'],
                    'giatien' => ['integer', 'min:1']
                ],
                [
                    'tenchuong.required' => 'Tên chương không được để trống',
                    'tenchuong.string' => 'Tên chương phải là các ký tự',
                    'tenchuong.max' => 'Tên chương không được nhiều hơn 255 ký tự',
                    'tenchuong.unique' => 'Tên chương đã tồn tại trong truyện này',

                    'noidungchuong.required' => 'Nội dung chương không được để trống',

                    'tinhtrang.in' => 'Tình trạng bạn chọn không tồn tại',

                    'tinhphi.in' => 'lựa chọn tính phí bạn chọn không tồn tại',
                    'idNovel.required' => 'Mã truyện không được bỏ trống hãy load lại page để load mã truyện',

                    'giatien.integer' => 'Giá tiền phải là một giá trị số',
                    'giatien.min' => 'Giá trị nhỏ nhất của giá tiền là 1'
                ]
            );

            $novel = Novel::find($data['idNovel']);

            if(Auth::user()->id != $novel->idUser) {
                return response()->json([
                    'errors' => ['errors' => 'Bạn không phải chủ sở hữu của truyện này'],
                    'status' =>0
                ]);
            }

            $maxChapter = Chapter::where('idNovel', $data['idNovel'])
                                    ->orderBy('iChapterNumber', 'DESC')
                                    ->first();

            if ($maxChapter) {
                $iChapterNumber = $maxChapter->iChapterNumber + 1;
            } else {
                $iChapterNumber = 1;
            }
            
            $chapter = new Chapter();
            $chapter->sChapter =  $data['tenchuong'];
            $chapter->iChapterNumber =  $iChapterNumber;
            $chapter->sContent =  $data['noidungchuong'];
            $chapter->iPublishingStatus =  0;

            $chapter->iStatus =  $data['tinhtrang'];
            $chapter->idNovel =  $data['idNovel'];

            if(isset($data['tinhphi'])) {
                $chapter->icharges =  $data['tinhphi'];

                if ($data['giatien'] <= 0) {
                    $chapter->iPrice =  1;
                } else {
                    $chapter->iPrice =  $data['giatien'];
                }
            }

            $chapter->save();

            return response()->json([
                'message' => 'Thêm chương truyện thành công',
                'status' => 1
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chapter = Chapter::find($id);
        $novel = Novel::find($chapter->idNovel);

        $previousChapter = Chapter::where('idNovel', $chapter->idNovel)
            ->where('iChapterNumber', '<', $chapter->iChapterNumber)
            ->orderBy('iChapterNumber', 'DESC')
            ->first();


        $nextChapter = Chapter::where('idNovel', $chapter->idNovel)
            ->where('iChapterNumber', '>', $chapter->iChapterNumber)
            ->orderBy('iChapterNumber', 'ASC')
            ->first();


        $previousChapterId = $previousChapter ? $previousChapter->id : 0;
        $nextChapterId = $nextChapter ? $nextChapter->id : 0;

        if (Auth::check()) {
            $iduser = Auth::user()->id;
            $history = Reading_history::where('idUser',$iduser)->where('idChapter',$id)->first();
            
            if (!$history) {
                $history = new Reading_history();
                $history->idUser = $iduser;
                $history->idChapter = $id;
            }
            
            $history->dUpdateDay = time();
            $history->save();
        }

        return view('chapter.chapter_page', [
            'is_chapter_page' => $this->is_chapter_page,
            'chapter' => $chapter,
            'novel' => $novel,
            'previousChapterId' => $previousChapterId,
            'nextChapterId' => $nextChapterId
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
        if (Auth::check()) {

            $data = $request->validate(
                [
                    'tenchuong' => ['required', 'string', 'max:255',Rule::unique('tblchapter', 'sChapter')->where(function ($query) use ($request,$id) { return $query->where('idNovel', $request->idNovel); })->ignore($id,'id'),],
                    'noidungchuong' => ['required'],
                    'tinhphi' => ['in:1,0'],
                    'tinhtrang' => ['required', 'in:1,0'],
                    'idNovel' => ['required'],
                    'giatien' => ['integer', 'min:1']
                ], [
                    'tenchuong.required' => 'Tên chương không được để trống',
                    'tenchuong.string' => 'Tên chương phải là các ký tự',
                    'tenchuong.max' => 'Tên chương không được nhiều hơn 255 ký tự',
                    'tenchuong.unique' => 'Tên chương đã tồn tại trong truyện này',

                    'noidungchuong.required' => 'Nội dung chương không được để trống',
                    'tinhtrang.in' => 'Tình trạng bạn chọn không tồn tại',

                    'tinhphi.in' => 'Lựa chọn tính phí bạn chọn không tồn tại',
                    'idNovel.required' => 'Mã truyện không được bỏ trống hãy tải lại lại trang để tải lại mã truyện',

                    'giatien.integer' => 'Giá tiền phải là một giá trị số',
                    'giatien.min' => 'Giá trị nhỏ nhất của giá tiền là 1'
                ]
            );

            
            $chapter = Chapter::find($id);
            $chapter->sChapter =  $data['tenchuong'];
            $chapter->sContent =  $data['noidungchuong'];
            $chapter->iPublishingStatus =  0;
            $chapter->iStatus =  $data['tinhtrang'];
            $chapter->idNovel =  $data['idNovel'];

            if(isset($data['tinhphi']) && $chapter->iChapterNumber >= 10) {
                $chapter->icharges =  $data['tinhphi'];
                $price = 0;

                if ($data['tinhphi'] == 1) {
                    $price =  $data['giatien'];
                }

                $chapter->iPrice = $price;

            } else {
                $chapter->icharges = 0;
                $chapter->iPrice = 0;
            }

            $chapter->save();

            return response()->json([
                'message' => 'Sửa chương truyện thành công',
                'status' => 1
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

    public function page_chitiet_chuong_author($id)
    {
        $chapters = Chapter::find($id);
        $novel = Novel::find($chapters->idNovel);
        return view('author.chapter.chapter_index',[
            'novel' =>$novel,
            'chapters' => $chapters
         ]);
    }

    public function admin_kiemquyet_chuong($id)
    {
        $chapters = Chapter::find($id);
        return response()->json([
            'chapters' => $chapters,
            'status' => 1
        ]);
    }

    public function kiem_duyet_chuong(Request $request)
    {
        $chapter = Chapter::find($request['id']);

        if (isset($request['xuly'])) {
            $chapter->iPublishingStatus = $request['xuly'];
        }

        if (isset($request['trangthai'])) {
            $chapter->iStatus = $request['trangthai'];
        }

        if (isset($request['trangthai']) || isset($request['xuly'])) {
            $chapter->save();
            $chapters = Chapter::orderBy('iChapterNumber', 'ASC')->where('idNovel',$request['id_novel'])->get();
            return response()->json([
                'message' => 'Cập nhật thành công',
                'status' =>1,
                'table'=>view('admincp.admin_page.admin_mucluc',[
                    'chapters' => $chapters
                 ])->render()
            ]);

        } else {
            return response()->json([
                'message' => 'Bạn chưa thay đổi gì cả',
                'status' =>1
            ]);
        }
    }

    public function xoa_lichsu_doc($id_novel) {
        if (Auth::check()) {
            $iduser = Auth::user()->id;
            $chapters = Chapter::where('idNovel', $id_novel)->pluck('id'); // Get the list of chapter IDs
            $history = Reading_history::where('idUser', $iduser)
                ->whereIn('idChapter', $chapters)
                ->get();
            foreach ($history as $record) {
                $record->delete();
            }
            return response()->json([
                'message' => 'Xóa lịch sử thành công',
                'status' =>1,
                'history'=>view('user.user_read_history')->render()
            ]);
            
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn phải đăng nhập đã'],
                'status' =>0,
                'history'=>view('user.user_read_history')->render()
            ]);
        }
        
    }

    public function mua_chuong($id_chapter) {
        if (Auth::check()) {
            $chapter = Chapter::find($id_chapter);

            if ($chapter) {
                $iduser = Auth::user()->id;
                $purchase_history = Purchase_history::where('idChapter',$id_chapter)->where('idUser',$iduser)->first();

                if ($purchase_history) {
                    return response()->json([
                        'message' => 'Bạn mua chương này rồi',
                        'status' =>1
                    ]);
                } else {
                    $price = $chapter->iPrice;
                    
                    if(Auth::user()->iCoint >= $price) {
                       
                        $user = User::find($iduser);
                        $user->iCoint = $user->iCoint - $price;
                        $user->save();

                        $novel = Novel::find($chapter->idNovel);
                        $novel_owner = User::find($novel->idUser);
                        $novel_owner->iCoint_receive = $novel_owner->iCoint_receive + $price*0.7;
                        $novel_owner->save();

                        $purchase_history = new Purchase_history();
                        $purchase_history->idChapter = $id_chapter;
                        $purchase_history->idUser = $iduser;
                        $purchase_history->iprice = $price;
                        $purchase_history->save();
    
                        return response()->json([
                            'message' => 'Mua chương: ' . $chapter->iChapterNumber . ' ' . $chapter->sChapter . ' thành công',
                            'status' =>1,
                            'content' =>$chapter->sContent
                        ]);

                    } else {
                        return response()->json([
                            'errors' => ['errors' => 'Bạn không dủ xu để mua chương này hãy vào ví tiền nạp tiền <a class="link-success text-decoration-underline" href="' . route('User.show', [Auth::user()->id,'view=user_bill-tab']) . '">Vào ví tiền</a>'],
                            'status' =>0
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'errors' => ['errors' => 'Không tìm thấy chương truyện bạn cần mua'],
                    'status' =>0
                ]);
            }
            
        } else {
            return response()->json([
                'errors' => ['errors' => 'Bạn phải đăng nhập đã'],
                'status' => 0
            ]);
        }
        
    }
}
