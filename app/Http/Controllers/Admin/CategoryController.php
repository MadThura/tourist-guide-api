<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index', [
            'categories' => Category::paginate()
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:20']
        ]);

        $duplicate = Category::where('name', $request->name)
            ->first();

        if ($duplicate) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['name' => 'A category with this name already exists.']);
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'New Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.category.create', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:20', Rule::unique('categories', 'name')]
        ]);

        $duplicate = Category::where('name', $request->name)
            ->first();

        if ($duplicate) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['name' => 'A category with this name already exists.']);
        }

        $category->name = $request->name;
        $category->update();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function trashed()
    {
        return view('admin.category.trash', [
            'categories' => Category::onlyTrashed()->get()
        ]);
    }

    public function restore($id)
    {

        $category = Category::withTrashed()->findOrFail($id);

        $category->restore();

        return back()->with('success', 'Category restored.');
    }

    public function forceDelete($id)
    {

        $category = Category::withTrashed()->findOrFail($id);

        $category->forceDelete();


        return back()->with('success', 'Category permanently deleted.');
    }
}
