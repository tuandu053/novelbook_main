<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function themtheloai(Request $request) {
        $data = $request ->all();
        return response()->json([
            'message' => 'Categoray phogn successfully',
            'phong' => $data['tentheloai'],
            'phoang' => $data['_token']
        ]);
    }
}
