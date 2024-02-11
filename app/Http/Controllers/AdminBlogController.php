<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class AdminBlogController extends Controller
{
    public function index()
    {
        return view('admin.blogs.index', [
            'blogs' => Blog::latest()->paginate(6)
        ]);
    }

    public function create()
    {
        return view('admin.blogs.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(PostRequest $request)
    {
        $formData = $request->validated();
        $formData['user_id'] = auth()->id();
        $formData['thumbnail'] = '/storage/' . request('thumbnail')->store('/blogs');
        Blog::create($formData);
        return redirect('/');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', [
            'blog' => $blog,
            'categories' => Category::all()
        ]);
    }

    public function update(PostRequest $request,Blog $blog)
    {
        $formData = $request->validated();
        $formData['user_id'] = auth()->id();
        if (request('thumbnail')) {
            $cleanData['thumbnail'] = '/storage/' . request('thumbnail')->store('/blogs');
            File::delete(public_path($blog->photo));
        }
        $blog->update($formData);
        return redirect('/');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back();
    }
}