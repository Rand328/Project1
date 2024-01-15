<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\ContactForm;

class ContactController extends Controller
{
    public function show()
    {
        return view('contacts.show');
    }

    public function submit(Request $request)
    {
        try {
            // validate form data
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
            ]);

            //send mail to adminbox admin123
            $contactForm = ContactForm::create($validatedData);
            $id = $contactForm->id;
        
            Mail::to('admin@ehb.be')->send(new ContactFormSubmitted($validatedData, $id));
            return redirect()->back()->with('success', 'Message sent successfully!');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send message. Please try again later.');
        }
    }

    public function showContactFormReply($id)
    {
        $contactForm = ContactForm::findOrFail($id);
        return view('admin.contact_form_reply', compact('contactForm'));
    }


    public function sendReply(Request $request)
    {
        // Validation and logic to fetch form data

        $formData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
            // Additional form fields as needed
        ];

        // Send reply to the original sender
        Mail::to($formData['email'])->send(new ContactFormReply($formData['message']));

    }

}
