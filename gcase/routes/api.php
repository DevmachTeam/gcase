<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\SellOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(ProductsController::class)->group(function(){
    Route::get("/products","index");
    Route::post("/products","store");
    Route::get("/products/{id}","show");
    Route::put("/products/{id}","update");
    Route::delete("/products/{id}","destroy");

});


Route::post("/login",[ApiController::class,"login"]);
Route::middleware('auth:api')->group(function(){
    Route::get("/user",function(){
        return \Illuminate\Support\Facades\Auth::user();
    });
    Route::post("/payment",[SellOrderController::class,"store"]);
});

