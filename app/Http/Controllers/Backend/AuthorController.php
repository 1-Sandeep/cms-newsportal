<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display listing of resource
     *
     * @return void
     */
    public function index()
    {
        $authors = Author::where('created_at', '<=', Carbon::now())
            ->where('trash', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('backend.author.index', [
            'authors' => $authors
        ]);
    }

    /**
     * Show a form, to create a new resource
     *
     * @return void
     */
    public function create()
    {
        return view('backend.author.partials.form');
    }

    /**
     * Stores a newly created resource
     *
     * @param AuthorRequest $req
     * @return void
     */
    public function store(AuthorRequest $req)
    {
        try {
            // Validate the request
            $req->validated();

            // Initialize image name
            $img_name = null;

            if ($req->has('image')) {
                $img_file = $req->file('image');
                $img_ext = $img_file->getClientOriginalExtension();
                $img_name = time() . "." . $img_ext;
                $img_file->move(public_path('uploads/authors'));
            }

            $author = new Author([
                'name' => $req->name,
                'description' => $req->description,
                'image' => $img_name,
                'is_active' => $req->has('is_active') ? (int)$req->is_active : 0
            ]);
            $author->save();

            return redirect()->route('backend.author.index')->with('success', 'Author has been added successfully');
        } catch (\Exception $err) {
            return redirect()->back()->withInput()->with('error', 'Failed to add author. Please try again.');
        }
    }

    /**
     * Show a from, to update a existing resource
     *
     * @param string $id
     * @return void
     */
    public function edit(string $id)
    {
        try {
            $author = Author::where('trash', 0)->findOrFail($id);
            return view('backend.author.partials.form', [
                'author' => $author,
            ]);
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Author not found');
        }
    }

    /**
     * Stores updated resource
     *
     * @param AuthorRequest $req
     * @param string $id
     * @return void
     */
    public function update(AuthorRequest $req, string $id)
    {
        try {
            // Validate the request
            $validatedData = $req->validated();

            // Find the author
            $author = Author::where('trash', 0)->findOrFail($id);

            // Initialize image name, with the old one
            $img_name = $author->image;

            // Check if a new image is uploaded
            if ($req->hasFile('image')) {
                $img_file = $req->file('image');
                $img_ext = $img_file->getClientOriginalExtension();
                $img_name = time() . "." . $img_ext;
                $img_file->move(public_path('uploads/authors'), $img_name);
            }

            // Update the author
            $author->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'image' => $img_name,
                'is_active' => $req->has('is_active') ? (int)$validatedData['is_active'] : 0
            ]);

            return redirect()->route('backend.author.index')->with('success', 'Author has been updated successfully');
        } catch (\Exception $err) {
            return redirect()->back()->withInput()->with('error', 'Failed to update author. Please try again.');
        }
    }


    /**
     * Dispay listing of trashed author
     *
     * @return void
     */
    public function viewtrash()
    {
        $authors = Author::where('created_at', '<=', Carbon::now())
            ->where('trash', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('backend.author.trash', [
            'authors' => $authors
        ]);
    }

    /**
     * Moves a author to the trash
     *
     * @param string $id
     * @return void
     */
    public function movetotrash(string $id)
    {
        try {
            $author = Author::findOrFail($id);
            $author->trash = 1;
            $author->save();
            return redirect()->route('backend.author.index')->with('success', 'Author has been moved to trash');
        } catch (\Exception $err) {
            return redirect()->route('backend.author.index')->json('error', 'Failed to move author to trash');
        }
    }

    /**
     * Restores a author from trash
     *
     * @param string $id
     * @return void
     */
    public function restore(string $id)
    {
        try {
            $author = Author::findOrFail($id);
            $author->trash = 0;
            $author->save();
            return redirect()->route('backend.author.viewtrash')->with('success', 'Author has been restored successfully');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Failed to restore author. Please try again.');
        }
    }

    /**
     * Delete a author from trash
     *
     * @param string $id
     * @return void
     */
    public function destroy(string $id)
    {
        try {
            $author = Author::findOrFail($id);
            $author->delete();
            return redirect()->route('backend.author.viewtrash')->with('success', 'Author has been deleted successfully');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Failed to delete the author. Please try again.');
        }
    }

    /**
     * Change the status of the author,
     *
     * @param Request $req
     * @param string $id
     * @return void
     */
    public function updatestatus(Request $req, string $id)
    {
        try {
            $author = Author::findOrFail($id);
            $author->is_active = $req->is_active;
            $author->save();
            return response()->json(['message' => 'Author status updated successfully'], 200);
        } catch (\Exception $err) {
            return response()->json(['message' => 'Failed to update author status'], 500);
        }
    }
}
