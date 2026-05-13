<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\PutRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        /*
        return Post::create(
                ['title' => "test",
                'slug' => "test",
                'content' => "test",
                'item' => "item 1",
                'category_id' => 1,
                'description' => "test",
                'posted' => "not",
                'image' => "test"]);
        */
        /*
        $post = Post::find(2);
        dd($post);
        return $post->update(
                [
                'title' => "test new",
                'slug' => "test-new",
                'content' => "test xxxxxxxxxxx",
                'item' => "item 1",
                'category_id' => 1,
                'description' => "test xxxxxx",
                'posted' => "not",
                'image' => "test"
                ]
                );
        */
             //$post = Post::get();
            // $post = Post::all();
            //->toSql();
            //$post =  Post::where('category_id', '2')->toSql();
             //dd( $post);
            //$post = Post::find(3);
           // dd($post->category);
           /*
            $categorias = Category::find(1);
            foreach($categorias->posts as $po){
               echo  $po->title;
               echo "<br>";
            }
           */
           // dd($categorias->posts[0]);

            $posts = Post::paginate(6);
           // dd($posts);
            return view('dashboard.post.index', compact('posts'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('id', 'title');
        $post = new Post();
        return view('dashboard.post.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
       //dd($request->all());
       /*
       $request->validate([
            "title" => "required|min:5|max:500",
            "slug" => "required|min:5|max:500",
            "content" => "required|min:7",
            "category_id" => "required|integer",
            "description" => "required|min:7",
            "posted" => "required"
            ]
        );
    
        $validated = Validator::make($request->all(), ["title" =>
            "required|min:5|max:500",
            "slug" => "required|min:5|max:500",
            "content" => "required|min:7",
            "category_id" => "required|integer",
            "description" => "required|min:7",
            "posted" => "required"
        ]);

       dd($validated->errors());
        */

       Post::create($request->validated());
        return to_route("post.index");

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("dashboard.post.show",compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id', 'title');
        return view('dashboard.post.edit', compact('categories', 'post'));
    }

    public function update(PutRequest $request, Post $post)
    {
         
        $data = $request->validated();
              
        if( isset($data["image"])){
            $data["image"] = time().".".$data["image"]->extension();
            $request->image->move(public_path("image"), $data["image"] );
        }
 
        $post->update($data);
        
        return to_route("post.index");
    }

    /*
    public function update(Request $request, Post $post)
    {
         //$post->update($request->validated());
       //return to_route("post.index");
        $data = $request->validated();
        if( isset($data["image"])){
        $data["image"] = time().".".$data["image"]->extension();
            $request->image->move(public_path("image"), $data["image"] );
        }
        $post->update($data);
        return to_route("post.index")->with('status', 'Post actualizado correctamente');
    }
    */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //dd($post);
        $post->delete();
        return to_route('post.index');
    }
}
