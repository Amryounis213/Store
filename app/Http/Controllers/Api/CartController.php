<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $products = Cart::with('product')->where('user_id' , Auth::guard('sanctum')->id())->get();
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Cart return Products successfully',
            'products' => CartResource::collection($products),
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all() , [
            'product_id' => 'required|exists:products'
        ]);

        $request->merge([
            'user_id'=> Auth::guard('sanctum')->id(),
            'cookie_id'=> Str::random(20),
        ]);

        if(Cart::where('user_id' , Auth::guard('sanctum')->id())->where('product_id' , $request->product_id)->exists())
        {
            
            $cart = Cart::where('user_id' , Auth::guard('sanctum')->id())->where('product_id' , $request->product_id)->first();
            $name = $cart->product->name ;
            $cart->update([
               'quantity'=> $request->quantity ?? $cart->quantity + 1,
            ]);
            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => 'Cart Add a more '. $name. ' successfully , the Count was ('. $cart->quantity .' ) ',
                //'products' => $cart->select('product_id'),
            ]);
        }else{
            $cart = Cart::create($request->all());
            return response()->json([
                'status' => true,
                'code' => 201,
                'message' => 'Cart Add new  Product successfully',
               // 'products' => $cart->select('product_id'),
            ]);

        }
     

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
        $product = Cart::where('user_id' , Auth::guard('sanctum')->id())->where('product_id' , $id)->first();
        $product->delete();
        return response()->json([
            'status' => true,
            'code' => 204,
            'message' => 'Cart Delete Product successfully',
            'product' => '',
        ]);
    }
}
