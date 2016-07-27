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
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
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
        $categorias = Categoria::where('categoriaIdParent', "")->get();
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
        
        $producto = Producto::findOrFail($id);
        $colores = ColorHasProducto::select('colorId')->where('productoId',$id)->get();
        $talles = TalleHasProducto::select('talleId')->where('productoId',$id)->get();

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
        
    }

    /**
     * Display a listing of the resource for user Id.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOwn()
    {
        $productos = Producto::where('users_id', Auth::user()->id)->where('productoEstado', 1)->get();

        return view('Productos.MyProducts', ['productos'=>$productos]);
    }
    /**
     * Display a listing of the resource for user Id where are down.
     *
     * @return \Illuminate\Http\Response
     */
    public function OwnDown()
    {
        $productos = Producto::where('users_id', Auth::user()->id)->where('productoEstado', 2)->get();

        return view('Productos.MyHistoricProducts', ['productos'=>$productos]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function baja($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->productoEstado = 2;
        $producto->save();
        return redirect('/MyProducts');
    }
    /**
     * Reactivate the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ReActivar($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->productoEstado = 1;
        $producto->save();
        return redirect('/MyHistoricProducts');
    }
    /**
     * Search the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Busqueda(Request $request)
    {
        $query = $request->get('q');
        // dd($query);
        $categorias = Categoria::select('categoriaId')->where('categoriaNombre','like','%'.$query.'%')->get();
        $categorias->toArray();
        // dd($categorias);
        $productos = Producto::where('productoNombre','like','%'.$query.'%')->orWhereIn('categoriaId',$categorias)->get();
        // dd($productos);
        
        return view('Busqueda.Busqueda', ['productos'=>$productos]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubCategorias($id)
    {
        $subCategorias = Categoria::where('categoriaIdParent',$id)->get();

        echo json_encode($subCategorias);
    }

}
