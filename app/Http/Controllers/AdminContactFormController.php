<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm; 

class AdminContactFormController extends Controller
{
    public function showContactForm()
    {
        $ContactForms = ContactForm::paginate(8);
        return view('admin.contactForm', ['ContactForms' => $ContactForms]);
    }

    
}
