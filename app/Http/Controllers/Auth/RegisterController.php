<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



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
    protected $redirectTo = '/home';

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
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * The user is created with the uploaded photo profile.
     * @param  array  $data
     * @return User
     */
    protected function createWithPicture(Request $request )
    {
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'born_date' => $request->birth,
            'picture' => '/images/users/defualt_photo_profile.jpeg',

            'password' => bcrypt($request->password),
        ]);

        $file = $request->picture;
        // Now you have your file in a variable that you can do things with
        $name = 'user'.'1'.'.png';
        $path = '/storage/users/'.$name;
        Storage::disk('public')->put('/users/'.$name, file_get_contents($file));
        try{
            $user->picture=$path;
            $user->save();
            $success = 'The operation has succeed';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $error = 'The operation has failed';
            \Session::flash('error', $error);
            Log::info($e);
        }
        return $user;
    }
    /**
     * Create a new user instance after a valid registration.
     * The user is created with the default photo profile.
     * @param  array  $data
     * @return User
     */
    protected function createWithoutPicture(array $data)
    {
        dd('no tiene archivo');
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'born_date' => $data['birth'],
            'picture' => '/images/users/defualt_photo_profile.jpg',

            'password' => bcrypt($data['password']),
        ]);
    }
}
