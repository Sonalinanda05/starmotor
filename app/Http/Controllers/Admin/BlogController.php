<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogView()
    {
        $blogs = Blog::latest()->get();
        return view('admin.Blog.view', compact('blogs'));
    }

    public function blogShow($id)
    {
        $blog = Blog::find($id);
        return view('admin.Blog.show', compact('blog'));
    }

    public function blogCreate()
    {

        return view('admin.Blog.create');
    }

    public function blogStore(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'image' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create a new Blog instance
        $blog = new Blog();

        $blog->title = $validatedData['title'];
        $blog->description = $validatedData['description'];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageFilename = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('blog_images', $imageFilename, 'public');
            $blog->image = 'blog_images/' . $imageFilename;
        } else {
            $blog->image = null; // Set a default image path or handle it as needed
        }

        // Save the blog instance
        $blog->save();

        // Redirect to the view page or any other desired location
        return redirect()->route('admin.blog.view')->with('success', 'Blog added successfully');
    }

    public function blogEdit($id)
    {
        $blogs = Blog::find($id);
        return view('admin.Blog.edit', compact('blogs'));
    }

    public function blogUpdate(Request $request, $id)
    {

        $blog = Blog::find($id);

        $blog->title = $request->title;
        $blog->description = $request->description;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $imageFilename = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('blog_images', $imageFilename, 'public');
            $blog->image = 'blog_images/' . $imageFilename;
        }
        // Save the blog instance
        $blog->save();

        // Redirect to the view page or any other desired location
        return redirect()->route('admin.blog.view')->with('success', 'Blog updated successfully');
    }

    public function blogDelete($id)
    {
        $blogs = Blog::find($id);
        $blogs->delete();
        return redirect()->route('admin.blog.view')->with('success', 'Blog deleted successfully');
    }

    public function blogsearch(Request $request)
    {
        $search = $request->input('search');

        $blogs = Blog::where('title', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->latest()->get();

        return view('admin.Blog.search', compact('blogs'));
    }
}
