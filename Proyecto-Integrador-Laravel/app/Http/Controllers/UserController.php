<?php

namespace App\Http\Controllers;

use Hash;
use Auth;
use Storage;
use App\User;
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
                return redirect('/User/'.$id.'/edit');
            }
        }
        $user = User::findOrFail($id);
        
        return view('Users.ShowUser',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
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
        $user = User::findOrFail($id);
        // dd($user->password);
        $this->validate($request, [
        'name' => 'required',
        'lastname' => 'required',
        'password_anterior'=>'required|password:' . $user->password,
        // 'password'=>'confirmed',
        
    ]);

        
        $user->fill($request->only('name','lastname','phone','email','gender','birthdate','avatar'));
        if ($request->input('password_anterior' !== "")) {
            $user->fill([
                'password' => Hash::make($request->password)
            ]);   
        }
        // dd($user);
        $user->save();
        // Storage::put(
        //     'avatars/'.$user->id.'/profile',
        //     file_get_contents($request->file('avatar')->getRealPath())
        // );
        $path = 'assets/'.$user->id.'/profile';
        // echo $path;
        $file = $request->input('avatar');
        // $name = $file->getClientOriginalName();
        // dd($name);
        // echo $name;

        // $request->file('avatar')->move($path,$name);

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
