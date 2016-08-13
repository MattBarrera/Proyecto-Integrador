<?php

namespace App\Http\Controllers;

use App\Producto;
use App\ColorHasProducto;
use App\TalleHasProdcuto;
use Cart;
use Illuminate\Http\Request;
use App\Http\Requests;

class WhishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ids = [];
        foreach (Cart::instance('wishlist')->content() as $value) {
            // dd();
            $ids [] = $value->id;
        }
        // dd($ids);
        // dd(Cart::instance('wishlist')->content());
        $colores = ColorHasProducto::whereIn('productoId',[1,4])->with('color')->get();
        // dd($colores);
        return view('Whishlist.Whishlist',['colores'=>$colores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // dd($id);
        $producto = Producto::findOrFail($id);
        // dd($producto);
        // if (Cart::search($producto->productoId)) {
        //     return redirect()->back();
        // }else{
        // if (Cart::search(['id' => $request->id])) {
        //     return redirect()->back()->withSuccessMessage('Item is already in your cart!');
        // }
        $productoCart = Cart::instance('wishlist')->add($producto->productoId,$producto->productoNombre,1,$producto->productoPrecio, ['userId'=>$producto->users_id,'productoFoto' => $producto->productoFoto]);
        // dd($productoCart);
        // Cart::destroy();
        // dd(URL::previous());
        // if (URL::previous()) {
            
        return redirect()->back();
        // }
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // dd($id);
        // Cart::update($id, $request->input('productoQty'));
        // return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        Cart::instance('wishlist')->remove($id);
        return redirect()->back();
    }
}
