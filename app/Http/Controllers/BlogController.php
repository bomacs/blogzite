<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        return Inertia::render('Blog/Index', [
            'blogs' => Blog::with('user:id,name')->latest()->get(),
            'comments' => Comment::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Blog/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'post_title' => 'required|string|max:155',
            'post_body' => 'required',
        ]);

        $request->user()->blogs()->create($validated);

        return redirect(route('blogs.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog):RedirectResponse
    {
        $this->authorize('update', $blog);

        $validated = $request->validate([
            'post_title' => 'required|string|max:155',
            'post_body' => 'required',
        ]);

        $blog->update($validated);

        return redirect(route('blogs.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog):RedirectResponse
    {
        $this->authorize('delete', $blog);

        $blog->delete();

        return redirect(route('blogs.index'));
    }

    // public function index()
    // {
    //     dd(Auth::id());
    //     return Inertia::render('UserBlogs/index', [
    //         'blogs' => Blog::where('user_id', $user->id )->latest()->get(),
    //     ]);
    // }
}
