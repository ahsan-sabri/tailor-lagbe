<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $roles = config('constants.roles');
        unset($roles['admin']);
        $rolesKeyList = array_keys($roles);
        $rolesStr = implode(",", $rolesKeyList);
        unset($roles['customer']);
        $nonCustomerRolesKeyList = array_keys($roles);
        $nonCustomerRolesStr = implode(",", $nonCustomerRolesKeyList);
        $storeRole = 'store';
        // dd($rolesStr, $nonCustomerRolesStr);

        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15|unique:users',
            'user_type' => 'required|string|max:100|in:'.$rolesStr,
            'owner_name'  => 'required_if:user_type,==,'.$storeRole. '|nullable|string|max:255',
            'shop_name'  => 'required_if:user_type,in:'.$nonCustomerRolesStr. '|nullable|string|max:255',
            'service'  => 'required_if:user_type,in:'.$nonCustomerRolesStr.'|nullable|integer',
            'location'  => 'required_if:user_type,in:' . $nonCustomerRolesStr . '|nullable|string|max:255',
            'tin'  => 'required_if:user_type,in:' . $nonCustomerRolesStr . '|nullable|string|max:255',
            'website'  => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Auth\User
     */
    protected function create(array $data)
    {
        // dd($data);
        $data['password'] = Hash::make($data['password']);

        return User::create($data
            // 'name' => $data['name'],
            // 'email' => $data['email'],
            // 'password' => Hash::make($data['password']),
        );
    }
}
