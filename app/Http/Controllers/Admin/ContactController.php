<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactReply;
use App\Models\Contact;
use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contactView()
    {
        $contacts = Contact::latest()->get();
        return view('admin.ContactUs.view', compact('contacts'));
    }

    public function contactDelete($id)
    {
        $contacts = Contact::find($id);
        $contacts->delete();
        return redirect()->back()->with('success', 'contact deleted successfully');
    }
    public function contactReply($id)
    {
        $contacts = Contact::find($id);
        return view('admin.ContactUs.reply', compact('contacts'));
    }
    public function contactSend($id, Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'reply' => 'required|string',
    ]);

    // Find the contact by ID
    $contact = Contact::findOrFail($id);

    // Save the reply to the contact record in the database
    $contact->reply = $validatedData['reply'];
    $contact->save();

    // Send email notification to the user
    Mail::to($contact->email)->send(new ContactReply($contact->reply));

    return redirect()->route('admin.contact.view')->with('success', 'Reply sent successfully');
}

public function sellView(){
    $sell= Sell::latest()->get();
    return view('admin.enquiry_for_sale.view',compact('sell'));
}

public function sellDelete($id)
{
    $sell = Sell::find($id);
    $sell->delete();
    return redirect()->back()->with('success', 'Enquiry deleted successfully');
}


}
