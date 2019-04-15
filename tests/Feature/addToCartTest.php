<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class addToCartTest extends TestCase
{
    use refreshDatabase;
    /**
     * @test status PASS
     * we create 2 users, 2 products
     * associate to a user(seller)
     * and call route /cart as buyer
     * we expect item to be added to the cart with
     * we check if the session has the cart
     * we check if the cart has expected qty
     * we check if cart has product details
     *
     * @return void
     */
    public function test_add_a_valid_item_to_cart()
    {
        //add user to db
        $buyer = factory(User::class)->create([
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

        $seller = factory(User::class)->create([
            'id' => 2,
            'first_name' => 'user2',
            'last_name' => 'test',
            'email' => 'test@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '5016244690',
            'password' => Hash::make('Helloworld1')
        ]);

        $shoe = factory(Product::class)->create([
            'id' => 1,
            'name' => 'shoe',
            'current_price' => 15,
            'qty' => 30,
            'description' => 'this is a test',
            'condition' => 'test',
            'return_policy' => 'test',
            'user_id' => $seller->id,
            'ecat_id' => 1
        ]);

        $football = factory(Product::class)->create([
            'id' => 2,
            'name' => 'football',
            'current_price' => 10,
            'qty' => 30,
            'description' => 'this is a test',
            'condition' => 'test',
            'return_policy' => 'test',
            'user_id' => $seller->id,
            'ecat_id' => 1
        ]);

        $data = [
            'id' => $shoe->id
        ];

        $this->be($buyer)
            ->call('POST', '/cart', $data)
            ->assertStatus(302)
            ->assertRedirect('/cart')
            ->assertSessionHas('cart');

        $session = session('cart');
        $this->assertEquals(1, $session->totalQty);
        $this->assertEquals(15, $session->totalPrice);

        $data = [
            'id' => $football->id
        ];

        $this->be($buyer)
            ->call('POST', '/cart', $data)
            ->assertStatus(302)
            ->assertRedirect('/cart')
            ->assertSessionHas('cart');

        $session = session('cart');
        $this->assertEquals(2, $session->totalQty);
        $this->assertEquals(25, $session->totalPrice);
    }
}
