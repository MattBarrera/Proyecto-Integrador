<?php

namespace App\Http\Controllers;

use Auth;
use App\Producto;
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
        // $subCategorias = Categoria::where('categoriaIdParent','!=',"")->get();
        // dd($subCategorias);
        return view('Productos.CreateProducto',['generos'=> $generos,'categorias'=> $categorias,'colores'=>$colores,'talles'=>$talles]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $producto = Producto::where('productoId',$id)->with('usuario','categoria')->first();
        // $colores = ColorHasProducto::select('colorId')->where('productoId',$id)->with('color')->get();
        $talles = TalleHasProducto::select('talleId')->where('productoId',$id)->get();
        // dd($producto);

        return view('Productos.ShowProducto',['producto'=>$producto,'talles'=>$talles]);//'colores'=>$colores,
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
