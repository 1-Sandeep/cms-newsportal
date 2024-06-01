<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PostRequest;
use App\Models\Post;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{


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


    public function create()
    {
        $authors = Author::where('trash', 0)->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $categories = Category::where('trash', 0)->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $tags = Tag::orderBy('created_at', 'desc')->get();
        return view('backend.post.partials.form', [
            'authors' => $authors,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }


    public function store(PostRequest $req)
    {
        try {
            $req->validated();
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

            $post->author()->sync($req->author);
            $post->category()->sync($req->category);
            $post->tag()->sync($req->tag);

            return redirect()->route('backend.post.index')->with('success', 'Post has been added successfully');
        } catch (\Exception $err) {
            return redirect()->back()->withInput()->with('error', 'Failed to add post. Please try again.');
        }
    }


    public function edit(string $id)
    {
        try {

            $authors = Author::where('trash', 0)->where('is_active', 1)->orderBy('created_at', 'desc')->get();
            $categories = Category::where('trash', 0)->where('is_active', 1)->orderBy('created_at', 'desc')->get();
            $tags = Tag::orderBy('created_at', 'desc')->get();

            $post = Post::where('trash', 0)->findOrFail($id);
            return view('backend.post.partials.form', [
                'post' => $post,
                'authors' => $authors,
                'tags' => $tags,
                'categories' => $categories,
                'selectedCategories' => $post->category->pluck('id')->toArray(),
                'selectedAuthors' => $post->author->pluck('id')->toArray(),
                'selectedTags' => $post->tag->pluck('id')->toArray(),
            ]);
        } catch (\Exception $err) {
            return redirect()->back()->with('error', 'Post not found');
        }
    }


    public function update(PostRequest $req, string $id)
    {
        try {
            $validatedData = $req->validated();
            $post = Post::where('trash', 0)->findOrFail($id);
            $img_name = $post->image;
            if ($req->hasFile('image')) {
                $img_file = $req->file('image');
                $img_ext = $img_file->getClientOriginalExtension();
                $img_name = time() . "." . $img_ext;
                $img_file->move(public_path('uploads/post'), $img_name);
            }
            $post->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'summary' => $validatedData['summary'],
                'image' => $img_name,
                'is_published' => $req->has('is_published') ? (int)$validatedData['is_published'] : 0
            ]);


            $post->author()->sync($req->author);
            $post->category()->sync($req->category);
            $post->tag()->sync($req->tag);

            return redirect()->route('backend.post.index')->with('success', 'Post has been updated successfully');
        } catch (\Exception $err) {
            return redirect()->back()->withInput()->with('error', 'Failed to update post. Please try again.');
        }
    }


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


    public function movetotrash(string $id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->trash = 1;
            $post->save();
            return redirect()->route('backend.post.index')->with('success', 'Post has been moved to trash');
        } catch (\Exception $err) {
            return redirect()->route('backend.post.index')->json('error', 'Failed to move post to trash');
        }
    }


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
