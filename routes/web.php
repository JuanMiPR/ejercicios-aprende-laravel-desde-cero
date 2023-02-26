<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Ejercicio 1

Route::get('/ejercicio1', function () {
    return "GET OK";
});

Route::post('/ejercicio1', function () {
    return "POST OK";
});

Route::post('/ejercicio2/a', fn(Request $request) => response()->json($request->all()));
Route::post('/ejercicio2/b', function (Request $request) {
    if ($request->request->get('price') < 0) {
        return response()->json([
                "message" => "Price can't be less than 0"]
        )->setStatusCode(422);
    }
    return response()->json($request->all());
});
Route::post('/ejercicio2/c', function (Request $request) {
    $response = $request->all();
    $discount = getDiscount($request->query->get('discount'));
    $response['price'] -= $response['price'] * ($discount / 100);
    $response['discount'] = $discount;
    return response()->json($response);
});


function getDiscount($discount): int
{
    return match ($discount) {
        'SAVE5' => 5,
        'SAVE10' => 10,
        'SAVE15' => 15,
        default => 0,
    };
}
