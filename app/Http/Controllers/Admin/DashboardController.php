<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Car;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $TotalUsers = User::count();
        $soldCars=Car::where('status','sold')->count();
        $carsforSale=Car::where('status','Not Sold')->count();
        $TotalCars=Car::count();
        $bookCar=Book::latest()->limit(7)->get();
        return view('admin.dashboard', compact('TotalUsers','soldCars','carsforSale','TotalCars','bookCar'));
    }
}
