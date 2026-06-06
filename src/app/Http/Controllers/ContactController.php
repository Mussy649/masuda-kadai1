<?php

namespace App\Http\Controllers;

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
        $contact = $this->getContactData($request, true);

        $category = Category::find($request->category_id);

        return view('confirm', compact('contact', 'category'));
    }

    public function store(ContactRequest $request)
    {
        if ($request->has('back')) {
            return redirect('/')->withInput();
        }

        $contact = $this->getContactData($request);

        Contact::create($contact);

            return view('thanks');
    }
    private function getContactData($request, $forConfirm = false)
    {
        $contact = $request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'detail',
        ]);

        if ($forConfirm) {
            $contact['tel1'] = $request->tel1;
            $contact['tel2'] = $request->tel2;
            $contact['tel3'] = $request->tel3;
        }

        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;

        $contact['how_found'] = is_array($request->how_found)
            ? implode('　', $request->how_found)
            : $request->how_found;

        $contact['image_path'] = $request->image_path;

        return $contact;
    }
}
