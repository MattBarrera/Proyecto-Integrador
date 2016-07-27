<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use File;
use Storage;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $usuarioNuevo = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'avatar' => 'avatar_2x.png',
            'birthdate' => $data['birthdate'],
            'password' => bcrypt($data['password']),
            'status' => 1,
        ]);
        //crear directorio de usuario
        $directory = "/assets/$usuarioNuevo->id";
        // dd($directory);
        umask(0);
            Storage::makeDirectory($directory);

        // dd($usuarioNuevo->id);
        $directory = $directory . "/assets/".$id."/profile/";
        umask(0);
                
                if (!is_dir($directory) ) {
                    mkdir($directory,0777,true);
                }
        
        return $usuarioNuevo;
    }
}
