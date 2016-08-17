<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Color;
use App\Talle;
use App\Producto;
use Illuminate\Http\Request;
use App\Http\Requests;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $producto = Producto::findOrFail(1);
        $colores = Color::all();
        $talles = Talle::all();

        return view('Productos.Stock',['colores'=>$colores,'talles'=>$talles,'producto'=>$producto]);
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
        for ($i = 0; $i < count($request->talleId); $i++) {
            
            $stock = Stock::create([
                'productoId'=>$request->input('productoId'),
                'colorId'=> $request->colorId[$i],
                'talleId'=> $request->talleId[$i],
                'stockCantidad'=> $request->stockCantidad[$i],
            ]);
        }
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
        // dd($id);
        $stocks = Stock::where('productoId',$id)->get();
        $producto = Producto::findOrFail($id);
        $colores = Color::all();
        $talles = Talle::all();
        // dd($stocks);
        return view('Productos.ShowStock',['stocks'=>$stocks,'producto'=>$producto,'colores'=>$colores,'talles'=>$talles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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

            $stock = Stock::where('productoId',$request->input('productoId'))->delete();
            // dd($stock);
            // $stock->delete();
        for ($i = 0; $i < count($request->talleId); $i++) {
            
            $stock = Stock::where('productoId',$request->input('productoId'))->where('colorId',$request->colorId[$i])->where('talleId',$request->talleId[$i])->first();
            $stock = Stock::create([
                'productoId'=>$request->input('productoId'),
                'colorId'=> $request->colorId[$i],
                'talleId'=> $request->talleId[$i],
                'stockCantidad'=> $request->stockCantidad[$i],
            ]);
            // $stock->colorId = $request->colorId[$i]
            // $stock->talleId = $request->talleId[$i]
            // $stock->stockCantidad = $request->stockCantidad[$i]
            // $stock->save();

            //     'productoId'=>$request->input('productoId'),
            //     'colorId'=> $request->colorId[$i],
            //     'talleId'=> $request->talleId[$i],
            //     'stockCantidad'=> $request->stockCantidad[$i],
            // ]);
        }
        return redirect()->back();
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
