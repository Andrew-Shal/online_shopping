<?php

namespace Tests\Feature;

use App\User;
use App\Product;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class viewProductTest extends TestCase
{
    use refreshDatabase;
    /**
     * @test status PASS
     * view an  existing product
     * via a route /products/{id}/{name}
     * expects to get a product's data
     * as an object
     * compares factory added product data
     * with retreived data from route 
     * 
     * @return void
     */
    public function test_view_a_product_details_using_valid_product_uri()
    {

        $p_id = 1;
        $p_name = 'bikini';

        factory(User::class)->create([
            'id' => 1,
            'first_name' => 'andrew',
            'last_name' => 'shal',
            'email' => 'shalandrew97@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '5016244690',
            'password' => Hash::make('Helloworld1')
        ]);

        factory(Product::class)->create([
            'id' => $p_id,
            'name' => $p_name,
            'current_price' => 10,
            'qty' => 30,
            'description' => 'this is a test',
            'condition' => 'test',
            'return_policy' => 'test',
            'user_id' => 1,
            'ecat_id' => 1
        ]);

        $uri = "/products/$p_id/$p_name";

        $response = $this->call('GET', $uri);
        $response->assertViewis('products.productdetail');
        $response->assertViewHas('product');

        $productReturned = $response->original['product'];
        $this->assertEquals($p_id, $productReturned->id);
        $this->assertEquals($p_name, $productReturned->name);
        $this->assertEquals(10, $productReturned->current_price);
        $this->assertEquals(30, $productReturned->qty);
        $this->assertEquals('this is a test', $productReturned->description);
        $this->assertEquals('test', $productReturned->condition);
        $this->assertEquals('test', $productReturned->return_policy);
        $this->assertEquals(1, $productReturned->user_id);
        $this->assertEquals(1, $productReturned->ecat_id);
        $response->assertStatus(200);  //stat ok
    }

    /**
     * @test status PASS
     * view a non existing product
     * via a route /products/{id}/{name}
     * expects to be redirected to /produts route
     * with redirect status 302
     * 
     * @return void
     */
    public function test_view_a_product_details_using_invalid_product_uri()
    {
        $p_id = 1;
        $p_name = 'bikini';

        $uri = "/products/$p_id/$p_name";
        $response = $this->call('GET', $uri);
        $response->assertStatus(302);
        $response->assertRedirect('/products');
    }
}
