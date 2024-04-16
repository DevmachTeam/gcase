<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\SellOrder;
use DB;
class SellOrderController extends Controller
{
    public function store(Request $request)
    {
       
           

                $productId = $request->product_id;
                $quantity = $request->quantity;
                $user_id = $request->user_id;
                $address = $request->address;
                $others=$request->others;
                if ($request->filled(['product_id', 'quantity', 'user_id'])) {
                   
                $product = Products::where('id', $productId)->lockForUpdate()->first();
              
                
                if (empty($product)) {
                  return response()->json(['error' => 'Product not found'], 404);
                }
           
                if ($product->pr_quantity < $quantity) {
                    
                    return response()->json(['error' => 'Insufficient quantity of the product'], 400);
                }
        
                $product->pr_quantity -= $quantity;
                $product->save();
        
                /*
                SellOrder::create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'user_id'=>$user_id,
                    'address'=>$address,
                    'others'=>$others
                ]);
                */
                return response()->json(['success' => 'İşlem başarılı'], 200);
        
            }else{
                return response()->json(['error' => 'Error'], 400);
            }
            
      
        
          
    }
}
