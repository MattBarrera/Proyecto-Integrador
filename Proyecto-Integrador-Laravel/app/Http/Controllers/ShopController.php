<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Talle;
use App\Color;
use Cart;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $talles = Talle::all();
        $colores = Color::all();
        return view('Shop.Shop',['talles'=>$talles,'colores'=>$colores]);
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
        // dd($request->productoId);
        $producto = Producto::findOrFail($request->productoId);
        // dd($producto);
        // if (Cart::search($producto->productoId)) {
        //     return redirect()->back();
        // }
        // dd($request->productoId);
        // $algo = Cart::search('id' => $request->productoId);
        // dd($algo);
        // if (Cart::search(array('id' => $request->productoId))) {
        //     echo 'string';
        //     // return redirect()->back()->withSuccessMessage('Item is already in your cart!');
        // }

        $productoCart = Cart::add($producto->productoId,$producto->productoNombre,1,$producto->productoPrecio, ['userId'=>$producto->users_id,'productoFoto' => $producto->productoFoto, 'size'=>$request->input('talleId'),'color'=>$request->input('colorId')]);

            
        return redirect()->back();

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
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric'
        ]);

         if ($validator->fails()) {
            session()->flash('error_message', 'Quantity must be between 1 and 5.');
            return response()->json(['success' => false]);
         }

        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
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
        Cart::remove($id);
        return redirect()->back();
    }
}
