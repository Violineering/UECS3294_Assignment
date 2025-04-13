<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm; 

class AdminContactFormController extends Controller
{
    public function showContactForm()
    {
        $ContactForms = ContactForm::with('user')->orderBy('created_at', 'desc')->paginate(8);
        return view('admin.contactForm', ['ContactForms' => $ContactForms]);
    }

    public function updateContactForm(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
            'status' => 'required|string',
        ]);

        $contactForm = ContactForm::findOrFail($id);
        $contactForm->reply = $request->input('reply');
        $contactForm->status = $request->input('status');
        $contactForm->save();

        return redirect()->back()->with('success', 'Reply and status updated successfully.');
    }

    
}
