<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Novel;

class NovelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_novel_create()
    {
        
        $data = [
            'sCover'=>'uuuuuu',
            'sNovel'=>'Test123456',
            'sDes'=>'12322222222245',
            'sProgress'=>'1',
            'iStatus'=>'1',
            'idUser'=>'45',
            'iLicense_Status'=>'1',
            'sLicense'=>'sdfghjk'
        ];
        Novel::create($data);

        // // Gửi yêu cầu POST để tạo người dùng mới
        // $response = $this->post('/them-the-loai', $data);
        $response = $this->get('/Danh_sach_truyen');

        // // Kiểm tra trạng thái phản hồi
        $response->assertStatus(200);
        // $response->assertRedirect('/');
        $response->assertDontSee(_('No category found'));
        

        // // // Kiểm tra xem người dùng mới đã được tạo trong cơ sở dữ liệu
        // // $this->assertDatabaseHas('users', [
        // //     'email' => 'john@example.com',
        // // ]);


    }
}

