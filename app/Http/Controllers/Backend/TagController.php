<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Tag;
use App\Http\Requests\Backend\TagRequest;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.tag.index', [
            'tags' => $tags
        ]);
    }

    public function store(TagRequest $req)
    {
        try {
            $req->validated();
            $tag = new Tag(['title' => $req->title]);
            $tag->save();
            return redirect()->route('backend.tag.index')->with('success', 'Tag has been added successfully');
        } catch (Exception $err) {
            return redirect()->route('backend.tag.index')->with('error', 'Failed to add new tag')->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->delete();
            return redirect()->route('backend.tag.index')->with('success', 'Tag has been deleted');
        } catch (Exception $err) {
            return redirect()->back()->with('error', 'Failed to delete tag');
        }
    }
}
