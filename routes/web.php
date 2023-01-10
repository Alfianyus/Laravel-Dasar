<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Input\Input;

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

Route::get('/pzn', function(){
    return "Programmer zaman Now";
});

Route::redirect('/youtube','/pzn');

Route::fallback(function(){
    return "404 By Yuska Programmer";
});

Route::view('/hello', 'hello',['name'=>'yuska']);

Route::get('hello-again', function(){
    return view('hello',['name'=>'Yuska']);
});

Route::get('/hello-word',function(){
    return view('hello.word',['name'=>'Yuska']);
});

Route::get('/products/{id}', function($productId){
    return "product $productId";

});

Route::get('/products/{product}/items/{item}', function($productId, $itemId){
    return "Product $productId,Item $itemId";
});

Route::get('/categories/{id}', function($categoryId){
    return "category $categoryId";
})->where('id','[0-9]+');

Route::get('/users/{id?}', function ($userId='404'){
    return "User $userId";
});

Route::get('/conflict/{name}', function($name){
    return "Conflict $name";
});

Route::get('/conflict/yuska', function(){
    return "Conflict Yuska alfian";
});

Route::get('/controller/hello/request',[HelloController::class,'request']);
Route::get('/controller/hello/{name}', [HelloController::class,'hello']);

Route::get('/input/hello',[InputController::class, 'hello']);
Route::post('/hello/input',[InputController::class,'hello']);
Route::post('/input/hello/first',[InputController::class,'helloFirst']);   
Route::post('/input/hello/input',[InputController::class,'helloInput']);
Route::post('/input/hello/array',[InputController::class,'helloArray']);
Route::post('/input/type',[InputController::class,'inputType']);
Route::post('/input/filter/only',[InputController::class,'filterOnly']);
Route::post('/input/filter/except',[InputController::class,'filterExcept']);
Route::post('/input/filter/merge',[InputController::class,'filterMerge']);
Route::post('/file/upload',[InputController::class,'upload']);