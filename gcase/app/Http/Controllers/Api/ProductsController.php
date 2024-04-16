<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Products::all();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->filled(['name', 'quantity', 'price', 'status'])) {
           
            $product = Products::create([
                'pr_name' => $request->name,
                'pr_quantity' => $request->quantity,
                'pr_price' => $request->price,
                'pr_status' => $request->status,
            ]);
    
           
            return response()->json(["status" => 200, "message" => "Success"], 200);
        } else {
     
            return response()->json(["status" => 400, "message" => "Error"], 400);
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
        $products=Products::find($id);
        return $products;
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
        $product = Products::findOrFail($request->id);

        $product->fill([
            'pr_name' => $request->name,
            'pr_quantity' => $request->quantity,
            'pr_price' => $request->price,
        ]);
    
        if ($product->isDirty()) {
          
            $product->save();
            return response()->json($product, 200);
        } else {
        
            return response()->json(['error' => 'No changes detected'], 400);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products=Products::destroy($id);
        return response()->json(["status"=>200,"message"=>"Ürün Silme Başarılı"]);
    }
}
