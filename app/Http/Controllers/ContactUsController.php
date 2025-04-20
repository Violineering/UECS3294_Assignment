<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

class ContactUsController extends Controller
{
    public function create()
    {
        return view('user.contactUs'); 
    }


    public function store(Request $request)
    {   
        $request->validate([
            'issue' => 'required|string|max:255',
        ]);

        try {
            $contactForm = new ContactForm();
            $contactForm->user_id = auth()->id(); 
            $contactForm->issue = $request->input('issue');
            $contactForm->save();

            return redirect()->route('contact.create')->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
            return redirect()->route('contact.create')->with('error', 'There was an issue saving your message. Please try again.');
        }
    }

    public function index()
    {
        $messages = ContactForm::where('user_id', auth()->id())->paginate(10); 

        return view('user.contactUsResponses', compact('messages'));
    }

    public function delete($id)
    {
        $message = ContactForm::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Message deleted successfully.');
    }


}
