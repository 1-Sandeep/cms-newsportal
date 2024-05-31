<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Carbon\Carbon;
use App\Models\Backend\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryRequest;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::where('created_at', '<=', Carbon::now())
            ->where('trash', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('backend.category.index', [
            'categories' => $categories
        ]);
    }


    public function create()
    {
        return view('backend.category.partials.form');
    }


    public function store(CategoryRequest $req)
    {
        try {
            $req->validated();
            if ($req->slug !== Str::slug($req->slug, '-')) {
                return redirect()->route('backend.category.create')->with('error', 'The slug is not valid')->withInput();
            }
            $category = Category::create([
                'title' => $req->title,
                'slug' => $req->slug,
                'is_active' =>  $req->has('is_active') ? (int)$req->is_active : 0
            ]);

            return redirect()->route('backend.category.index')->with('success', 'New category has been added');
        } catch (Exception $err) {
            return redirect()->route('backend.category.create')->with('error', 'Failed to create new category')->withInput();
        }
    }


    public function edit(string $id)
    {
        try {
            $category = Category::where('trash', 0)->findOrFail($id);
            return view('backend.category.partials.form', [
                'category' => $category
            ]);
        } catch (Exception $err) {
            return redirect()->back()->with('error', 'Category not found');
        }
    }


    public function update(CategoryRequest $req, string $id)
    {
        try {
            $req->validated();
            $category = Category::where('trash', 0)->findOrFail($id);
            if ($req->slug !== Str::slug($req->slug, '-')) {
                return redirect()->route('backend.category.edit', $id)->with('error', 'The slug is not valid')->withInput();
            }
            $category->update([
                'title' => $req->title,
                'slug' => $req->slug,
                'is_active' =>  $req->has('is_active') ? (int)$req->is_active : 0
            ]);
            return redirect()->route('backend.category.index')->with('success', 'Category has been updated successfully');
        } catch (Exception $err) {
            dd($err);
            return redirect()->back()->with('error', 'Category not found');
        }
    }


    public function viewtrash()
    {
        $categories = Category::where('created_at', '<=', Carbon::now())
            ->where('trash', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('backend.category.trash', [
            'categories' => $categories
        ]);
    }


    public function movetotrash(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->trash = 1;
            $category->save();
            return redirect()->route('backend.category.index')->with('success', 'Category has been moved to trash');
        } catch (Exception $err) {
            return redirect()->back()->with('error', 'Category failed to moved to trash');
        }
    }


    public function restore(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->trash = 0;
            $category->save();
            return redirect()->route('backend.category.viewtrash')->with('success', 'Category has been restored successfully');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Failed to restore category. Please try again.');
        }
    }


    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('backend.category.viewtrash')->with('success', 'Category has been deleted successfully');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Failed to delete the category. Please try again.');
        }
    }


    public function updatestatus(Request $req, string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->is_active = $req->is_active;
            $category->save();
            return response()->json(['message' => 'Category status updated successfully'], 200);
        } catch (\Exception $err) {
            return response()->json(['message' => 'Failed to update category status'], 500);
        }
    }
}
