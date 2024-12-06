<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Categories;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = Categories::orderby('id', 'ASC')->get();
        return view('admincp.Categories.index')->with(compact('cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.Categories.create');
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
                    'tentheloai' => ['required', 'string', 'max:50', 'unique:tblcategories,sCategories'],
                    'motatheloai' => ['required', 'string', 'max:5000'],
                    'trangthai' => ['required']
                ],
                [
                    'tentheloai.required' => 'Tên thể loại không được để trống',
                    'tentheloai.string' => 'Tên thể loại phải là các ký tự',
                    'tentheloai.max' => 'Tên thể loại không được nhiều hơn 500 ký tự',
                    'tentheloai.unique' => 'Thể loại đã tồn tại',
                    'motatheloai.required' => 'Mô tả thể loại không được để trống',
                    'motatheloai.string' => 'Mô tả thể loại phải là các ký tự',
                    'motatheloai.max' => 'Mô tả thể loại không được nhiều hơn 5000 ký tự',
                    'trangthai.required' => 'trạng thái thể loại không được để trống'
                ]
            );

            if (!Auth::check()) { 
                return response()->json([
                    'errors' => ['Nguoidung' => 'Bạn chưa đăng nhập'],
                    'status' => 0
                ]);
            }

            if (Auth::user()->sRole != 'admin') { 
                return response()->json([
                    'errors' => ['Nguoidung' => 'Bạn không có quyền thêm mới thể loại'],
                    'status' => 0
                ]);
            }


            $cat = new Categories();
            $cat->sCategories = $data['tentheloai'];
            $cat->sDes = $data['motatheloai'];
            $cat->iStatus = $data['trangthai'];
            $cat->save();

            return response()->json([
                'message' => 'Thể loại mới thêm thành công',
                'status' =>1
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
        $cat = Categories::find($id);
        return view('admincp.Categories.edit')->with(compact('cat'));
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
                'tentheloai' => ['required', 'string', 'max:500', Rule::unique('tblcategories', 'sCategories')->ignore($id),],
                'motatheloai' => ['required', 'string', 'max:5000'],
                'trangthai' => ['required']
            ],
            [
                'tentheloai.required' => 'Tên thể loại không được để trống',
                'tentheloai.string' => 'Tên thể loại phải là các ký tự',
                'tentheloai.max' => 'Tên thể loại không được nhiều hơn 500 ký tự',
                'tentheloai.unique' => 'Thể loại đã tồn tại',
                'motatheloai.required' => 'Mô tả thể loại không được để trống',
                'motatheloai.string' => 'Mô tả thể loại phải là các ký tự',
                'motatheloai.max' => 'Mô tả thể loại không được nhiều hơn 5000 ký tự',
            ]
        );

        // $data = $request-> all();
        // dd($data);
        $cat = Categories::find($id);
        $cat->sCategories = $data['tentheloai'];
        $cat->sDes = $data['motatheloai'];
        $cat->iStatus = $data['trangthai'];
        $cat->save();

        return response()->json([
            'message' => 'Sửa thể loại thành công',
            'status' =>1
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
}
