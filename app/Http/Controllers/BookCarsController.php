<?php

namespace App\Http\Controllers;

use App\Mail\bookCarReply;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookCarsController extends Controller
{
    public function bookCarView()
    {
        $bookCar = Book::with('cars')->latest()->get();
        return view('admin.BookCar.view', compact('bookCar'));
    }

    public function bookCarDelete($id)
    {
         $bookCar = Book::find($id);
         $bookCar->delete();
        return redirect()->back()->with('success', 'contact deleted successfully');
    }
    public function bookCarReply($id)
    {
         $bookCar = Book::find($id);
        return view('admin.BookCar.reply', compact('bookCar'));
    }
    public function bookCarSend($id, Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'reply' => 'required|string',
    ]);

    // Find the contact by ID
    $bookCar = Book::findOrFail($id);

    // Save the reply to the contact record in the database
    $bookCar->reply = $validatedData['reply'];
    $bookCar->save();

    // Send email notification to the user
    Mail::to($bookCar->email)->send(new bookCarReply($bookCar->reply));

    return redirect()->route('admin.bookCar.view')->with('success', 'Reply sent successfully');
}  
}
