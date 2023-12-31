<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact_form;
use App\Models\News;
use App\Models\Faq;
use App\Models\Faq_category;



class SupportController extends Controller
{
    public function faqCategory()
    {
        $faqCategories = Faq_category::orderBy('name')->get();

        return view('site.support.faq_category', compact('faqCategories'));
    }

    public function faq($faqCategoryId)
    {
        $faqs = Faq::where('category', $faqCategoryId)->orderBy('created_at', 'desc')->get();

        return view('site.support.faq', compact('faqs'));
    }

    public function news()
    {
        return view('site.support.news');
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return view('site.support.contact');
        }

        $request->validate([
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
        ]);
    
        $contact = Contact_form::create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()
            ->route('support.contact')
            ->with('success', 'Uw contactformulier met onderwerp "' . $contact->subject . '" is verzonden');
    }

    public function userpage(Request $request)
    {
        if ($request->isMethod('get'))
        {
            return view('site.support.userpage');
        }
    }
}
