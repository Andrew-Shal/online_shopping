<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use DB;

class addProductTest extends TestCase
{
    use refreshDatabase;
    /**
     * @test status PASS
     * use factory to creat a user
     * impersonate the user and add a product
     * with correct data
     * checks db if 'products' table has a single record
     * associated with the user id being impersonated
     * asserts redirect status
     *
     * @return void
     */
    public function test_add_a_product_with_valid_data()
    {
        $u_id = 10;

        //add user to db
        $user = factory(User::class)->create([
            'id' => $u_id,
            'first_name' => 'andrew',
            'last_name' => 'shal',
            'email' => 'shalandrew97@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '5016244690',
            'password' => Hash::make('Helloworld1'),
            'seller_panel_enabled' => 1
        ]);


        //create form data
        $productData = [
            'name' => 'bikini',
            'current_price' => 10,
            'qty' => 30,
            'description' => 'this is a test',
            'condition' => 'test',
            'return_policy' => 'test',
            'ecat_id' => 1
        ];

        $response = $this->be($user)->call('POST', 'admin/dashboard/products', $productData);
        $this->assertEquals(1, DB::table('products')->count());
        $this->assertDatabaseHas('products', [
            'user_id' => $u_id
        ]);
        $response->assertStatus(302);
    }

    /**
     * @test status FAIL
     * Access route POST admin/dashboard/products to add a product
     * without being logged in
     * 
     * checks if redirected to /login route
     * checks db if 'products' table has a single record
     * asserts redirect status to 302
     *
     * @return void
     */
    public function test_add_a_product_without_being_logged_in()
    {
        //create form data
        $productData = [
            'name' => 'bikini',
            'current_price' => 10,
            'qty' => 30,
            'description' => 'this is a test',
            'condition' => 'test',
            'return_policy' => 'test',
            'ecat_id' => 1
        ];

        $response = $this->call('POST', 'admin/dashboard/products', $productData);
        $this->assertEquals(1, DB::table('products')->count());
        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }

    /**
     * @test status PASS
     * use factory to create a user
     * impersonate the user and add a product
     * with required fields empty
     * checks db if 'products' table has a single record
     * associated with the user id being impersonated
     * asserts redirect status
     * check error messages returned
     *
     * @return void
     */
    public function test_add_a_product_with_required_fields_empty()
    {
        $u_id = 10;

        //add user to db
        $user = factory(User::class)->create([
            'id' => $u_id,
            'first_name' => 'andrew',
            'last_name' => 'shal',
            'email' => 'shalandrew97@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '5016244690',
            'password' => Hash::make('Helloworld1'),
            'seller_panel_enabled' => 1
        ]);


        //create form data
        $productData = [
            'name' => '',
            'current_price' => '',
            'qty' => '',
            'description' => '',
            'condition' => '',
            'return_policy' => '',
            'ecat_id' => ''
        ];

        $response = $this->be($user)->call('POST', 'admin/dashboard/products', $productData);
        $response->assertStatus(302);

        $response->assertSessionHasErrors([
            'name' => 'The name must be a string.',
            'current_price' => 'The current price field is required.',
            'qty' => 'The qty field is required.'
        ]);

        $this->assertEquals(1, DB::table('products')->count());
        $this->assertDatabaseHas('products', [
            'user_id' => $u_id
        ]);
    }
}
