<?php

namespace App\Http\Controllers\Backend;

use Exception;
use App\Models\Backend\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.tag.index', [
            'tags' => $tags
        ]);
    }

    // public function fetchTags()
    // {
    //     try {
    //         $tags = Tag::orderBy('created_at', 'desc')->paginate(10);
    //         return response()->json(['tags' => $tags], 200);
    //     } catch (Exception $err) {
    //         return response()->json(['message' => $err, 'status' => 'error']);
    //     }
    // }


    public function store(TagRequest $req)
    {
        try {
            $req->validated();
            $tag = new Tag(['title' => $req->title]);
            $tag->save();
            return redirect()->route('backend.tag.index')->with('success', 'Tag has been added successfully');
            // return response()->json(['message' => 'Tag has been added', 'tag' => $tag], 200);
        } catch (Exception $err) {
            return redirect()->route('backend.tag.index')->with('error', 'Failed to add new tag')->withInput();
            // return response()->json(['message' => 'There was an error adding the tag'], 500);
        }
    }

    public function edit($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            return response()->json(['tag' => $tag]);
        } catch (Exception $err) {
            return response()->json(['message' => 'Failed to find tag']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
        } catch (Exception $err) {
        }
    }

    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $tag->delete();
            return response()->json(['message' => 'Tag has been deleted']);
        } catch (Exception $err) {
            return response()->json(['message' => 'Failed to find tag']);
        }
    }
}
