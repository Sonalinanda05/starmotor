<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Car;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        $locations = Car::select(DB::raw('UPPER(location) as location'))->distinct()->pluck('location')->toArray();

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $banners = Banner::latest()->get();
        $recentCars = Car::latest()->limit(7)->get();
        $reviews=Review::latest()->limit(5)->get();
        $topRatedCars = Car::withAvg('reviews', 'rating');
        return view('welcome', compact('banners', 'modelNames', 'locations', 'recentCars', 'fuel_types', 'body_types','reviews','topRatedCars'));
    }

    public function viewCars()
    {
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        $locations = Car::select(DB::raw('UPPER(location) as location'))->distinct()->pluck('location')->toArray();

        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $Cars = Car::paginate(6);
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

        return view('user.allCars', compact('Cars', 'body_types', 'fuel_types', 'locations', 'modelNames', 'bodyTypesWithCounts', 'brandCounts', 'brandModels', 'owners', 'fuelTypesWithCounts', 'transmissionWithCounts'));
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
                    echo "no results found";
                    break;
            }
    
            $sortedCars = $carsQuery->paginate(6);
    
            $sortedCars->appends(['sort_by' => $sortBy]);
        $locations = Car::select(DB::raw('UPPER(location) as location'))->distinct()->pluck('location')->toArray();
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
        return view('user.carSort', compact('sortedCars', 'locations', 'bodyTypesWithCounts', 'brandCounts', 'brandModels', 'owners','fuelTypesWithCounts','transmissionWithCounts','modelNames','body_types','fuel_types','sortBy'));
    }


    public function viewCarsDetails($id)
    {
        $car=Car::find($id);
        $locations = Car::select(DB::raw('UPPER(location) as location'))->distinct()->pluck('location')->toArray();
        $modelNames = Car::select(DB::raw('UPPER(model) as model'))->distinct()->pluck('model')->toArray();
        $body_types = Car::select(DB::raw('UPPER(body_type) as body_type'))->distinct()->pluck('body_type')->toArray();
        $fuel_types = Car::select(DB::raw('UPPER(fuel_type) as fuel_type'))->distinct()->pluck('fuel_type')->toArray();
        $averageRating = $car->reviews->avg('rating');
        return view('user.carDetails',compact('car','modelNames','body_types','fuel_types','locations','averageRating'));
    }
}
