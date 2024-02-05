<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactCreate(Request $request)
    {
        $contacts = new Contact();
        $contacts->name = $request->input('name');
        $contacts->email = $request->input('email');
        $contacts->phone = $request->input('phone');
        return redirect()->back();
    }
}
