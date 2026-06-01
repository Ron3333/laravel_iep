<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth; // <-- IMPORTANTE: Agregar esta línea

class CategoryController extends Controller
{
    public function index(): View
    {
        // Verificar si el usuario tiene permiso para ver el índice de categorías
        if (!Auth::user()->hasPermissionTo('editor.category.index')) {
            abort(403, 'No tienes permiso para ver las categorías');
        }

        $categories = Category::paginate(10);
        return view('dashboard.category.index', compact('categories'));
    }

    public function create(): View
    {
        // Verificar si el usuario tiene permiso para crear categorías
        if (!Auth::user()->hasPermissionTo('editor.category.create')) {
            abort(403, 'No tienes permiso para crear categorías');
        }

        $category = new Category();
        return view('dashboard.category.create', compact('category'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        // Verificar si el usuario tiene permiso para crear categorías
        if (!Auth::user()->hasPermissionTo('editor.category.create')) {
            abort(403, 'No tienes permiso para crear categorías');
        }

        $data = $request->validated();
        Category::create($data);
        return to_route('category.index')->with('status', 'Category created');
    }

    public function show(Category $category): View
    {
        // Verificar si el usuario tiene permiso para ver categorías
        if (!Auth::user()->hasPermissionTo('editor.category.index')) {
            abort(403, 'No tienes permiso para ver las categorías');
        }

        return view('dashboard.category.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        // Verificar si el usuario tiene permiso para editar categorías
        if (!Auth::user()->hasPermissionTo('editor.category.update')) {
            abort(403, 'No tienes permiso para editar categorías');
        }

        return view('dashboard.category.edit', compact('category'));
    }

    public function update(PutRequest $request, Category $category): RedirectResponse
    {
        // Verificar si el usuario tiene permiso para editar categorías
        if (!Auth::user()->hasPermissionTo('editor.category.update')) {
            abort(403, 'No tienes permiso para editar categorías');
        }

        $data = $request->validated();
        $category->update($data);
        return to_route('category.index')->with('status', 'Category updated');
    }

    public function destroy(Category $category): RedirectResponse
    {
        // Verificar si el usuario tiene permiso para eliminar categorías
        if (!Auth::user()->hasPermissionTo('editor.category.destroy')) {
            abort(403, 'No tienes permiso para eliminar categorías');
        }

        $category->delete();
        return to_route('category.index')->with('status', 'Category deleted');
    }
}