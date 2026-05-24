<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'categry_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'detail',
        ]);

        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        $category = Category::find($request->categry_id);

        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        Contact::create($request->only([
            'categry_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',
        ]));

        return redirect('/thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}