<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class registerTest extends TestCase
{
    use refreshDatabase;

    /**
     * @test status PASS
     * 
     * register user with valid data
     * checks http status and redirects to /login
     * 
     * checks if record added to user table with 
     * account_status set to NEW
     *
     * @return void
     */
    public function test_register_with_correct_data()
    {

        $formData = [
            'first_name' => 'andrew',
            'last_name' => 'shal',
            'email' => 'shalandrew97@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '5016244690',
            'password' => 'Helloworld1',
            'password_confirmation' => 'Helloworld1'
        ];

        $response = $this->call('POST', '/register', $formData);

        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertEquals(1, DB::table('users')->count());
        $this->assertDatabaseHas('users', [
            'email' => 'shalandrew97@gmail.com',
            'account_status' => 'NEW'
        ]);
    }

    /**
     * @test status FAIL
     * 
     * register user with an existing email
     * checks http status and check error message
     * also checks num of records in db table 'users'
     * we expect 2 but will be 1 due to email not being unique 
     * 
     *
     * @return void
     */
    public function test_register_with_existing_email()
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

        $formData = [
            'first_name' => 'andrew',
            'last_name' => 'shal',
            'email' => 'shalandrew97@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '5016244690',
            'password' => 'Helloworld1',
            'password_confirmation' => 'Helloworld1'
        ];

        $response = $this->call('POST', '/register', $formData);

        $response->assertStatus(302);

        $errors = session('errors');
        $response->assertSessionHasErrors([
            'email' => 'The email has already been taken.'
        ]);
        $this->assertEquals('The email has already been taken.', $errors->get('email')[0]);

        $this->assertEquals(2, User::count());
    }

    /**
     * @test status FAIL
     * 
     * register user with amin password strength requirements
     * checks http status and check error message
     * also checks num of records in db table 'users'
     * we expect 1 but will be 0 due to password not meeting
     * min criteria
     *
     * @return void
     */
    public function test_register_with_min_password_strength()
    {

        $formData = [
            'first_name' => 'andrew',
            'last_name' => 'shal',
            'email' => 'shalandrew97@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '5016244690',
            'password' => 'helloworld',
            'password_confirmation' => 'helloworld'
        ];

        $response = $this->call('POST', '/register', $formData);

        $response->assertStatus(302);

        $errors = session('errors');
        $response->assertSessionHasErrors([
            'password' => 'Your password must contain 1 lower case character 1 upper case character one number.'
        ]);
        $this->assertEquals('Your password must contain 1 lower case character 1 upper case character one number.', $errors->get('password')[0]);

        $this->assertEquals(1, User::count());
    }

    /**
     * @test status FAIL
     * 
     * register user with a phone number greater than the
     * required length
     * checks http status and check error message
     * also checks num of records in db table 'users'
     * we expect 1 but will be 0 due to phone number
     *  not meeting min criteria
     *
     * @return void
     */
    public function test_register_with_phone_number_greater_than_ten_digits()
    {

        $formData = [
            'first_name' => 'andrew',
            'last_name' => 'shal',
            'email' => 'shalandrew97@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '624469082938293892472948',
            'password' => 'Helloworld1',
            'password_confirmation' => 'Helloworld1'
        ];

        $response = $this->call('POST', '/register', $formData);

        $response->assertStatus(302);

        $errors = session('errors');
        $response->assertSessionHasErrors([
            'phone_number' => 'The phone number may not be greater than 10 characters.'
        ]);
        $this->assertEquals('The phone number may not be greater than 10 characters.', $errors->get('phone_number')[0]);

        $this->assertEquals(1, User::count());
    }

    /**
     * @test status FAIL
     * 
     * register user with a phone number min than the
     * required length
     * checks http status and check error message
     * also checks num of records in db table 'users'
     * we expect 1 but will be 0 due to phone number
     *  not meeting min criteria
     *
     * @return void
     */
    public function test_register_with_phone_number_less_than_ten_digits()
    {

        $formData = [
            'first_name' => 'andrew',
            'last_name' => 'shal',
            'email' => 'shalandrew97@gmail.com',
            'cust_country' => 'belize',
            'cust_city' => 'Belmopan',
            'cust_street' => 'mystreet',
            'phone_number' => '6244690',
            'password' => 'Helloworld1',
            'password_confirmation' => 'Helloworld1'
        ];

        $response = $this->call('POST', '/register', $formData);

        $response->assertStatus(302);

        $errors = session('errors');
        $response->assertSessionHasErrors([
            'phone_number' => 'The phone number must be at least 10 characters.'
        ]);
        $this->assertEquals('The phone number must be at least 10 characters.', $errors->get('phone_number')[0]);

        $this->assertEquals(1, User::count());
    }

    /**
     * @test status FAIL
     * 
     * register user with empty 
     * required fields in one go
     * checks http status and check error message
     * also checks num of records in db table 'users'
     * we expect 1 but will be 0 due to phone number
     *  not meeting min criteria
     *
     * @return void
     */
    public function test_register_with_empty_required_fields()
    {


        $formData = [
            'first_name' => '',
            'last_name' => '',
            'email' => '',
            'cust_country' => '',
            'cust_city' => '',
            'cust_street' => '',
            'phone_number' => '',
            'password' => '',
            'password_confirmation' => ''
        ];

        $response = $this->call('POST', '/register', $formData);

        $response->assertStatus(302);

        $errors = session('errors');
        $response->assertSessionHasErrors([
            'phone_number' => 'The phone number field is required.',
            'first_name' => 'The first name field is required.',
            'last_name' => 'The last name field is required.',
            'email' => 'The email field is required.',
            'cust_country' => 'The cust country field is required.',
            'cust_city' => 'The cust city field is required.',
            'cust_street' => 'The cust street field is required.',
            'password' => 'The password field is required.'
        ]);

        $this->assertEquals(1, User::count());
    }
}
