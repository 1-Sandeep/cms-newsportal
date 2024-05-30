<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PostRequest;
use App\Models\Author;

class PostController extends Controller
{
    /**
     * Display listing of resource
     *
     * @return void
     */
    public function index()
    {
        $posts = Post::where('created_at', '<=', Carbon::now())
            ->where('trash', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('backend.post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show a form, to create a new resource
     *
     * @return void
     */
    public function create()
    {
        $authors = Author::where('trash', 0)->where('is_active', 1)->orderBy('created_at', 'desc');
        return view('backend.post.partials.form', [
            'authors' => $authors
        ]);
    }

    /**
     * Stores a newly created resource
     *
     * @param PostRequest $req
     * @return void
     */
    public function store(PostRequest $req)
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
                $img_file->move(public_path('uploads/post'));
            }

            $post = new Post([
                'title' => $req->title,
                'description' => $req->description,
                'summary' => $req->summary,
                'image' => $img_name,
                'is_published' => $req->has('is_published') ? (int)$req->is_published : 0
            ]);
            $post->save();

            return redirect()->route('backend.post.index')->with('success', 'Post has been added successfully');
        } catch (\Exception $err) {
            return redirect()->back()->withInput()->with('error', 'Failed to add post. Please try again.');
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
            $post = Post::where('trash', 0)->findOrFail($id);
            return view('backend.post.partials.form', [
                'post' => $post,
            ]);
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Post not found');
        }
    }

    /**
     * Stores updated resource
     *
     * @param PostRequest $req
     * @param string $id
     * @return void
     */
    public function update(PostRequest $req, string $id)
    {
        try {
            // Validate the request
            $validatedData = $req->validated();

            // Find the post
            $post = Post::where('trash', 0)->findOrFail($id);

            // Initialize image name, with the old one
            $img_name = $post->image;

            // Check if a new image is uploaded
            if ($req->hasFile('image')) {
                $img_file = $req->file('image');
                $img_ext = $img_file->getClientOriginalExtension();
                $img_name = time() . "." . $img_ext;
                $img_file->move(public_path('uploads/post'), $img_name);
            }

            // Update the post
            $post->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'summary' => $validatedData['summary'],
                'image' => $img_name,
                'is_published' => $req->has('is_published') ? (int)$validatedData['is_published'] : 0
            ]);

            return redirect()->route('backend.post.index')->with('success', 'Post has been updated successfully');
        } catch (\Exception $err) {
            return redirect()->back()->withInput()->with('error', 'Failed to update post. Please try again.');
        }
    }


    /**
     * Dispay listing of trashed post
     *
     * @return void
     */
    public function viewtrash()
    {
        try {
            $posts = Post::where('created_at', '<=', Carbon::now())
                ->where('trash', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('backend.post.trash', [
                'posts' => $posts,
            ]);
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Failed to retrieve trashed posts. Please try again.');
        }
    }


    /**
     * Moves a post to the trash
     *
     * @param string $id
     * @return void
     */
    public function movetotrash(string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->trash = 1;
            $post->save(); // Save the changes to the database
            return redirect()->route('backend.post.index')->with('success', 'Post has been moved to trash');
        } catch (\Exception $err) {
            return redirect()->route('backend.post.index')->json('error', 'Failed to move post to trash');
        }
    }


    /**
     * Restores a post from trash
     *
     * @param string $id
     * @return void
     */
    public function restore(string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->trash = 0;
            $post->save();
            return redirect()->route('backend.post.viewtrash')->with('success', 'Post has been restored successfully');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Failed to restore post. Please try again.');
        }
    }


    /**
     * Delete a post from trash
     *
     * @param string $id
     * @return void
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return redirect()->route('backend.post.viewtrash')->with('success', 'Post has been deleted successfully');
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Failed to delete the post. Please try again.');
        }
    }

    /**
     * Change the status of the post,
     *
     * @param Request $req
     * @param string $id
     * @return void
     */
    public function updatestatus(Request $req, string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->is_published = $req->is_published;
            $post->save();
            return response()->json(['message' => 'Post status updated successfully'], 200);
        } catch (\Exception $err) {
            return response()->json(['message' => 'Failed to update post status'], 500);
        }
    }
}
