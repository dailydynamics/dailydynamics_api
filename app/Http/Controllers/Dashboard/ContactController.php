<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('dashboard.contacts');
    }
    public function list()
    {
        return ContactResource::collection(Contact::all());
    }
    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required',
            'phone' => 'bail|required',
            'email' => 'bail|required',
            'subject' => 'bail|required',
            'message' => 'bail|required',
        ]);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        return response(new ContactResource($contact), 201);
    }
}
