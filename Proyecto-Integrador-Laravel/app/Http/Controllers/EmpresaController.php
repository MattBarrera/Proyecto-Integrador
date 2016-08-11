<?php

namespace App\Http\Controllers;

use Auth;
use App\Empresa;
use App\User;
use App\EmpresaHasUsers;
use App\Producto;
use App\Follower;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresasIds = EmpresaHasUsers::select('empresaId')->where('users_id',Auth::user()->id)->get();
        // $empresas->toArray;
        $empresasUsers = EmpresaHasUsers::select('users_id')->whereIn('empresaId',$empresasIds)->get();
        // dd($empresasUsers);
        $empresas = Empresa::whereIn('empresaId',$empresasIds)->with('usuarios.usuario')->get();
        // $usuarios = User::whereIn('id',$empresasUsers)->get();
        // dd($usuarios);
        // dd($empresas);

        return view('Empresas.Empresas',['empresas'=>$empresas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Empresas.CrearEmpresa');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        if ($request->has('empresaFoto')) {
            $destinationPath = '/public/assets/'.Auth::user()->id.'/profile/';
            $fileName = input::file('empresaFoto')->getClientOriginalName();
            input::file('empresaFoto')->move(public_path().'/assets/'.Auth::user()->id.'/pages/', $fileName);
        }

        $nuevaEmpresa = Empresa::create([
            'empresaNombre'=>$request->input('empresaNombre'),
            'empresaEmail'=>$request->input('empresaEmail'),
            'empresaCUIT'=>$request->input('empresaCUIT'),
            'empresaTelefono'=>$request->input('empresaTelefono'),
            'empresaDireccion'=>$request->input('empresaDireccion'),
            'empresaFoto'=>$fileName,
            'empresaEstado'=>1,
        ]);
        $empresaUser = EmpresaHasUsers::create([
            'empresaId'=>$nuevaEmpresa->empresaId,
            'users_id'=>Auth::user()->id,
            'empresaOwner'=>1,
            ]);


        return redirect ('/Empresa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);
        $productos = Producto::where('empresaId',$id)->with('usuario','categoria')->get();
        $follower = Follower::where('empresaId',$id)->where('users_id',Auth::user()->id)->first();
        // dd($follower);
        
        return view('Empresas.ShowEmpresa',['empresa'=>$empresa,'productos'=>$productos,'follower'=>$follower]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa = Empresa::findOrFail($id);

        return view('Empresas.EditarEmpresa',['empresa'=>$empresa]);
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
        $empresa = Empresa::findOrFail($id);

        $empresa->fill($request->only('empresaNombre','empresaEmail','empresaCUIT','empresaTelefono','empresaDireccion','empresaDireccion'));
        $empresa->save();

        return redirect ('/Empresa');
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

    public function follow($id)
    {
        // $user = User::findOrFail($id);
        if ($follower = Follower::where('users_id1',$id)->where('users_id',Auth::user()->id)->first()) {
            //si existe el follow, lo elimino,
            $follower = Follower::where('users_id1',$id)->where('users_id',Auth::user()->id)->delete();
        }else{
            //sino lo creo
            Follower::create([
                'users_id'=>Auth::user()->id,
                'users_id1'=>$id,
                ]);
        }
        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addAdmin($id)
    {
        $empresaId = $id;
        $users = EmpresaHasUsers::where('empresaId',$id)->with('usuario')->get();
        // dd($users);

        return view('Empresas.AddAdmin',['users'=>$users,'empresaId'=>$empresaId]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeAdmin(Request $request, $id)
    {
        // $userMail = ;
        $user = User::select('id')->where('email',$request->input('email'))->first();
        // dd($user);
        $algo = EmpresaHasUsers::where('empresaId',$id)->where('users_id',$user->id)->get();
        // dd($algo);
        if(!$algo->isEmpty()){
            // echo 'ya existe';
            return redirect()->back()->withErrors('The user is already an Admin!');
            // return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $newAdmin = EmpresaHasUsers::create([
                'empresaId'=>$id,
                'users_id'=>$user->id,
                'empresaOwner'=>0,
            ]);
            // dd($newAdmin);
        return back()->withSuccessMessage('The user was added successfully!');

        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroyAdmin(Request $request, $id)
    {
        $user = User::findOrFail($request->input('inputHidden'));
        // dd($user->id);
        // $algo = EmpresaHasUsers::where('users_id',$user->id)->where('empresaId',$id)->first()->delete();
        // $algo->delete();
        // dd($algo);



        // $user = User::findOrFail($id);
        if ($algo = EmpresaHasUsers::where('users_id',$user->id)->where('empresaId',$id)->first()) {
            //si existe el follow, lo elimino,
            $algo = EmpresaHasUsers::where('users_id',$user->id)->where('empresaId',$id)->delete();
        }
        return back();
    }
}
