<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Producto;
use App\EmpresaHasUsers;
use App\Empresa;
use App\Color;
use App\User;
use App\Talle;
use App\Genero;
use App\Categoria;
use App\Follower;
use App\Stock;
use App\Visita;
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
        $empresas = EmpresaHasUsers::where('users_id',Auth::user()->id)->with('empresa')->get();
        // dd($empresas);
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
        if ($request->input('productoFoto') != "") {
            $destinationPath = '/public/assets/'.Auth::user()->id.'/products/';
            $fileName = input::file('productoFoto')->getClientOriginalName();
            input::file('productoFoto')->move(public_path().'/assets/'.Auth::user()->id.'/products/', $fileName);
        }else{
            $fileName = 'artsinfoto.gif';
        }
        if ($request->input('empresaId') !== "") {
            $empresaId = $request->input('empresaId');
        }else{
            $empresaId = 0;
        }
        if($request->input('categoriaId') == ""){
            $categoriaId = $request->input('categoriaIdParent');
            $categoriaIdParent = 0;
        }else{
            $categoriaId = $request->input('categoriaId');
            $categoriaIdParent = $request->input('categoriaIdParent');
        }


        $nuevoProducto = Producto::create([
            'productoNombre'=> $request->input('productoNombre'),
            'productoDescripcion'=> $request->input('productoDescripcion'),
            'productoPrecio'=> $request->input('productoPrecio'),
            'categoriaId'=> $categoriaId,
            'categoriaIdParent'=> $categoriaIdParent,
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
        // $producto = Producto::where('productoId',$id)->with('usuario','categoria','talle','color')->first();
            // $colores = Color::all();
            // $talles = Talle::all();
            // if ($productoVisita = Visita::where('productoId',$id)->first()) {
            //     $productoVisita->visitaCant += $producto->visitaCant+1;
            //     $productoVisita->save(); 
            // }else{
            //     $productoVisita = Visita::create([
            //         'productoId'=>$id,
            //         'visitaCant'=>1,
            //     ]);
            // }
            // // dd($producto->categoriaId);
            // $productosInteres = Producto::where('categoriaId',$producto->categoriaId)->where('productoId','!=',$producto->productoId)->take(4)->get();
            // // dd($productosInteres);

            // return view('Productos.ShowProducto',['producto'=>$producto,'productosInteres'=>$productosInteres]);
            // // Hasta Aca Esto Funcion!!!

        $producto = Producto::where('productoId',$id)->with('usuario','categoria')->first();

        $stocks = Stock::select('colorId')->where('productoId',$id)->with('color')->distinct()->get();
        // dd($stocks);
        $productosInteres = Producto::where('categoriaId',$producto->categoriaId)->where('productoId','!=',$producto->productoId)->take(4)->get();

        return view('Productos.ShowProducto1',['producto'=>$producto,'productosInteres'=>$productosInteres,'stocks'=>$stocks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $empresas = EmpresaHasUsers::where('users_id',Auth::user()->id)->with('empresa')->get();
        $categorias = Categoria::where('categoriaIdParent', "")->with('subcategorias')->get();
        // dd($categorias);
        $generos = Genero::all();
        $colores = Color::all();
        $talles = Talle::all();
        return view('Productos.EditProducto',['producto'=>$producto,'generos'=> $generos,'categorias'=> $categorias,'colores'=>$colores,'talles'=>$talles,'empresas'=>$empresas]);
        // return view('Productos.EditProducto',['producto'=>$producto]);
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
        $productos = Producto::where('users_id', Auth::user()->id)->where('productoEstado', 1)->with('usuario','categoria','visita')->get();

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
            //consulto la busqueda es por el fom, y que obtengo en el get...
            $query = $request->get('q');
            // dd($query);
            $generos = Genero::all();
            $categorias = Categoria::where('categoriaIdParent', "")->get();
            //obtengo categorias que sean parecidas al query
            $categoriasQuery = Categoria::select('categoriaId')->where('categoriaNombre','like','%'.$query.'%')->get();
            // dd($categoriasQuery);
            $categoriasQuery->toArray();
            //busco productos que en el nombre sean parecidas al query o que la categoria sea igual al id obtenido en el anterior query
            $productos = Producto::where('productoNombre','like','%'.$query.'%')->orwhereIn('categoriaId',$categoriasQuery)->get();
            //si no obtengo ningun producto, le muestro 3 opciones de forma random
            $sugerencias = "";
            if(count($productos) == ""){
                $sugerencias = Producto::orderBy(DB::raw('RAND()'))->take(3)->get();
            }
            return view('Busqueda.Busqueda', ['productos'=>$productos,'generos'=>$generos,'categorias'=>$categorias,'sugerencias'=>$sugerencias]);
        }elseif ($query = $request->get('cat')) {
            //consulto si la busqueda es por categorias.
            $query = $request->get('cat');
            // dd($query);
            $generos = Genero::all();
            $categorias = Categoria::where('categoriaIdParent', "")->get();
            $productos = Producto::where('categoriaId',$query)->get();
            //si no obtengo ningun producto, le muestro 3 opciones de forma random
            $sugerencias = "";
            if(count($productos) == ""){
                $sugerencias = Producto::orderBy(DB::raw('RAND()'))->take(3)->get();
            }
            return view('Busqueda.Busqueda', ['productos'=>$productos,'generos'=>$generos,'categorias'=>$categorias,'sugerencias'=>$sugerencias]);
        }elseif ($query = $request->get('gen')) {
            //consulto si la busqueda es por generos.
            $query = $request->get('gen');
            // dd($query);
            $generos = Genero::all();
            $categorias = Categoria::where('categoriaIdParent', "")->get();
            $productos = Producto::where('generoId',$query)->get();
            //si no obtengo ningun producto, le muestro 3 opciones de forma random
            $sugerencias = "";
            if(count($productos) == ""){
                $sugerencias = Producto::orderBy(DB::raw('RAND()'))->take(3)->get();
            }
            return view('Busqueda.Busqueda', ['productos'=>$productos,'generos'=>$generos,'categorias'=>$categorias,'sugerencias'=>$sugerencias]);
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
        //busco los followers
        $usersFollowers = Follower::select('users_id1')->where('users_id',Auth::user()->id)->where('users_id1','!=', '')->get();
        // dd($usersFollowers);
        $users = User::whereIn('id',$usersFollowers)->get();
        // dd($users);
        $users_id1 = User::select('id')->whereIn('id',$usersFollowers)->get();
        // dd($users_id1);

        $empresasFollowers = Follower::select('empresaId')->where('users_id',Auth::user()->id)->where('empresaId','!=', '')->get();
        // dd($empresasFollowers);
        $empresas = Empresa::whereIn('empresaId',$empresasFollowers)->get();
        // dd($empresas);
        $empresasIds = Empresa::select('empresaId')->whereIn('empresaId',$empresasFollowers)->get();
        // dd($empresasIds);
        // busco los productos
        $productos = Producto::whereIn('users_id', $users_id1)->orwhereIn('empresaId',$empresasIds)->with('usuario','categoria','empresa')->get();
        // dd($productos);
        // $follower = Follower::where('users_id1',$id)->where('users_id',Auth::user()->id)->first();

        return view('Productos.MyPersonalProducts', ['users'=>$users,'productos'=>$productos,'empresas'=>$empresas]);
    }

    public function getTalles($id, $productoId)
    {
        
        $talles = Stock::where('colorId',$id)->where('productoId',$productoId)->with('talle')->get();
        echo json_encode($talles);exit;
    }

}
