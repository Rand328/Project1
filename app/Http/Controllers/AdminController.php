<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use App\Models\ContactForm;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;


class AdminController extends Controller
{
    public function __construct()
    {
        // Apply the 'admin' middleware to the entire controller
        $this->middleware('admin');
    }

    public function adminOnly()
    {
        return view('dashboard'); 
    }

    public function allUsers()
    {
        $users = User::all();
        return view('admin.all-users', compact('users'));
    }

   
    public function updateRole(Request $request, User $user)
    {
        $this->authorize('admin-panel');
        $this->authorize('admin');

        $validatedData = $request->validate([
            'role' => ['required', Rule::in(['user', 'admin'])],
        ]);

        // Update a user's role
        $user->update(['role' => $validatedData['role']]);

        return back()->with('success', 'User role updated successfully');
    }


    public function createUser(Request $request)
    {
        $this->authorize('admin-panel');

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user with the specified role (admin)
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'admin', // Set the role to 'admin'
        ]);

        return back()->with('success', 'User created successfully');
    }


    public function index()
    {
        $contactForms = ContactForm::where('sent', false)->get();
    
        return view('admin-panel', ['contactForms' => $contactForms]);
    }

    public function showContactForms()
    {
        $contactForms = ContactForm::where('sent', false)
            ->whereDoesntHave('replies') 
            ->get();
        
        return view('admin.contact_forms', compact('contactForms'));
    }


    public function replyToContactForm($id)
    {
        $contactForm = ContactForm::findOrFail($id);
        return view('admin.reply_to_contact_form', compact('contactForm'));
    }
       

    public function sendReplyToContactForm(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'message' => 'required|string',
        ]);
        
        // Fetch the contact form data
        $contactForm = ContactForm::findOrFail($id);
        $replyMessage = $request->input('message');
        
        try {
            // Store the reply in the replies table associated with the contact form
            $contactForm->replies()->create(['message' => $replyMessage]);
        
            // Send email to the contact form submitter
            $formData = [
                'name' => $contactForm->name,
                'email' => $contactForm->email,
                'message' => $replyMessage, // Use the reply message instead of the original message
            ];
        
            Mail::to($contactForm->email)
                ->send(new ContactFormSubmitted($formData, (int)$id, $replyMessage));
        
            // Mark the contact form as replied
            $contactForm->update(['sent' => true]);
        
            return redirect()->back()->with('success', 'Reply sent successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send reply. Please try again.');
        }
    }

}
