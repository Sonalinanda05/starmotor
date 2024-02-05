<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function carView()
    {
        $Total_Cars = Car::all();
        $Total_Cars_sale = Car::where('status', 'Not Sold')->count();
        $Sold_Cars = Car::where('status', 'Sold')->count();
        $cars = Car::latest()->get();
        return view('admin.SellCars.view', compact('cars', 'Total_Cars_sale', 'Sold_Cars', 'Total_Cars'));
    }

    public function carCreate()
    {
        return view('admin.SellCars.create');
    }

    public function carStore(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'image' => 'required',
            'gallery_image' => 'sometimes|array',
            'gallery_image.*' => 'sometimes|image',
            'Registration_Number' => 'required|unique:cars',

            'name' => 'required|string',
            'brand' => 'required|string',
            'location' => 'required|string',
            'car_age' => 'required|string',
            'fuel_type' => 'required|string',
            'kilometers_driven' => 'required|integer',
            'cost_price' => 'required|integer',
            'sell_price' => 'integer',
            'color' => 'required|string',
            'owners_count' => 'required|string',
            'model' => 'required|string',
            'body_type' => 'required|string',
            'transmission' => 'required|string',
        ]);

        // Initialize $imagePath

        $galleryImages = [];

        // Create a new Car instance
        $car = new Car();
        $car->Registration_Number = $validatedData['Registration_Number'];
        $car->name = $validatedData['name'];
        $car->brand = $validatedData['brand'];
        $car->badge = $request->badge;
        $car->warranty = $request->warranty;
        $car->free_service_count = $request->free_service_count;
        $car->location = $validatedData['location'];
        $car->car_age = $validatedData['car_age'];
        $car->fuel_type = $validatedData['fuel_type'];
        $car->kilometers_driven = $validatedData['kilometers_driven'];
        $car->cost_price = $validatedData['cost_price'];
        $car->sell_price = $validatedData['sell_price'];
        $car->color = $validatedData['color'];
        $car->owners_count = $validatedData['owners_count'];
        $car->model = $validatedData['model'];
        $car->body_type = $validatedData['body_type'];
        $car->transmission = $validatedData['transmission'];
        $car->status = $request->status;

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageFilename = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('car_images', $imageFilename, 'public');
            $car->image = 'car_images/' . $imageFilename;
        }
        // Handle gallery images upload

        if ($request->hasFile('gallery_image')) {
            foreach ($request->file('gallery_image') as $galleryImage) {
                $galleryFilename = uniqid() . '_' . $galleryImage->getClientOriginalName();
                $galleryImage->storeAs('car_images/gallery', $galleryFilename, 'public');
                $galleryImages[] = 'car_images/gallery/' . $galleryFilename;
            }
        }

        // Save the gallery images as JSON
        $car->gallery_image = json_encode($galleryImages);

        // Save the car instance
        $car->save();

        // Redirect to the view page or any other desired location
        return redirect()->route('admin.car.view')->with('success', 'Car added successfully');
    }

    public function carEdit($id)
    {
        $cars = Car::find($id);
        return view('admin.SellCars.edit', compact('cars'));
    }

    public function carUpdate($id, Request $request)
    {
        $galleryImages = [];
        $cars = Car::find($id);
        $cars->name = $request->name;
        $cars->brand = $request->brand;
        $cars->badge = $request->badge;
        $cars->warranty = $request->warranty;
        $cars->free_service_count = $request->free_service_count;
        $cars->location = $request->location;
        $cars->car_age = $request->car_age;
        $cars->fuel_type = $request->fuel_type;
        $cars->kilometers_driven = $request->kilometers_driven;
        $cars->cost_price = $request->cost_price;
        $cars->sell_price = $request->sell_price;
        $cars->color = $request->color;
        $cars->owners_count = $request->owners_count;
        $cars->model = $request->model;
        $cars->body_type = $request->body_type;
        $cars->transmission = $request->transmission;
        $cars->status = $request->status;

        if ($request->hasFile('image')) {
            // Delete the existing image
            Storage::disk('public')->delete($cars->image);

            // Upload and store the new image
            $file = $request->file('image');
            $imageFilename = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs('car_images', $imageFilename, 'public');
            $cars->image = 'car_images/' . $imageFilename;
        }

        // Handle gallery images update
        $galleryImages = [];

        if ($request->hasFile('gallery_image')) {
            // Delete the existing gallery images
            foreach (json_decode($cars->gallery_image) as $existingImage) {
                Storage::disk('public')->delete($existingImage);
            }

            // Upload and store the new gallery images
            foreach ($request->file('gallery_image') as $galleryImage) {
                $galleryFilename = uniqid() . '_' . $galleryImage->getClientOriginalName();
                $galleryImage->storeAs('car_images/gallery', $galleryFilename, 'public');
                $galleryImages[] = 'car_images/gallery/' . $galleryFilename;
            }
        }

        // Save the gallery images as JSON
        $cars->gallery_image = json_encode($galleryImages);

        // Save the updated car instance
        $cars->save();

        // Redirect to the view page or any other desired location
        return redirect()->route('admin.car.view')->with('success', 'Car details updated successfully');
    }

    public function carDelete($id)
    {
        $cars = Car::find($id);
        $cars->delete();
        return redirect()->back()->with('success', 'Car details deleted successfully');
    }

    public function carSearch(Request $request)
    {

        $Total_Cars = Car::all();
        $Total_Cars_sale = Car::where('status', 'Not Sold')->count();
        $Sold_Cars = Car::where('status', 'Sold')->count();
        $search = $request->input('search');

        $cars = Car::where('name', 'like', "%$search%")
            ->orWhere('brand', 'like', "%$search%")
            ->orWhere('car_age', 'like', "%$search%")
            ->orWhere('fuel_type', 'like', "%$search%")
            ->orWhere('cost_price', 'like', "%$search%")
            ->orWhere('color', 'like', "%$search%")
            ->orWhere('model', 'like', "%$search%")
            ->orWhere('body_type', 'like', "%$search%")
            ->orWhere('transmission', 'like', "%$search%")
            ->orWhere('status', 'like', "%$search%")
            ->latest()
            ->get();

        return view('admin.SellCars.search', compact('cars','Total_Cars','Total_Cars_sale','Sold_Cars'));
    }

}
