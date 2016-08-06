<?php

namespace App\Http\Controllers;

use Auth;
use App\Empresa;
use App\EmpresaHasUsers;
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
        return view('Empresa.CrearEmpresa');
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

        $nuevaEmpresa = Empresa::create([
            'empresaNombre'=>$request->input('empresaNombre'),
            'empresaMail'=>$request->input('empresaMail'),
            'empresaCUIT'=>$request->input('empresaCUIT'),
            'empresaTelefono'=>$request->input('empresaTelefono'),
            'empresaDireccion'=>$request->input('empresaDireccion'),
            'empresaFoto'=>$request->input('empresaFoto'),
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
        
        return view('Users.ShowUser',['empresa'=>$empresa,'productos'=>$productos,'follower'=>$follower]);
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

        $empresa->fill($request->only('empresaNombre','empresaMail','empresaCUIT','empresaTelefono','empresaDireccion','empresaDireccion'));
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
}
