<?php
use App\Http\Controllers\Test\TuControlador;
use App\Http\Controllers\Dashboard\PostController;
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

 Route::get('/producto', function (){
        //return redirect("/contacto");
        return  to_route('bio');
 });

Route::get("/panel", function (){
        return view('panel.panel1');
});

Route::get("/detalle", function (){
    return view("detalle");
});

//Route::get('/test/{id}', [TuControlador::class, 'index']);
Route::get('/test/{id?}', [TuControlador::class, 'index']);

Route::get('/test1', function(){
    echo "Estoy es Test";
});

Route::resource('post', PostController::class);

