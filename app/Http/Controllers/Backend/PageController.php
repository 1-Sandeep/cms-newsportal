<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        // $pages = Page::where('status', 1)->get();
        $pages = Page::where('status', 1)->paginate(8);
        return view('backend.page.index', compact('pages'));
    }
}
