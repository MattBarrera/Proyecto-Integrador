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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generos = Genero::all();
        $categorias = Categoria::where('categoriaIdParent', "")->with('categoriaPadre','subcategorias')->get();
        // $subCategorias = Categoria::where('categoriaIdParent', "!=", "")->get();
        // dd($subCategorias);
        $productos = Producto::with('categoria','usuario','empresa','categoriaPadre')->get();
        // dd($productos);

        return view('Store.Store',['productos'=>$productos,'generos'=>$generos,'categorias'=>$categorias,]);//'subCategorias'=>$subCategorias
    }
    public function indexHome()
    {
        $productos = Producto::where('productoEstado',1)->with('usuario','categoria','empresa')->take(8)->get();
        // dd($productos);
        return view('welcome',['productos'=>$productos]);
    }
    
}
