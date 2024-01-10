<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact_form;
use App\Models\News;
use App\Models\Faq;
use App\Models\Faq_category;
use App\Models\Latest_news;



class SupportController extends Controller
{
    public function faqCategory()
    {
        $faqCategories = Faq_category::orderBy('created_at', 'desc')->get();

        return view('site.support.faq_category', compact('faqCategories'));
    }

    public function faq($faqCategoryId)
    {
        $faqs = Faq::where('category', $faqCategoryId)->orderBy('created_at', 'asc')->get();
        $faqCategory = Faq_category::where('id', $faqCategoryId)->first()->name;

        return view('site.support.faq', compact('faqs', 'faqCategory'));
    }

    public function news()
    {
        $news = Latest_news::orderBy('created_at', 'desc')->get();

        return view('site.support.news', compact('news'));
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

    public function about()
    {
        return view('site.support.about');
    }
}
