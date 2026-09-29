<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    // Task 3

    public function index(): View
    {
        $categories = Category::query()->orderBy('name')->paginate(10);

        return view('categories.index', ['categories' => $categories]);
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'description' => 'nullable|string|max:500',
        ]);
        Category::create($data);         // stores our category into database.

        return redirect(route('categories.index'))->with('success', 'Category Created Successfully.');  // after storing redirects to index page.
    }

    public function show(Category $category): View
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', ['category' => $category]);
    }

    public function update(Category $category, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('categories', 'name')->ignore($category->id)],
            'description' => 'nullable|string|max:500',
        ]);

        $category->update($data);

        return redirect(route('categories.index'))->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category): RedirectResponse
    {

        try {
            $category->delete();

            return redirect()
                ->route('categories.index')
                ->with('success', 'Category deleted successfully.');
        } catch (QueryException) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'This category cannot be deleted because it has products.');
        }
    }
}
