<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PageRequest;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::where('created_at', '<', Carbon::now())->orderBy('created_at', 'asc')->get();
        if (request()->ajax()) {
            return response()->json([
                'html' => view('backend.page.partials.pages_table', compact('pages'))->render()
            ]);
        }
        return view('backend.page.index', compact('pages'));
    }



    public function store(PageRequest $req)
    {
        try {
            $validatedData = $req->validated();

            if ($req->slug !== Str::slug($req->title, '-')) {
                return response()->json([
                    'message' => 'Validation Error',
                    'errors' => ['slug' => ['Please enter a valid slug.']]
                ], 422);
            }

            $page = Page::create([
                'title' => trim(strip_tags($validatedData['title'])),
                'slug' =>  trim(strip_tags($validatedData['slug'])),
                'description' => $validatedData['description'],
                'status' => $req->has('status') ? (int)$req->status : 0,
            ]);

            return response()->json(['message' => 'Page created successfully!', 'page' => $page], 200);
        } catch (ValidationException $err) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $err->errors()
            ], 422);
        } catch (\Exception $err) {
            Log::error('Page creation failed', [
                'error' => $err->getMessage(),
                'stack' => $err->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Failed to create page.',
                'error' => $err->getMessage()
            ], 500);
        }
    }

    public function edit(string $id)
    {
        dd($id);
        try {
            $page = Page::findOrFail($id);
            return response()->json(['page' => $page]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Page not found.'], 404);
        }
    }


    public function update(PageRequest $req, string $id)
    {
        dd($req->all());
    }

    public function destroy(string $id)
    {
        try {
            $page = Page::findOrFail($id);
            $page->delete();

            return response()->json([
                'success' => true,
                'message' => 'Page deleted successfully.',
            ]);
        } catch (ModelNotFoundException $e) {
            // Page not found
            return response()->json([
                'success' => false,
                'message' => 'Page not found.',
            ], 404);
        } catch (\Exception $e) {
            // General error
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the page.',
            ], 500);
        }
    }


    public function updatestatus(Request $req, string $id)
    {
        try {
            // Fetch the page by ID
            $page = Page::findOrFail($id);

            // Validate the incoming request if necessary
            $validatedData = $req->validate([
                'status' => 'required|boolean',
            ]);

            // Update the status
            $page->status = $validatedData['status'];
            $page->save();

            // Return a successful response
            return response()->json([
                'message' => 'Page status updated successfully.',
                'status' => $page->status,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the page is not found
            return response()->json([
                'message' => 'Page not found.',
            ], 404);
        } catch (\Exception $err) {
            // Handle other errors
            return response()->json([
                'message' => 'Failed to update page status.',
                'errors' => ['error' => $err->getMessage()],
            ], 500);
        }
    }
}
