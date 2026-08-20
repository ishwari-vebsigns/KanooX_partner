<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Admin blog listing
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();

        return view('admin.blogs.index', compact('blogs'));
    }
    /**
     * Show create blog form
     */
    public function create()
    {
        return view('admin.blogs.create');
    }
    
    /**
     * Store new blog
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:blogs,slug',
            'content'          => 'required',
            'status'           => 'required|boolean',
            'published_at'     => 'nullable|date',
            'featured_image'  => 'nullable|image|max:2048',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        


        // Safety: normalize slug
        $data['slug'] = Str::slug($request->slug);

        // Upload image (simple version)
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')
                            ->store('uploads/blogs', 'public');
            $data['featured_image'] = 'storage/' . $path;
        }

        Blog::create($data);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully');
    }
    /**
     * Show edit blog form
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }
    
    /**
     * Update blog
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
            'content'          => 'required',
            'status'           => 'required|boolean',
            'published_at'     => 'nullable|date',
            'featured_image'   => 'nullable|image|max:2048',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string|max:255',
        ]);
    
        $data = $request->all();
        $data['slug'] = Str::slug($request->slug);
    
        // Image upload (optional)
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')
                            ->store('uploads/blogs', 'public');
            $data['featured_image'] = 'storage/' . $path;
        }
    
        $blog->update($data);
    
        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully');
    }
    /**
     * Delete blog
     */
    public function destroy(Blog $blog)
    {
        // Optional: delete featured image from storage
        if ($blog->featured_image && file_exists(public_path($blog->featured_image))) {
            @unlink(public_path($blog->featured_image));
        }
    
        $blog->delete();
    
        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully');
    }


}













