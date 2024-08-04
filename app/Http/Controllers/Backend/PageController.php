<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PageRequest;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    public function index()
    {
        // $pages = Page::where('status', 1)->get();
        $pages = Page::where('status', 1)->paginate(8);
        return view('backend.page.index', compact('pages'));
    }

    public function store(PageRequest $req)
    {
        try {
            $req->validated();
            // Check if the provided slug matches the generated slug
            if ($req->slug !== Str::slug($req->title, '-')) {
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => ['slug' => ['Please enter a valid slug.']]
                ], 422);
            }

            Page::create([
                'title' => $req->title,
                'slug' => $req->slug,
                'description' => $req->description,
                'status' => $req->has('status') ? (int)$req->status : 0,
            ]);

            return response()->json(['message' => 'Page created successfully!'], 200);
        } catch (ValidationException $err) {
            // Handle validation exceptions
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $err->errors()
            ], 422);
        } catch (\Exception $err) {
            // Log the exception or handle it as needed
            return response()->json([
                'message' => 'Failed to create page.',
                'error' => $err->getMessage()
            ], 500);
        }
    }


    public function edit(string $id)
    {
        return "dsadad";
    }
}
