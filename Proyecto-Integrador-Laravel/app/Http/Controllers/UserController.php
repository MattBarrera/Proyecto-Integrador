<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Storage;
use App\Producto;
use App\User;
use App\Follower;
use App\Genero;
use Illuminate\Http\Request;
use App\Http\Requests;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::check()){
            if($id == Auth::user()->id){
                return redirect('/MyProducts');
            }
        }

        $user = User::findOrFail($id);
        $productos = Producto::where('users_id',$id)->with('usuario','categoria')->get();
        $follower = Follower::where('users_id1',$id)->where('users_id',Auth::user()->id)->first();
        // dd($follower);
        
        return view('Users.ShowUser',['user'=>$user,'productos'=>$productos,'follower'=>$follower]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $generos = Genero::all();
        // dd($user);

        return view('Users.MyAcount',['user'=>$user,'generos'=>$generos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        // Validator::extend('password_anterior', function ($attribute, $value, $parameters, $validator) {

        //     return Hash::check($value, current($parameters));
        // });

        $user = User::findOrFail($id);
        // dd($user->password);
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'lastname' => 'required',
        //     // 'password_anterior'=>'password_anterior:' . $user->password,
        //     // 'password'=>'confirmed',
        // ]);

        // if ($request->input('password' !== "")) {
        //     $validator = Validator::make($request->all(), [
        //         'password_anterior'=>$user->password,
        //         'password'=>'min:6|confirmed',
        // ]); 
        // if($validator->fails()){
        //     return redirect('/User/'.$user->id.'/edit')
        //                 ->withErrors($validator)
        //                 ->withInput();
        // };

        // dd($request->input('avatar'));
        $user->fill($request->only('name','lastname','phone','email','gender','birthdate','avatar'));
        if ($request->input('avatar') !== "") {
            $destinationPath = '/public/assets/'.$user->id.'/profile/';
            $fileName = input::file('avatar')->getClientOriginalName();
            input::file('avatar')->move(public_path().'/assets/'.$user->id.'/profile/', $fileName);

            $user->avatar = $fileName;
        }
        // dd($user);
        $user->save();
        return redirect('/Store');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
