<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Contact Page
    public function index()
    {
        return view('contact');
    }

    // Save Message
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|regex:/^[A-Za-z ]+$/|min:3|max:100',

            'email' => 'required|email|max:100',

            'subject' => 'required|max:150',

            'message' => 'required|min:10|max:1000',

        ], [

            'name.required' => 'Name is required.',

            'name.regex' => 'Only alphabets are allowed.',

            'email.required' => 'Email is required.',

            'subject.required' => 'Subject is required.',

            'message.required' => 'Message is required.',

        ]);

        Contact::create([

            'name' => $request->name,

            'email' => $request->email,

            'subject' => $request->subject,

            'message' => $request->message,

        ]);

        return back()->with('success','Message sent successfully. We will contact you soon.');
    }
}