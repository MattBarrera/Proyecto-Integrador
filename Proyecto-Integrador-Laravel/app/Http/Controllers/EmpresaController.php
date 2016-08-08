<?php

namespace App\Http\Controllers;

use Auth;
use App\Empresa;
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
        $empresas = EmpresaHasUsers::where('users_id',Auth::user()->id);

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
        if ($request->input('empresaFoto') !== "") {
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

        return view('Empresa.EditEmpresa',['empresa'=>$empresa]);
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
}
