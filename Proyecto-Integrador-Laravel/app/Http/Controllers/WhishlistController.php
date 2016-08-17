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
        // dd(Cart::instance('wishlist')->content());
        if (Cart::instance('wishlist')->content()->isEmpty()) {
            // dd("vacio");
            $producto = Producto::findOrFail($request->productoId);
                $productoCart = Cart::instance('wishlist')->add($producto->productoId,$producto->productoNombre,1,$producto->productoPrecio, ['userId'=>$producto->users_id,'productoFoto' => $producto->productoFoto,'size'=>$request->input('talleId'),'color'=>$request->input('colorId')]);  
                return redirect()->back();
        }else{
            foreach (Cart::instance('wishlist')->content() as $item) {
                // dd($item);
                if ($item->id == $request->productoId) {
                    // dd("if");
                    return redirect()->back()->withSuccessMessage('Item is already in your whishlist cart!');
                }else{
                    // dd("else");
                    $producto = Producto::findOrFail($request->productoId);
                    $productoCart = Cart::instance('wishlist')->add($producto->productoId,$producto->productoNombre,1,$producto->productoPrecio, ['userId'=>$producto->users_id,'productoFoto' => $producto->productoFoto,'size'=>$request->input('talleId'),'color'=>$request->input('colorId')]);  
                    return redirect()->back();  
                }
            }
        }
        // dd("final");
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
        // dd($id);
        $item = Cart::instance('wishlist')->get($id);
        // dd($item);
        // $producto = Producto::findOrFail($id);
        // dd(Cart::instance('default')->content());


        if (Cart::instance('default')->content()) {
            
        }

        Cart::instance('default')->add($item->id,$item->name,1,$item->price, ['userId'=>$item->options->userId,'productoFoto' => $item->options->productoFoto,'size'=>$item->options->size,'color'=>$item->options->color]);
        
        Cart::instance('wishlist')->remove($id);

        return redirect('/Whishlist')->withSuccessMessage('Item has been moved to your shopping cart!');
    }
}
