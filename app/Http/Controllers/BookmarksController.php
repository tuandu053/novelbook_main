<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookmarks;
use Illuminate\Support\Facades\Auth;

class BookmarksController extends Controller
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
        if (Auth::check()) {
            $iduser = Auth::user()->id;
            $bookmark = Bookmarks::where('idUser',$iduser)->where('idNovel', $request['id_novel'])->first();

            if($bookmark) {
                $bookmark->delete();

                $text = 'Đánh dấu';
                $status = 1;

            } else {
                $bookmark = new Bookmarks();
                $bookmark->idUser = $iduser;
                $bookmark->idNovel  = $request['id_novel'];
                $bookmark->save();

                $text = 'Hủy đánh dấu';
                $status = 0;
            }
        } else {
            $text = 'Đánh dấu';
            $status = 3;
        }

        $bookmarks = Bookmarks::where('idNovel',$request['id_novel'])->get()->count();
        $icon = '<i class="fa-solid fa-bookmark me-2" aria-hidden="true"></i>';
        return response()->json([
            'message' =>  $icon.$text,
            'status' => $status,
            'bookmarks' => $bookmarks
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        // 
    }
    public function bookmark_remove($id)
    {
        $message ='';
        $status ='';
        if (Auth::check()) {
            $iduser = Auth::user()->id;
            $bookmark = Bookmarks::where('idUser',$iduser)->where('idNovel', $id)->first();

            if($bookmark) {
                $bookmark->delete();
                $message = 'Xóa dấu trang thành công';
                $status = 1;
            } else {
                return response()->json([
                    'errors' => ['Nguoidung' => 'không tìm thấy dấu trang'],
                    'status' => 0,
                ]);
            }
        } else {
            return response()->json([
                'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                'status' => 0,
            ]);
        }

        return response()->json([
            'message' => $message,
            'status' => $status,
            'bookmarks'=>view('user.user_bookmark')->render()
        ]);

    }
}
