<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Genero;
use Auth;
use App\Categoria;
use App\talleHasProducto;
use App\colorHasProducto;
use Illuminate\Http\Request;
use App\Http\Requests;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();

        return view('Store.Productos', ['productos'=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generos = Genero::all();
        $categorias = Categoria::all();
        $subCategorias = Categoria::where('categoriaIdParent','!=',"")->get();
        // dd($subCategorias);

        return view('Productos.CreateProducto',['generos'=> $generos,'categorias'=> $categorias,'subCategorias'=> $subCategorias]);
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
        // dd($id);
        $producto = Producto::findOrFail($id);
        $colores = ColorHasProducto::select('colorId')->where('productoId',$id)->get();
        $talles = TalleHasProducto::select('talleId')->where('productoId',$id)->get();
        // dd($producto);

        return view('Productos.ShowProducto',['producto'=>$producto,'colores'=>$colores,'talles'=>$talles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    /**
     * Display a listing of the resource for user Id.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOwn()
    {
        $productos = Producto::where('users_id', Auth::user()->id)->get();

        return view('Productos.MyProducts', ['productos'=>$productos]);
    }

}
