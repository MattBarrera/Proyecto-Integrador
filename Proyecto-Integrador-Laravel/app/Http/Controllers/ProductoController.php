<?php

namespace App\Http\Controllers;

use Auth;
use App\Producto;
use App\EmpresaHasUsers;
use App\Color;
use App\User;
use App\Talle;
use App\Genero;
use App\Categoria;
use App\Follower;
use App\TalleHasProducto;
use App\ColorHasProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
        // dd("ogla");
        $generos = Genero::all();
        $colores = Color::all();
        $talles = Talle::all();
        $categorias = Categoria::where('categoriaIdParent', "")->get();
        $empresas = EmpresaHasUsers::where('users_id',Auth::user()->id);
        // $subCategorias = Categoria::where('categoriaIdParent','!=',"")->get();
        // dd($subCategorias);
        return view('Productos.CreateProducto',['generos'=> $generos,'categorias'=> $categorias,'colores'=>$colores,'talles'=>$talles,'empresas'=>$empresas]);
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
        // $fileName = '';
        if ($request->input('productoFoto')) {
            $destinationPath = '/public/assets/'.Auth::user()->id.'/products/';
            $fileName = input::file('productoFoto')->getClientOriginalName();
            input::file('productoFoto')->move(public_path().'/assets/'.Auth::user()->id.'/products/', $fileName);
        }else{
            $fileName = 'artsinfoto.gif';
        }
        if ($request->input('empresaId') !== "") {
            $empresaId = $request->input('empresaId');
        }else{
            $empresaId = "";
        }


        $nuevoProducto = Producto::create([
            'productoNombre'=> $request->input('productoNombre'),
            'productoDescripcion'=> $request->input('productoDescripcion'),
            'productoPrecio'=> $request->input('productoPrecio'),
            'categoriaIdParent'=> $request->input('categoriaIdParent'),
            'categoriaId'=> $request->input('categoriaId'),
            'productoFoto'=> $fileName,
            'productoEstado'=> 1,
            'users_id'=> Auth::user()->id,
            'empresaId'=> $empresaId,
            'generoId'=>$request->input('generoId'),
        ]);

        return redirect('/MyProducts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $producto = Producto::where('productoId',$id)->with('usuario','categoria','talle','color')->first();
        $colores = Color::all();
        $talles = Talle::all();
        //dd($producto);

        return view('Productos.ShowProducto',['producto'=>$producto]);//'colores'=>$colores,'talles'=>$talles
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
        $productos = Producto::where('users_id', Auth::user()->id)->where('productoEstado', 1)->with('usuario','categoria')->get();

        return view('Productos.MyProducts', ['productos'=>$productos]);
    }
    /**
     * Display a listing of the resource for user Id where are down.
     *
     * @return \Illuminate\Http\Response
     */
    public function OwnDown()
    {
        $productos = Producto::where('users_id', Auth::user()->id)->where('productoEstado', 2)->with('usuario','categoria')->get();

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
        // dd(substr($request->getQueryString(),0,1));
        // dd($request);
       if (substr($request->getQueryString(),0,1) == 'q') {
            // echo 'string';
            $query = $request->get('q');
            // dd($query);
            $generos = Genero::all();
            $categorias = Categoria::where('categoriaIdParent', "")->get();
            $categoriasQuery = Categoria::select('categoriaId')->where('categoriaNombre','like','%'.$query.'%')->get();
            // dd($categoriasQuery);
            $categoriasQuery->toArray();
            $productos = Producto::where('productoNombre','like','%'.$query.'%')->orwhereIn('categoriaId',$categoriasQuery)->get();
            // dd($productos);
            $sugerencias = "";
            if(count($productos) == ""){
                $sugerencias = Producto::take(3)->get();
            }
            return view('Busqueda.Busqueda', ['productos'=>$productos,'generos'=>$generos,'categorias'=>$categorias,'sugerencias'=>$sugerencias]);
        }elseif ($query = $request->get('cat')) {
            $query = $request->get('cat');
            // dd($query);
            $generos = Genero::all();
            $categorias = Categoria::where('categoriaIdParent', "")->get();
            $productos = Producto::where('categoriaId',$query)->get();
            // $categorias = [];
            return view('Busqueda.Busqueda', ['productos'=>$productos,'generos'=>$generos,'categorias'=>$categorias]);
        }elseif ($query = $request->get('gen')) {
            $query = $request->get('gen');
            // dd($query);
            $generos = Genero::all();
            $categorias = Categoria::where('categoriaIdParent', "")->get();
            $productos = Producto::where('generoId',$query)->get();
            // dd($productos);
            return view('Busqueda.Busqueda', ['productos'=>$productos,'generos'=>$generos,'categorias'=>$categorias]);
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubCategorias($id)
    {
        $subCategorias = Categoria::where('categoriaIdParent',$id)->get();

        echo json_encode($subCategorias);exit;
    }

    /**
     * Display a listing of the resource for user Id where are down.
     *
     * @return \Illuminate\Http\Response
     */
    public function followersProducts()
    {
        $followers = Follower::select('users_id1')->where('users_id',Auth::user()->id)->get();
        // dd($followers);
        $users = User::whereIn('id',$followers)->get();
        // dd($users);
        $users_id1 = User::select('id')->whereIn('id',$followers)->get();
        // dd($users_id1);
        $productos = Producto::whereIn('users_id', $users_id1)->with('usuario','categoria')->get();
        // dd($productos);
        // $follower = Follower::where('users_id1',$id)->where('users_id',Auth::user()->id)->first();

        return view('Productos.MyPersonalProducts', ['users'=>$users,'productos'=>$productos]);
    }

}
