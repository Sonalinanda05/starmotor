<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Book;
use App\Models\Car;
use App\Models\Contact;
use App\Models\Review;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $banners = Banner::latest()->get();
        $recentCars = Car::latest()->limit(7)->get();
        $reviews = Review::latest()->limit(5)->get();
        $topRatedCars = Car::withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->take(5)
            ->get();

        return view('welcome', compact('banners', 'modelNames', 'recentCars', 'fuel_types', 'body_types', 'reviews', 'topRatedCars'));
    }

    public function viewCars()
    {

        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $Cars = Car::paginate(6);

        $averageRatings = [];

        foreach ($Cars as $car) {
            $averageRatings[$car->id] = $car->reviews->avg('rating');
        }
        $bodyTypesWithCounts = Car::selectRaw('UPPER(body_type) as body_type, COUNT(*) as count')
            ->groupBy('body_type')
            ->pluck('count', 'body_type')
            ->toArray();
        $brandModelsCounts = Car::selectRaw('UPPER(brand) as brand, UPPER(model) as model, COUNT(*) as count')
            ->groupBy('brand', 'model')
            ->orderBy('brand')
            ->get();

        $brandCounts = [];
        $brandModels = [];

        foreach ($brandModelsCounts as $item) {
            // Count for each brand
            if (!isset($brandCounts[$item->brand])) {
                $brandCounts[$item->brand] = $item->count;
            } else {
                $brandCounts[$item->brand] += $item->count;
            }

            // Models for each brand
            if (!isset($brandModels[$item->brand])) {
                $brandModels[$item->brand] = [];
            }
            $brandModels[$item->brand][] = ['model' => $item->model, 'count' => $item->count];
        }

        $owners = Car::selectRaw('owners_count, COUNT(*) as count')
            ->groupBy('owners_count')
            ->orderBy('owners_count')
            ->pluck('count', 'owners_count')
            ->toArray();
        $fuelTypesWithCounts = Car::selectRaw('UPPER(fuel_type) as fuel_type, COUNT(*) as count')
            ->groupBy('fuel_type')
            ->pluck('count', 'fuel_type')
            ->toArray();
        $transmissionWithCounts = Car::selectRaw('UPPER(transmission) as transmission, COUNT(*) as count')
            ->groupBy('transmission')
            ->pluck('count', 'transmission')
            ->toArray();
        return view('user.allCars', compact('Cars', 'body_types', 'fuel_types', 'modelNames', 'bodyTypesWithCounts', 'brandCounts', 'brandModels', 'owners', 'fuelTypesWithCounts', 'transmissionWithCounts', 'averageRatings'));
    }

    public function viewCarsDetails($id)
    {
        $car = Car::find($id);

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        $averageRating = $car->reviews->avg('rating');
        return view('user.carDetails', compact('car', 'modelNames', 'body_types', 'fuel_types', 'averageRating'));
    }

    public function sortCars(Request $request)
    {

        $sortBy = $request->input('sort_by');

        $carsQuery = Car::query();

        switch ($sortBy) {
            case 'Price(Low to High)':
                $carsQuery->orderBy('sell_price');
                break;
            case 'Price(High to Low)':
                $carsQuery->orderByDesc('sell_price');
                break;
            case 'Km(Low to High)':
                $carsQuery->orderBy('kilometers_driven');
                break;
            case 'Km(High to Low)':
                $carsQuery->orderByDesc('kilometers_driven');
                break;
            case 'Year Ascending':
                $carsQuery->orderBy('car_age');
                break;
            case 'Year Descending':
                $carsQuery->orderByDesc('car_age');
                break;
            default:

                break;
        }

        $sortedCars = $carsQuery->paginate(6);

        $sortedCars->appends(['sort_by' => $sortBy]);

        $averageRatings = [];

        foreach ($sortedCars as $car) {
            $averageRatings[$car->id] = $car->reviews->avg('rating');
        }

        $bodyTypesWithCounts = Car::selectRaw('UPPER(body_type) as body_type, COUNT(*) as count')
            ->groupBy('body_type')
            ->pluck('count', 'body_type')
            ->toArray();
        $brandModelsCounts = Car::selectRaw('UPPER(brand) as brand, UPPER(model) as model, COUNT(*) as count')
            ->groupBy('brand', 'model')
            ->orderBy('brand')
            ->get();

        $brandCounts = [];
        $brandModels = [];

        foreach ($brandModelsCounts as $item) {
            // Count for each brand
            if (!isset($brandCounts[$item->brand])) {
                $brandCounts[$item->brand] = $item->count;
            } else {
                $brandCounts[$item->brand] += $item->count;
            }

            // Models for each brand
            if (!isset($brandModels[$item->brand])) {
                $brandModels[$item->brand] = [];
            }
            $brandModels[$item->brand][] = ['model' => $item->model, 'count' => $item->count];
        }
        $owners = Car::selectRaw('owners_count, COUNT(*) as count')
            ->groupBy('owners_count')
            ->orderBy('owners_count')
            ->pluck('count', 'owners_count')
            ->toArray();
        $fuelTypesWithCounts = Car::selectRaw('UPPER(fuel_type) as fuel_type, COUNT(*) as count')
            ->groupBy('fuel_type')
            ->pluck('count', 'fuel_type')
            ->toArray();

        $transmissionWithCounts = Car::selectRaw('UPPER(transmission) as transmission, COUNT(*) as count')
            ->groupBy('transmission')
            ->pluck('count', 'transmission')
            ->toArray();

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        return view('user.carSort', compact('sortedCars','averageRatings', 'bodyTypesWithCounts', 'brandCounts', 'brandModels', 'owners', 'fuelTypesWithCounts', 'transmissionWithCounts', 'modelNames', 'body_types', 'fuel_types', 'sortBy'));
    }

    public function searchCars(Request $request)
    {
        // Get the input values from the form
        $modelName = $request->input('model');
        $budget = $request->input('budget');
        $location = $request->input('location');

        // Start building the query
        $carsQuery = Car::query();

        if ($modelName && $modelName != 'Model') {
            $carsQuery->where('model', $modelName);
        }

        if ($budget && $budget != 'Budget') {
            switch ($budget) {
                case 'Less than 1 Lakh':
                    $carsQuery->where('sell_price', '<', 100000);
                    break;
                case '1 to 3 Lakh':
                    $carsQuery->whereBetween('sell_price', [100000, 300000]);
                    break;
                case '3 to 6 Lakh':
                    $carsQuery->whereBetween('sell_price', [300000, 600000]);
                    break;
                case 'More than 6 Lakh':
                    $carsQuery->where('sell_price', '>', 600000);
                    break;
                default:
                    // Handle other cases or redirect to an error page
                    break;
            }
        }

        $searchResults = $carsQuery->paginate(6);
        $searchResults->appends(['query' => $carsQuery]);

        $averageRatings = [];

        foreach ($searchResults as $car) {
            $averageRatings[$car->id] = $car->reviews->avg('rating');
        }

        $bodyTypesWithCounts = Car::selectRaw('UPPER(body_type) as body_type, COUNT(*) as count')
            ->groupBy('body_type')
            ->pluck('count', 'body_type')
            ->toArray();
        $brandModelsCounts = Car::selectRaw('UPPER(brand) as brand, UPPER(model) as model, COUNT(*) as count')
            ->groupBy('brand', 'model')
            ->orderBy('brand')
            ->get();

        $brandCounts = [];
        $brandModels = [];

        foreach ($brandModelsCounts as $item) {
            // Count for each brand
            if (!isset($brandCounts[$item->brand])) {
                $brandCounts[$item->brand] = $item->count;
            } else {
                $brandCounts[$item->brand] += $item->count;
            }

            // Models for each brand
            if (!isset($brandModels[$item->brand])) {
                $brandModels[$item->brand] = [];
            }
            $brandModels[$item->brand][] = ['model' => $item->model, 'count' => $item->count];
        }
        $owners = Car::selectRaw('owners_count, COUNT(*) as count')
            ->groupBy('owners_count')
            ->orderBy('owners_count')
            ->pluck('count', 'owners_count')
            ->toArray();
        $fuelTypesWithCounts = Car::selectRaw('UPPER(fuel_type) as fuel_type, COUNT(*) as count')
            ->groupBy('fuel_type')
            ->pluck('count', 'fuel_type')
            ->toArray();

        $transmissionWithCounts = Car::selectRaw('UPPER(transmission) as transmission, COUNT(*) as count')
            ->groupBy('transmission')
            ->pluck('count', 'transmission')
            ->toArray();
        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        return view('user.searchCars', compact('searchResults', 'bodyTypesWithCounts', 'brandCounts', 'brandModels', 'owners', 'fuelTypesWithCounts', 'transmissionWithCounts', 'modelNames', 'body_types', 'fuel_types','averageRatings'));
    }

    public function contactCreate()
    {

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();

        return view('user.ContactUs.create', compact('modelNames', 'body_types', 'fuel_types'));
    }

    public function contactStore(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:contacts,email',
            'message' => 'required|string',
        ]);

        // Create a new Contact instance
        $contact = new Contact();
        $contact->name = $validatedData['name'];
        $contact->phone = $validatedData['phone'];
        $contact->email = $validatedData['email'];
        $contact->message = $validatedData['message'];

        // Save the contact instance
        $contact->save();

        return redirect()->back()->with('success', 'Contact form submitted successfully!');
    }

    public function bookCarStore(Request $request, $id)
    {
        // Validate the form data
        $validatedData = $request->validate([

            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        // Create a new CarOwner instance
        $bookCar = new Book();
        $cars = Car::find($id);
        $bookCar->car_id = $cars->id;
        $bookCar->name = $validatedData['name'];
        $bookCar->email = $validatedData['email'];
        $bookCar->phone = $validatedData['phone'];

        // Save the bookCar instance
        $bookCar->save();

        // Redirect to a thank you page or any other desired location
        return redirect()->back()->with('success', 'Car has been booked successfully!,We will get back to you soon');
    }

    public function aboutUs()
    {

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        return view('aboutUs', compact('modelNames', 'body_types', 'fuel_types'));
    }

    public function ByModel($modelName)
    {

        if ($modelName == 'all') {
            $Cars = Car::all();
        } else {
            $Cars = Car::where('model', $modelName)->paginate(6);
            $Cars->appends(['modelName' => $modelName]);
        }

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        $bodyTypesWithCounts = Car::selectRaw('UPPER(body_type) as body_type, COUNT(*) as count')
            ->groupBy('body_type')
            ->pluck('count', 'body_type')
            ->toArray();
        $brandModelsCounts = Car::selectRaw('UPPER(brand) as brand, UPPER(model) as model, COUNT(*) as count')
            ->groupBy('brand', 'model')
            ->orderBy('brand')
            ->get();

        $brandCounts = [];
        $brandModels = [];

        foreach ($brandModelsCounts as $item) {
            // Count for each brand
            if (!isset($brandCounts[$item->brand])) {
                $brandCounts[$item->brand] = $item->count;
            } else {
                $brandCounts[$item->brand] += $item->count;
            }

            // Models for each brand
            if (!isset($brandModels[$item->brand])) {
                $brandModels[$item->brand] = [];
            }
            $brandModels[$item->brand][] = ['model' => $item->model, 'count' => $item->count];
        }
        $owners = Car::selectRaw('owners_count, COUNT(*) as count')
            ->groupBy('owners_count')
            ->orderBy('owners_count')
            ->pluck('count', 'owners_count')
            ->toArray();
        $fuelTypesWithCounts = Car::selectRaw('UPPER(fuel_type) as fuel_type, COUNT(*) as count')
            ->groupBy('fuel_type')
            ->pluck('count', 'fuel_type')
            ->toArray();

        $transmissionWithCounts = Car::selectRaw('UPPER(transmission) as transmission, COUNT(*) as count')
            ->groupBy('transmission')
            ->pluck('count', 'transmission')
            ->toArray();
        return view('user.filterCar', compact('Cars', 'modelNames', 'body_types', 'fuel_types', 'bodyTypesWithCounts', 'brandCounts', 'brandModels', 'owners', 'fuelTypesWithCounts', 'transmissionWithCounts'));
    }

    public function ByBodyType($body_types)
    {

        if ($body_types == 'all') {
            $Cars = Car::all();
        } else {
            $Cars = Car::where('body_type', $body_types)->paginate(6);
            $Cars->appends(['body_types' => $body_types]);
        }

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        $bodyTypesWithCounts = Car::selectRaw('UPPER(body_type) as body_type, COUNT(*) as count')
            ->groupBy('body_type')
            ->pluck('count', 'body_type')
            ->toArray();
        $brandModelsCounts = Car::selectRaw('UPPER(brand) as brand, UPPER(model) as model, COUNT(*) as count')
            ->groupBy('brand', 'model')
            ->orderBy('brand')
            ->get();

        $brandCounts = [];
        $brandModels = [];

        foreach ($brandModelsCounts as $item) {
            // Count for each brand
            if (!isset($brandCounts[$item->brand])) {
                $brandCounts[$item->brand] = $item->count;
            } else {
                $brandCounts[$item->brand] += $item->count;
            }

            // Models for each brand
            if (!isset($brandModels[$item->brand])) {
                $brandModels[$item->brand] = [];
            }
            $brandModels[$item->brand][] = ['model' => $item->model, 'count' => $item->count];
        }
        $owners = Car::selectRaw('owners_count, COUNT(*) as count')
            ->groupBy('owners_count')
            ->orderBy('owners_count')
            ->pluck('count', 'owners_count')
            ->toArray();
        $fuelTypesWithCounts = Car::selectRaw('UPPER(fuel_type) as fuel_type, COUNT(*) as count')
            ->groupBy('fuel_type')
            ->pluck('count', 'fuel_type')
            ->toArray();

        $transmissionWithCounts = Car::selectRaw('UPPER(transmission) as transmission, COUNT(*) as count')
            ->groupBy('transmission')
            ->pluck('count', 'transmission')
            ->toArray();
        return view('user.filterCar', compact('Cars', 'modelNames', 'body_types', 'fuel_types', 'bodyTypesWithCounts', 'brandCounts', 'brandModels', 'owners', 'fuelTypesWithCounts', 'transmissionWithCounts'));
    }

    public function ByFuelType($fuel_types)
    {

        if ($fuel_types == 'all') {
            $Cars = Car::all();
        } else {
            $Cars = Car::where('fuel_type', $fuel_types)->paginate(6);
            $Cars->appends(['fuel_types' => $fuel_types]);
        }

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        $bodyTypesWithCounts = Car::selectRaw('UPPER(body_type) as body_type, COUNT(*) as count')
            ->groupBy('body_type')
            ->pluck('count', 'body_type')
            ->toArray();
        $brandModelsCounts = Car::selectRaw('UPPER(brand) as brand, UPPER(model) as model, COUNT(*) as count')
            ->groupBy('brand', 'model')
            ->orderBy('brand')
            ->get();

        $brandCounts = [];
        $brandModels = [];

        foreach ($brandModelsCounts as $item) {
            // Count for each brand
            if (!isset($brandCounts[$item->brand])) {
                $brandCounts[$item->brand] = $item->count;
            } else {
                $brandCounts[$item->brand] += $item->count;
            }

            // Models for each brand
            if (!isset($brandModels[$item->brand])) {
                $brandModels[$item->brand] = [];
            }
            $brandModels[$item->brand][] = ['model' => $item->model, 'count' => $item->count];
        }
        $owners = Car::selectRaw('owners_count, COUNT(*) as count')
            ->groupBy('owners_count')
            ->orderBy('owners_count')
            ->pluck('count', 'owners_count')
            ->toArray();
        $fuelTypesWithCounts = Car::selectRaw('UPPER(fuel_type) as fuel_type, COUNT(*) as count')
            ->groupBy('fuel_type')
            ->pluck('count', 'fuel_type')
            ->toArray();

        $transmissionWithCounts = Car::selectRaw('UPPER(transmission) as transmission, COUNT(*) as count')
            ->groupBy('transmission')
            ->pluck('count', 'transmission')
            ->toArray();
        return view('user.filterCar', compact('Cars', 'modelNames', 'body_types', 'fuel_types', 'bodyTypesWithCounts', 'brandCounts', 'brandModels', 'owners', 'fuelTypesWithCounts', 'transmissionWithCounts'));
    }

    public function ByPrice($priceRange)
    {

        $query = Car::query();

        switch ($priceRange) {
            case 'less-than-1-lakh':
                $query->where('sell_price', '<', 100000);
                break;
            case '1-to-3-lakh':
                $query->whereBetween('sell_price', [100000, 300000]);
                break;
            case '3-to-6-lakh':
                $query->whereBetween('sell_price', [300000, 600000]);
                break;
            case 'more-than-6-lakh':
                $query->where('sell_price', '>', 600000);
                break;
            default:
                // Handle other cases or redirect to an error page
                break;
        }

        $Cars = $query->paginate(6);
        $Cars->appends(['query' => $query]);

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        $bodyTypesWithCounts = Car::selectRaw('UPPER(body_type) as body_type, COUNT(*) as count')
            ->groupBy('body_type')
            ->pluck('count', 'body_type')
            ->toArray();
        $brandModelsCounts = Car::selectRaw('UPPER(brand) as brand, UPPER(model) as model, COUNT(*) as count')
            ->groupBy('brand', 'model')
            ->orderBy('brand')
            ->get();

        $brandCounts = [];
        $brandModels = [];

        foreach ($brandModelsCounts as $item) {
            // Count for each brand
            if (!isset($brandCounts[$item->brand])) {
                $brandCounts[$item->brand] = $item->count;
            } else {
                $brandCounts[$item->brand] += $item->count;
            }

            // Models for each brand
            if (!isset($brandModels[$item->brand])) {
                $brandModels[$item->brand] = [];
            }
            $brandModels[$item->brand][] = ['model' => $item->model, 'count' => $item->count];
        }
        $owners = Car::selectRaw('owners_count, COUNT(*) as count')
            ->groupBy('owners_count')
            ->orderBy('owners_count')
            ->pluck('count', 'owners_count')
            ->toArray();
        $fuelTypesWithCounts = Car::selectRaw('UPPER(fuel_type) as fuel_type, COUNT(*) as count')
            ->groupBy('fuel_type')
            ->pluck('count', 'fuel_type')
            ->toArray();

        $transmissionWithCounts = Car::selectRaw('UPPER(transmission) as transmission, COUNT(*) as count')
            ->groupBy('transmission')
            ->pluck('count', 'transmission')
            ->toArray();
        return view('user.filterCar', compact('Cars', 'modelNames', 'body_types', 'fuel_types', 'bodyTypesWithCounts', 'brandCounts', 'brandModels', 'owners', 'fuelTypesWithCounts', 'transmissionWithCounts'));
    }

    public function filterCars(Request $request)
    {
        // Retrieve input parameters
        $budget = $request->input('budgetRadio');
        $bodyType = $request->input('bodyTypeRadio');
        $brands = $request->input('brands');
        $models = $request->input('models');
        $owners = $request->input('owners');
        $fuelTypes = $request->input('fuelTypes');
        $transmissions = $request->input('transmissions');

        // Your existing logic to filter based on the selected options
        $query = Car::query();

        // Filter by budget
        if ($budget) {
            switch ($budget) {
                case '1L':
                    $query->where('sell_price', '<', 100000); // Assuming the 'sell_price' column is in rupees
                    break;
                case '3L':
                    $query->whereBetween('sell_price', [100000, 300000]);
                    break;
                case '6L':
                    $query->whereBetween('sell_price', [300000, 600000]);
                    break;
                case '6L+':
                    $query->where('sell_price', '>', 600000);
                    break;
                    // Add more cases if needed
            }
        }
        // Filter by body type
        if ($bodyType) {
            // Adjust this part based on your actual model and attribute
            $query->where('body_type', $bodyType);
        }

        // Filter by brands and models
        if ($brands) {
            // Adjust this part based on your actual model and attribute
            $query->whereIn('brand', $brands);
        }

        if ($models) {
            // Adjust this part based on your actual model and attribute
            $query->whereIn('model', $models);
        }

        // Filter by owners
        if ($owners) {
            // Adjust this part based on your actual model and attribute
            $query->whereIn('owners_count', $owners);
        }

        // Filter by fuel types
        if ($fuelTypes) {
            // Adjust this part based on your actual model and attribute
            $query->whereIn('fuel_type', $fuelTypes);
        }

        // Filter by transmissions
        if ($transmissions) {
            // Adjust this part based on your actual model and attribute
            $query->whereIn('transmission', $transmissions);
        }

        // Execute the query and get the results
        $Cars = $query->paginate(6);
        $Cars->appends(['query' => $query]);

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        $bodyTypesWithCounts = Car::selectRaw('UPPER(body_type) as body_type, COUNT(*) as count')
            ->groupBy('body_type')
            ->pluck('count', 'body_type')
            ->toArray();

        $brandModelsCounts = Car::selectRaw('UPPER(brand) as brand, UPPER(model) as model, COUNT(*) as count')
            ->groupBy('brand', 'model')
            ->orderBy('brand')
            ->get();

        $brandCounts = [];
        $brandModels = [];

        foreach ($brandModelsCounts as $item) {
            // Count for each brand
            if (!isset($brandCounts[$item->brand])) {
                $brandCounts[$item->brand] = $item->count;
            } else {
                $brandCounts[$item->brand] += $item->count;
            }

            // Models for each brand
            if (!isset($brandModels[$item->brand])) {
                $brandModels[$item->brand] = [];
            }
            $brandModels[$item->brand][] = ['model' => $item->model, 'count' => $item->count];
        }

        $owners = Car::selectRaw('owners_count, COUNT(*) as count')
            ->groupBy('owners_count')
            ->orderBy('owners_count')
            ->pluck('count', 'owners_count')
            ->toArray();

        $fuelTypesWithCounts = Car::selectRaw('UPPER(fuel_type) as fuel_type, COUNT(*) as count')
            ->groupBy('fuel_type')
            ->pluck('count', 'fuel_type')
            ->toArray();

        $transmissionWithCounts = Car::selectRaw('UPPER(transmission) as transmission, COUNT(*) as count')
            ->groupBy('transmission')
            ->pluck('count', 'transmission')
            ->toArray();

        return view('user.filterCar', compact('Cars', 'modelNames', 'body_types', 'fuel_types', 'bodyTypesWithCounts', 'brandCounts', 'brandModels', 'owners', 'fuelTypesWithCounts', 'transmissionWithCounts'));
    }

    public function showDetails($id)
    {
        $car = Car::find($id);

        return view('user.car.details', ['car' => $car]);
    }

    public function sellCars()
    {
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        return view('user.sell', compact('body_types', 'fuel_types', 'modelNames'));
    }

    public function sellCarsStore(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|digits:10',
            'registration' => 'required',
        ]);

        $sell = new Sell();
        $sell->name = $request->name;
        $sell->phone = $request->phone;
        $sell->email = $request->email;
        $sell->registration = $request->registration;
        $sell->model = $request->model;
        $sell->save();

        return redirect()->back()->with('success', 'Submitted successfully!');
    }

}
