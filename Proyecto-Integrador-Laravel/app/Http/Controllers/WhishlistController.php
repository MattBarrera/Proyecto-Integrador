<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Talle;
use App\Color;
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
        // $ids = [];
        // foreach (Cart::instance('wishlist')->content() as $value) {
        //     // dd();
        //     $ids [] = $value->id;
        // }
        // dd($ids);
        // dd(Cart::instance('wishlist')->content());
        $talles = Talle::all();
        $colores = Color::all();
        // dd($colores);
        return view('Whishlist.Whishlist',['colores'=>$colores,'talles'=>$talles]);
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
    public function store(Request $request)
    {
        // dd($request);
        $producto = Producto::findOrFail($request->productoId);
        dd($producto);
        if (Cart::search($producto->productoId)) {
            return redirect()->back();
        }
        if (Cart::search(['id' => $request->productoId])) {
            return redirect()->back()->withSuccessMessage('Item is already in your cart!');
        }
        $productoCart = Cart::instance('wishlist')->add($producto->productoId,$producto->productoNombre,1,$producto->productoPrecio, ['userId'=>$producto->users_id,'productoFoto' => $producto->productoFoto,'size'=>$request->input('talleId'),'color'=>$request->input('colorId')]);
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

    public function switchToCart($id)
    {
        dd($id);
        $item = Cart::instance('wishlist')->get($id);


        if (Cart::instance('main')->search(['id' => $item->id])) {
            return redirect('wishlist')->withSuccessMessage('Item is already in your shopping cart!');
        }

        Cart::instance('main')->associate('Product','App')->add($item->id, $item->name, 1, $item->price);
        
        Cart::instance('wishlist')->remove($id);

        return redirect('wishlist')->withSuccessMessage('Item has been moved to your shopping cart!');
    }
}
