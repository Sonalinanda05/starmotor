<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function bannerView()
    {
        $banners = Banner::latest()->get();
        return view('admin.Banner.view', compact('banners'));
    }
    public function bannerCreate()
    {
        return view('admin.Banner.create');
    }

    public function bannerStore(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'banner_image' => 'required', // adjust the allowed file types and maximum size as needed
        ]);
        $banner = new Banner();

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $imageFilename = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('banner_images', $imageFilename, 'public');
            $banner->banner = 'banner_images/' . $imageFilename;
        }
        $banner->save();
        // Redirect to the view page or any other desired location
        return redirect()->route('admin.banner.view')->with('success', 'Banner added successfully');
    }
    public function bannerEdit($id)
    {
        $banners=Banner::find($id);
        return view('admin.Banner.edit',compact('banners'));
    }

    public function bannerUpdate($id,Request $request)
    {
        $banners=Banner::find($id);

        if ($request->hasFile('banner_image')) {
            // Delete the existing image
            Storage::disk('public')->delete($banners->banner);
    
            // Upload and store the new image
            $file = $request->file('banner_image');
            $imageFilename = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('car_images', $imageFilename, 'public');
            $banners->banner = 'car_images/' . $imageFilename;
        }
        $banners->save();
        return redirect()->route('admin.banner.view')->with('success', 'Banner Updated successfully');
    }

    public function bannerDelete($id){
        $banners=Banner::find($id);
        $banners->delete();
        return redirect()->back()->with('success', 'Banner deleted successfully');
    }
}
