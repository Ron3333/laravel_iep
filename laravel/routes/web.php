<?php
use App\Http\Controllers\Test\TuControlador;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

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


Route::group(['prefix' => 'dashboard', 'middleware' => ['auth',App\Http\Middleware\UserIsAdminMiddleware::class]], function () {
    Route::get('/', function () {
        return view('dashboard.dashboard');
            })->name("dashboard");

    Route::resources([
        'post' => App\Http\Controllers\Dashboard\PostController::class,
        'category' => App\Http\Controllers\Dashboard\CategoryController::class,
    ]);
});

Route::get('/db', function () {
/*
$post = Post::join('categories', 'categories.id', '=', 'posts.category_id')->select('posts.*', 'categories.title as category')->orderBy('posts.created_at', 'desc')->toSql();
 echo $post;
echo "<br><br>";
$ver = Post::limit(3)->toSql();
 echo $ver;

 $category_slug= "xxxxxxxxxxxx";
echo "<br><br>";

$posts2 = Post::join('categories', 'categories.id', '=', 'posts.category_id')->select('posts.*', 'categories.title as category', 'categories.slug as c_slug')->where('categories.slug', $category_slug)->where('posted', "yes")->where(function ($query) {
    $query->orWhere('type', 'post')
        ->orWhere('type', 'courses')
        ->orWhere('type', 'group');
})
    ->orderBy('posts.created_at', 'desc')
    ->toSql();

echo $posts2 ;

$ids = array( 1, 2, 3, 4, 5, 6 );
$posts3 = Post::whereIn('posts.id',$ids)->toSql();

echo "<br><br>";
echo $posts3;
$slug = "asdasdadasd";
$posts4 = Post::where('slug', $slug)->first()->toSql();

echo "<br><br>";
echo $posts4;

$post5 = Post::find(1);
$json = $post5->toJson();

echo $json;


$users = Post::where('type', 'post')
 ->orWhere('type', 'book')
 ->orderBy('created_at', 'desc')
 ->limit(10)
 ->toSql();

echo "<br><br>";
echo $users;
*/



$posts7 = Post::where('id','>=', 1)->get();

foreach($posts7 as $post7){
  echo "Titulo: ". $post7->title . "<br>";
  echo "Slug: ". $post7->slug . "<br>";
  echo "Content: ". $post7->content . "<br>";
  echo "*************************************";
  }
// dd($posts7);

$post8 = Post::where('id','>=', 1)->pluck('content', 'title');

dd($post8);

});

