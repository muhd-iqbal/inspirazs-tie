<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($hash)
    {
        return view('page', [
            'page' => Page::where('slug', $hash)->first(),
        ]);
    }

    public function index()
    {
        return view('admin.pages', [
            'pages' => Page::all()
        ]);
    }

    public function edit(Page $page)
    {
        return view('admin.page', [
            'page' => $page,
        ]);
    }

    public function patch(Page $page, Request $request)
    {
        $attr = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'body' => 'required',
        ]);

        $page->update($attr);

        return back()->with('success', 'Page updated');
    }
}
