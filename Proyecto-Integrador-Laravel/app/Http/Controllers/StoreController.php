<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Genero;
use App\Categoria;
use App\Http\Requests;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generos = Genero::all();
        $categorias = Categoria::where('categoriaIdParent', "")->get();
        $subCategorias = Categoria::where('categoriaIdParent', "!=", "")->get();
        // dd($subCategorias); 
        $productos = Producto::where('productoEstado',1)->with('usuario')->get();

        return view('Store.Store',['productos'=>$productos,'generos'=>$generos,'categorias'=>$categorias,'subCategorias'=>$subCategorias]);
    }
    public function indexHome()
    {
        $productos = Producto::where('productoEstado',1)->get();
        // dd($productos);
        return view('welcome',['productos'=>$productos]);
    }
    
}
