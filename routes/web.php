<?php

use App\Http\Controllers\ProductController;
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
    switch ($request->query->get('discount')) {
        case 'SAVE5':
            $response['price'] -= $response['price'] * 0.05;
            $response['discount'] = 5;
            break;
        case 'SAVE10':
            $response['price'] -= $response['price'] * 0.1;
            $response['discount'] = 10;
            break;
        case 'SAVE15':
            $response['price'] -= $response['price'] * 0.15;
            $response['discount'] = 15;
            break;
        default:
            $response['discount'] = 0;
    }
    return response()->json($response);
});
