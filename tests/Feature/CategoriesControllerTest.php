<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Categories;
use App\Models\User;
use App\Http\Controllers\CategoriesController;

class CategoriesControllerTest extends TestCase
{
    // use RefreshDatabase; //
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_category_empty_table()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_category_create()
    {
        
        $data = [
            'sCategories' => 'Van hoc',
            'sDes' => 'van hoc novel',
            'iStatus' => '1',
        ];
        Categories::create($data);

        // // Gửi yêu cầu POST để tạo người dùng mới
        // $response = $this->post('/them-the-loai', $data);
        $response = $this->get('/danh-sach-the-loai');

        // // Kiểm tra trạng thái phản hồi
        $response->assertStatus(200);
        // $response->assertRedirect('/');
        $response->assertDontSee(_('No category found'));
        

        // // // Kiểm tra xem người dùng mới đã được tạo trong cơ sở dữ liệu
        // // $this->assertDatabaseHas('users', [
        // //     'email' => 'john@example.com',
        // // ]);


    }
    public function test_category_create_many()
    {
        
        // for($i = 1; $i <= 11; $i++){
        //     Categories::create([
        //         'sCategories' => 'Van hoc' . $i,
        //         'sDes' => rand(100,999),
        //         'iStatus' => '1',
        //         'id' => 40
        //     ]);
        // }
        $category = Categories::factory(11)->create();
            // dd($category);
        // // Gửi yêu cầu POST để tạo người dùng mới
        // $response = $this->post('/them-the-loai', $data);
        $response = $this->get('/danh-sach-the-loai');

        // // Kiểm tra trạng thái phản hồi
        $response->assertStatus(200);
        $response->assertDontSee(_('No category found'));
        

        // // // Kiểm tra xem người dùng mới đã được tạo trong cơ sở dữ liệu
        // // $this->assertDatabaseHas('users', [
        // //     'email' => 'john@example.com',
        // // ]);


    }
    public function test_category_update()
    {
        
        
        $category = [
            'sCategories' => 'Old Name',
            'sDes' => 'van hoc novel',
            'iStatus' => '1',
        ];
        $category = Categories::create($category);

        $updateData = [
            'sCategories' => 'New Name',
            'sDes' => 'New Description',
            'iStatus' => '0',
        ];
        $response = $this->post(route('Categories.update', $category->id), $updateData);

        $response->assertStatus(200);
        // // Kiểm tra dữ liệu đã được cập nhật trong cơ sở dữ liệu
        // $this->assertDatabaseHas('tblcategories', [
        //     'id' => $category->id,
        //     'sCategories' => 'New Name',
        //     'iStatus' => '0'
        // ]);

        // // Kiểm tra dữ liệu cũ không còn trong cơ sở dữ liệu
        // $this->assertDatabaseMissing('tblcategories', [
        //     'id' => $category->id,
        //     'sCategories' => 'Old Name',
        //     'iStatus' => '1'
        // ]);
        // // Kiểm tra trạng thái phản hồi
    
        

        // // // Kiểm tra xem người dùng mới đã được tạo trong cơ sở dữ liệu
        // // $this->assertDatabaseHas('users', [
        // //     'email' => 'john@example.com',
        // // ]);


    }
    public function test_category_table()
    { 
        $user = User::factory() ->create();
        $response = $this->actingAs($user)->get(route('Categories.index'));

        $response->assertStatus(200);
    }
    public function test_category_detail()
    { 
        $response = $this->get(route('Categories.show', 100));

        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_access_category()
    {
        $user = User::factory() ->create();
        $response = $this->actingAs($user)->get(route('User.admin',$user->id));

        $response->assertStatus(200);
        // $response->assertRedirect('/password/reset');
    }
}
