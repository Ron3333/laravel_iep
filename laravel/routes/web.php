<?php
use App\Http\Controllers\Test\TuControlador;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacto', function(){
    return view('contacto');
});

Route::get('/bio-3', function () {
    $msj2 = "Msj desde el  servidor *-*";
    $data = ['msj2' => $msj2, "age" => 15, "name" => "pepe1"];
    return view('bio', $data);
 })->name('bio');



Route::get("/panel", function (){
        return view('panel.panel1');
});

Route::get("/detalle", function (){
    return view("detalle");
});


//Route::resource('post', PostController::class)->except(['create']);
//Route::resource('post', PostController::class);
//Route::resource('category',CategoryController::class);
/*
Route::resources([
    'post' => PostController::class,
     'category' => CategoryController::class,
]);
*/

/*
Route::group(['prefix' => 'dashboard'], function () {
    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
});
*/

Route::middleware([App\Http\Middleware\TestMiddleware::class])->group(function () {

    Route::get('/test/{id}', function (int $id) {
        echo $id;
    });
});


Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard.dashboard');
            })->name("dashboard");
        Route::resources([
        'post' => App\Http\Controllers\Dashboard\PostController::class,
        'category' => App\Http\Controllers\Dashboard\CategoryController::class,
    ]);
});