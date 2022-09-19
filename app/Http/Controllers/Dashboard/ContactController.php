<?php

namespace App\Http\Controllers\Dashboard;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ApiResponse;
    public function index()
    {
        return view('dashboard.contacts');
    }
    public function list()
    {
        return
            $this->success(ContactResource::collection(Contact::all()), 'Fetched Successfully', 200);
    }
    public function show(Contact $contact)
    {
        return $this->success(new ContactResource($contact), 'Fetched Successfully', 200);
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
        return  $this->success(new ContactResource($contact), 'Created Successfully', 201);
    }
}
