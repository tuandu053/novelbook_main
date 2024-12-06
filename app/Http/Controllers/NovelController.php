<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Novel;
use App\Models\Categories;
use App\Models\Chapter;
use App\Models\Author;
use App\Models\Classify;
use App\Models\Bookmarks;
use App\Models\Reading_history;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NovelController extends Controller
{
    public $isSingle = true;

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
            $id = Auth::user()->id;
            $data = $request->validate(
                [
                    'anhbia' => ['required', 'image', 'max:4096'],
                    'tentruyen' => ['required', 'string', 'max:255'],
                    'motatruyen' => ['required'],
                    'tiendo' => ['required', 'in:1,2,3'],
                    'theloai' => ['required'],
                    'banquyen' => ['required','file', 'mimes:pdf', 'max:10240']
                ],
                [
                    'tentruyen.required' => 'Tên truyện không được để trống',
                    'tentruyen.string' => 'Tên truyện phải là các ký tự',
                    'tentruyen.max' => 'Tên truyện không được nhiều hơn 255 ký tự',
    
                    'anhbia.required' => 'Ảnh bìa truyện không được để trống',
                    'anhbia.image' => 'Ảnh bìa truyện không đúng định dạng',
                    'anhbia.max' => 'Ảnh bìa truyện phải nhở hơn 4mb',
    
                    'motatruyen.required' => 'Mô tả truyện không được để trống',
    
                    'tiendo.required' => 'Tiến độ không được để trống',

                    'theloai.required' => 'Thể loại không được để trống',

                    'banquyen.file' => 'Tệp minh chứng bản quyền phải là tệp hợp lệ',
                    'banquyen.mimes' => 'Tệp minh chứng bản quyền phải là tệp PDF',
                    'banquyen.max' => 'Tệp minh chứng bản quyền không được vượt quá 10MB',
                    'banquyen.required' => 'Tệp minh chứng bản quyền không được để trống',
                ]
            );
    
            $user = User::find($id);
            $novel = new Novel();
            $cats = Categories::orderby('id', 'ASC')->get();
            $catIds = $cats->pluck('id')->toArray();

            $theloai = $data['theloai'];
            $invalidTheloai = array_diff($theloai, $catIds);
            
            if (!empty($invalidTheloai)) {
                return response()->json([
                    'errors' => ['theloai' => 'Có thể loại không hợp lệ'],
                    'status' => 0
                ]);
            }
    
            if($user) {
                if($user['sRole'] != 'user') {
                    $file = $request->file("anhbia");
                    $file_banquyen = $request->file("banquyen");
            
                    if($file) {
                        $destination = "uploads/images";
                        $filename = 'time_'.time().'_file_'.$file->getClientOriginalName();
                        if ($file->move($destination, $filename)) {
                            $novel->sCover = $filename;
                        }
                    }
            
                    if($file_banquyen) {
                        $destination_banquyen = "uploads/banquyen";
                        $filename_banquyen = 'time_'.time().'_file_'.$file_banquyen->getClientOriginalName();
                        if ($file_banquyen->move($destination_banquyen, $filename_banquyen)) {
                            $novel->sLicense = $filename_banquyen;
                        }
                    }
    
                    
                    $novel->sNovel = $data['tentruyen'];
                    $novel->sDes = htmlspecialchars($data['motatruyen']);
                    $novel->sProgress = $data['tiendo'];
                    $novel->idUser = $id;
    
                    $novel->save();

                    

                    foreach ($data['theloai'] as $id) {
                        $clasifi = new Classify();
                        $clasifi->idNovel = $novel->id;
                        $clasifi->idCategories = $id;

                        $clasifi->save();
                    }

                    return response()->json([
                        'message' => 'Thêm truyện thành công',
                        'status' => 1
                    ]);

                } else {
                    return response()->json([
                        'errors' => ['Nguoidung_quyen' => 'Bạn không có quyền thêm truyện'],
                        'status' => 1
                    ]);
                }
    
            } else {
                return response()->json([
                    'errors' => ['Nguoidung' => 'Không tìm thấy người dùng'],
                    'status' => 1
                ]);
            }

            // dd($data['theloai']);
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Không tìm thấy người dùng'],
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
        $novel = Novel::find($id);
        $chapters = Chapter::orderBy('iChapterNumber', 'ASC')->where('idNovel',$id)->get();
        $theloai = Classify::orderby('id', 'ASC')->where('idNovel',$id)->get();
        $author = Author::where('idUser',$novel->idUser)->first();
        $bookmark = Bookmarks::where('idNovel',$id)->get()->count();
        $chapterIds = $chapters->pluck('id');
        $readingHistory = Reading_history::whereIn('idChapter', $chapterIds)->get()->count();
        $averagePoint = Comment::where('idNovel', $id)
                    ->where('iDelete', 0)
                    ->whereNull('id_Comment_parent')
                    ->avg('sPoint');

        return view('single.single_page',[
            'isSingle' => $this->isSingle,
            'chapters' => $chapters,
            'novel' => $novel,
            'count' => $chapters->count(),
            'theloai' => $theloai,
            'author' => $author,
            'bookmark' => $bookmark,
            'readingHistory' =>  $readingHistory,
            'averagePoint' => $averagePoint
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
    public function update(Request $request, $idnovel)
    {
        if (Auth::check()) {
            
            $data = $request->validate(
                [
                    'anhbia' => ['nullable', 'image', 'max:4096'],
                    'tentruyen' => ['required', 'string', 'max:255'],
                    'motatruyen' => ['required'],
                    'tiendo' => ['required', 'in:1,2,3'],
                    'theloai' => ['required'],
                    'banquyen' => ['file', 'mimes:pdf', 'max:10240']
                ],
                [
                    'tentruyen.required' => 'Tên truyện không được để trống',
                    'tentruyen.string' => 'Tên truyện phải là các ký tự',
                    'tentruyen.max' => 'Tên truyện không được nhiều hơn 255 ký tự',
    
                    'anhbia.image' => 'Ảnh bìa truyện không đúng định dạng',
                    'anhbia.max' => 'Ảnh bìa truyện phải nhở hơn 4mb',
    
                    'motatruyen.required' => 'Mô tả truyện không được để trống',
    
                    'tiendo.required' => 'Tiến độ không được để trống',

                    'theloai.required' => 'Thể loại không được để trống',

                    'banquyen.file' => 'Tệp minh chứng bản quyền phải là tệp hợp lệ',
                    'banquyen.mimes' => 'Tệp minh chứng bản quyền phải là tệp PDF',
                    'banquyen.max' => 'Tệp minh chứng bản quyền không được vượt quá 10MB',
                    'banquyen.required' => 'Tệp minh chứng bản quyền không được để trống',
                ]
            );

            $iduser = Auth::user()->id;
            $user = User::find($iduser);
            
            $novel = Novel::find($idnovel);

            $cats = Categories::orderby('id', 'ASC')->get();
            $catIds = $cats->pluck('id')->toArray();

            $theloai = $data['theloai'];
            $invalidTheloai = array_diff($theloai, $catIds);
            
            if (!empty($invalidTheloai)) {
                return response()->json([
                    'errors' => ['theloai' => 'Có thể loại không hợp lệ'],
                    'status' => 0
                ]);
            }
    
            if($user) {
                if($user['sRole'] != 'user') {
                    
                    if ($novel->idUser !=  $iduser) {
                        return response()->json([
                            'errors' => ['Nguoidung_quyen' => 'Bạn không có quyền cập nhật truyện này 1'],
                            'status' => 0
                        ]);
                    }

                    $file = $request->file("anhbia");
                    $file_banquyen = $request->file("banquyen");

            
                    if($file) {
                        $destination = "uploads/images";
                        $filename = 'time_'.time().'_file_'.$file->getClientOriginalName();
                        if ($file->move($destination, $filename)) {
                            $novel->sCover = $filename;
                        }

                    }
            
                    if($file_banquyen) {
                        if($novel->iLicense_Status == 0) {
                            $destination_banquyen = "uploads/banquyen";
                            $filename_banquyen = 'time_'.time().'_file_'.$file_banquyen->getClientOriginalName();
                            if ($file_banquyen->move($destination_banquyen, $filename_banquyen)) {
                                $novel->sLicense = $filename_banquyen;
                            }
                        } else {
                            return response()->json([
                                'errors' => ['Nguoidung_quyen' => 'Bạn không cập nhật lại được thông tin bản quyền khi đã được xét duyệt'],
                                'status' => 0
                            ]);
                        }
                    }
    
                    
                    $novel->sNovel = $data['tentruyen'];
                    $novel->sDes = htmlspecialchars($data['motatruyen']);
                    $novel->sProgress = $data['tiendo'];
    
                    $novel->save();

                    
                    Classify::where('idNovel', $idnovel)->delete();

                    foreach ($data['theloai'] as $id_cat) {
                        $clasifi = new Classify();
                        $clasifi->idNovel = $idnovel;
                        $clasifi->idCategories = $id_cat;

                        $clasifi->save();
                    }

                    return response()->json([
                        'message' => 'Cập nhật truyện thành công',
                        'status' => 1
                    ]);

                } else {
                    return response()->json([
                        'errors' => ['Nguoidung_quyen' => 'Bạn không có quyền cập nhật truyện này'],
                        'status' => 1
                    ]);
                }
    
            } else {
                return response()->json([
                    'errors' => ['Nguoidung' => 'Không tìm thấy người dùng'],
                    'status' => 0
                ]);
            }

            dd($data['theloai']);
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Không tìm thấy người dùng'],
                'status' => 0
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

    public function Danh_sachtruyen_tacgia()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $novels = Novel::orderBy('id', 'DESC')->where('idUser',$id)->get();
            return view('author.novel.novel_list', [
                'novels' => $novels,
            ]);

        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Không tìm thấy người dùng'],
                'status' => 1
            ]);
        }
    }

    public function quan_ly_truyen($id)
    {
        $novel = Novel::find($id);
        $chapters = Chapter::orderBy('iChapterNumber', 'ASC')->where('idNovel',$id)->get();
        $theloai = Classify::orderby('id', 'ASC')->where('idNovel',$id)->get();
        return view('author.novel.novel_index',[
           'novel' =>$novel,
           'chapters' => $chapters,
           'theloai' => $theloai
        ]);
    }

    public function chi_tiet_truyen($id)
    {
        $novel = Novel::find($id);
        $chapters = Chapter::orderBy('id', 'DESC')->where('idNovel',$id)->get();
        $theloai = Classify::orderby('id', 'ASC')->where('idNovel',$id)->get();
        $cats = Categories::orderby('id', 'ASC')->get();
        return view('admincp.admin_page.novel_index',[
           'novel' =>$novel,
           'chapters' => $chapters,
           'theloai' => $theloai,
           'cats' => $cats
        ]);
    }

    public function xetduyet(Request $request, $idnovel)
    {
        $novel = Novel::find($idnovel);
       
        if (isset($request['xuly_novel'])) {
            $novel->iLicense_Status = $request['xuly_novel'];
        }

        if (isset($request['trangthai_novel'])) {
            $novel->iStatus = $request['trangthai_novel'];
        }

        if (isset($request['trangthai_novel']) || isset($request['xuly_novel'])) {
            $novel->save();

            return response()->json([
                'message' => 'Cập nhật thành công',
                'status' =>1
            ]);

        } else {
            return response()->json([
                'message' => 'Bạn chưa thay đổi gì cả',
                'status' =>1
            ]);
        }
    }
        
    public function danhsach_xetduyet()
    {
        return view('admincp.admin_page.admin_xetduyet_tacpham');
    }

    public function page_kiem_duyet_chuong($id)
    {
        $novel = Novel::find($id);
        $chapters = Chapter::orderBy('iChapterNumber', 'ASC')->where('idNovel',$id)->get();
        return view('admincp.admin_page.admin_xetduyet_chuong',[
            'novel' =>$novel,
            'chapters' => $chapters
        ]);
    }

    public function page_tim_kiem(Request $request)
    {
        $name = $request->input('novel_name');
        // $novels = Novel::whereRaw('LOWER(sNovel) LIKE ?', ['%' . strtolower($name) . '%']);
        $novels = Novel::select(
                'tblnovel.id as novelId',
                'tblnovel.sNovel',
                'tblnovel.sCover',
                'tblnovel.sDes',
                'tblnovel.dCreateDay as novelCreateDay',
                'tblnovel.dUpdateDay',
                'tblnovel.sProgress',
                'tblnovel.iStatus',
                'tblnovel.idUser',
                'tblnovel.iLicense_Status',
                'tblnovel.sLicense',
                'users.id as authorId',
                'tblauthor.sNickName as sNickName ',
                'users.name as authorName',
                'users.email as authorEmail',
                'users.sRole as authorRole',
                'users.sAvatar as authorAvatar',
                'users.sAdress as authorAddress',
                'users.dBirthday as authorBirthday',
                DB::raw('COUNT(tblreading_history.id) as totalReads'),
                DB::raw('COUNT(DISTINCT tblchapter.id) as totalChapters'),
                DB::raw('COALESCE(AVG(tblcomment.sPoint), 0) AS averagePoints'))

                ->join('tblchapter', 'tblnovel.id', '=', 'tblchapter.idNovel')
                ->leftJoin('tblreading_history', 'tblchapter.id', '=', 'tblreading_history.idChapter')
                ->join('users', 'tblnovel.idUser', '=', 'users.id')
                ->join('tblauthor', 'tblnovel.idUser', '=', 'tblauthor.idUser')
                ->leftJoin('tblcomment', function($join) {
                    $join->on('tblnovel.id', '=', 'tblcomment.idNovel')
                         ->whereNull('tblcomment.id_Comment_parent')
                         ->where('tblcomment.iDelete', 0);
                })
                ->where('tblnovel.iLicense_Status', 1)
                ->where('tblnovel.iStatus', 1)
                ->where('tblchapter.iPublishingStatus', 1)
                ->where('tblchapter.iStatus', 1)
                ->whereRaw('LOWER(tblnovel.sNovel) LIKE ?', ['%' . strtolower($name) . '%'])
                ->groupBy('tblnovel.id', 
                'users.id',
                'tblnovel.sNovel',
                'tblnovel.sCover',
                'tblnovel.sDes',
                'tblauthor.id',
                'tblnovel.dCreateDay',
                'tblnovel.dUpdateDay',
                'tblnovel.sProgress',
                'tblnovel.iStatus',
                'tblnovel.idUser',
                'tblnovel.iLicense_Status',
                'tblnovel.sLicense',
                'users.id',
                'tblauthor.sNickName',
                'users.name',
                'users.email',
                'users.sRole',
                'users.sAvatar',
                'users.sAdress',
                'users.dBirthday',);

        $Search_type_id = [];
        $sapxep = '';
        $author_name = '';
        $tiendo = '';
    
        if ($request->has('theloai') && !empty($request->input('theloai'))) {
            $Search_type_id = $request->input('theloai');
            $totalCategories = count($Search_type_id);
            $id_novel_cat = DB::table('tblnovel as n')
                            ->join('tblclassify as c', 'n.id', '=', 'c.idNovel')
                            ->select('n.id')
                            ->whereIn('c.idCategories', $Search_type_id)
                            ->groupBy('n.id')
                            ->havingRaw('COUNT(DISTINCT c.idCategories) = ?', [$totalCategories])
                            ->pluck('n.id');

            $novels = $novels->whereIn('tblnovel.id', $id_novel_cat);
        }
    

        if ($request->has('sapxep') && !empty($request->input('sapxep'))) {
            $sapxep = $request->input('sapxep');
            
            if ($sapxep === 'luot_doc') {
                $novels->orderBy('totalReads', 'desc');
            }
    
            if ($sapxep === 'cap_nhat') {
                $novelIds = DB::table('tblnovel as n')
                        ->select('n.id as idNovel')
                        ->join('tblchapter as c', 'n.id', '=', 'c.idNovel')
                        ->where('c.dCreateDay', '=', function($query) {
                            $query->select(DB::raw('MAX(dCreateDay)'))
                                ->from('tblchapter')
                                ->whereColumn('idNovel', 'n.id')
                                ->where('iPublishingStatus', 1);
                        })
                        ->orderBy('c.dCreateDay', 'desc')
                        ->pluck('idNovel')
                        ->toArray(); 

                $novels = $novels->orderByRaw(DB::raw("FIELD(novelId, " . implode(',', $novelIds) . ")"));
            }

            if ($sapxep === 'danh_gia') {
                $novels->orderBy('averagePoints', 'desc');
            }
        }
    
        if ($request->has('author_name') && !empty($request->input('author_name'))) {
            $author_name = $request->input('author_name');
            $novels = $novels->whereRaw('LOWER(tblauthor.sNickName) LIKE ?', ['%' . strtolower($author_name) . '%']);
        }

        if ($request->has('tiendo') && !empty($request->input('tiendo'))) {
            $tiendo = $request->input('tiendo');
            $novels = $novels->where('tblnovel.sProgress', $tiendo);
        }
    

        $novels = $novels->get();
    
        return view('search.search_page', [
            'novels' => $novels,
            'name' => $name,
            'ispage_timkiem' => true,
            'Search_type_id' => $Search_type_id,
            'sapxep' => $sapxep,
            'author_name' => $author_name,
            'tiendo' =>$tiendo
        ]);
    }
    public function danhsach_truyencochuongchuaduocxetduyet()
    {
        return view('admincp.admin_page.admin_tacphamchuaduyet');
    }
    
}
