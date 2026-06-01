<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; // <-- IMPORTANTE: Agregar esta línea

class PostController extends Controller
{
    public function index(): View
    {
        // Verificar si el usuario tiene permiso para ver el índice de posts
        if (!Auth::user()->hasPermissionTo('editor.post.index')) {
            abort(403, 'No tienes permiso para ver los posts');
        }

        $posts = Post::paginate(10);
        return view('dashboard.post.index', compact('posts'));
    }

    public function create(): View
    {
        // Verificar si el usuario tiene permiso para crear posts
        if (!Auth::user()->hasPermissionTo('editor.post.create')) {
            abort(403, 'No tienes permiso para crear posts');
        }

        $categories = Category::pluck('id', 'title');
        $post = new Post();
        return view('dashboard.post.create', compact('categories', 'post'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        // Verificar si el usuario tiene permiso para crear posts
        if (!Auth::user()->hasPermissionTo('editor.post.create')) {
            abort(403, 'No tienes permiso para crear posts');
        }

        $data = $request->validated();

         if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->extension();
            $file->move(public_path('image'), $filename);
            $data['image'] = $filename;
        }
        Post::create($data);
        return to_route('post.index')->with('status', 'Post created');
    }

    public function show(Post $post): View
    {
        // Verificar si el usuario tiene permiso para ver posts
        if (!Auth::user()->hasPermissionTo('editor.post.index')) {
            abort(403, 'No tienes permiso para ver posts');
        }

        return view('dashboard.post.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        // Verificar si el usuario tiene permiso para editar posts
        if (!Auth::user()->hasPermissionTo('editor.post.update')) {
            abort(403, 'No tienes permiso para editar posts');
        }

        $categories = Category::pluck('id', 'title');
        return view('dashboard.post.edit', compact('post', 'categories'));
    }

    public function update(PutRequest $request, Post $post): RedirectResponse
    {
        // Verificar si el usuario tiene permiso para editar posts
        if (!Auth::user()->hasPermissionTo('editor.post.update')) {
            abort(403, 'No tienes permiso para editar posts');
        }

        $data = $request->validated();

        if( isset($data["image"])){
            $data["image"] = time().".".$data["image"]->extension();
            $request->image->move(public_path("image"), $data["image"] );
        }

        $post->update($data);
        return to_route('post.index')->with('status', 'Registro actualizado');
    }

    public function destroy(Post $post): RedirectResponse
    {
        // Verificar si el usuario tiene permiso para eliminar posts
        if (!Auth::user()->hasPermissionTo('editor.post.destroy')) {
            abort(403, 'No tienes permiso para eliminar posts');
        }

        $post->delete();
        return to_route('post.index')->with('status', 'Post deleted');
    }
}