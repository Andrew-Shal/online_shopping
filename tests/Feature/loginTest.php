<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class loginTest extends TestCase
{

    use refreshDatabase;
    /**
     *@test status PASS
     *login user with correct credentials
     *use factory to add a user to db
     *check if user is authenticated
     *we expect authenticated to be true
     *
     * @return void
     */
    public function test_login_with_correct_credentials()
    {
        factory(User::class)->create([
            'first_name' => 'andrew',
            'last_name' => 'shal',
            'email' => 'shalandrew97@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '5016244690',
            'password' => Hash::make('Helloworld1')
        ]);

        $formData = ['email' => 'shalandrew97@gmail.com', 'password' => 'Helloworld1'];
        $response = $this->call('POST', '/login', $formData);
        $response->assertStatus(302);
        $this->assertTrue(Auth::check());
        $response->assertRedirect('/dashboard');
    }

    /**
     *@test status FAIL
     *login user with incorrect credentials
     *use factory to add a user to db
     *checks if user is authenticated
     *expects authenticated to be false
     *expects error messages
     *due to incorrect credentials
     *
     * @return void
     */
    public function test_login_with_incorrect_credentials()
    {
        factory(User::class)->create([
            'first_name' => 'andrew',
            'last_name' => 'shal',
            'email' => 'shalandrew97@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '5016244690',
            'password' => Hash::make('Helloworld1')
        ]);

        $formData = ['email' => 'shalandrew97@gmail.com', 'password' => 'shjjksj'];
        $response = $this->call('POST', '/login', $formData);
        $response->assertStatus(302);

        $errors = session('errors');
        $response->assertSessionHasErrors([
            'email' => 'These credentials do not match our records.'
        ]);

        $this->assertTrue(Auth::check());
    }

    /**
     *@test status FAIL
     *login user with empty required fields
     *use factory to add a user to db
     *checks if user is authenticated
     *expects authenticated to be false
     *expects error messages
     *due to incorrect credentials
     *
     * @return void
     */
    public function test_login_with_no_password_and_no_email()
    {
        factory(User::class)->create([
            'first_name' => 'andrew',
            'last_name' => 'shal',
            'email' => 'shalandrew97@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '5016244690',
            'password' => Hash::make('Helloworld1')
        ]);

        $formData = ['email' => '', 'password' => ''];
        $response = $this->call('POST', '/login', $formData);
        $response->assertStatus(302);

        $errors = session('errors');
        $response->assertSessionHasErrors([
            'password' => 'The password field is required.',
            'email' => 'The email field is required.'
        ]);

        $this->assertEquals('The password field is required.', $errors->get('password')[0]);
        $this->assertEquals('The email field is required.', $errors->get('email')[0]);

        $this->assertTrue(Auth::check());
    }
}
