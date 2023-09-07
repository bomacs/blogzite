<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserblogsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke():Response
    {
        // $blogs = Blog::where('user_id', Auth::id())->latest()->get();
        // return Inertia::render('Blog/Userblogs', [
        //     'blogs' => Blog::with('user:id,name')->latest()->get(),
        // ]);
        return Inertia::render('Blog/Userblogs', [
            'blogs' => Blog::where('user_id', Auth::id())->with('user:id,name')->latest()->get(),
        ]);
    }
}
