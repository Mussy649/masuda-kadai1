<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $contacts = Contact::with('category');

        if ($request->keyword) {
            $keyword = $request->keyword;

            $contacts->where(function ($query) use ($keyword) {
                $query->where('first_name', 'like', '%' . $keyword . '%')
                    ->orWhere('last_name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->gender) {
            $contacts->where('gender', $request->gender);
        }

        if ($request->categry_id) {
            $contacts->where('categry_id', $request->categry_id);
        }

        if ($request->date) {
            $contacts->whereDate('created_at', $request->date);
        }

        $contacts = $contacts->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }


    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();

        return redirect('/admin');
    }

    public function export(Request $request)
    {
        $contacts = Contact::with('category');

        if ($request->keyword) {
            $keyword = $request->keyword;

            $contacts->where(function ($query) use ($keyword) {
            $query->where('first_name', 'like', '%' . $keyword . '%')
                ->orWhere('last_name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->gender) {
            $contacts->where('gender', $request->gender);
        }

        if ($request->categry_id) {
            $contacts->where('categry_id', $request->categry_id);
        }

        if ($request->date) {
            $contacts->whereDate('created_at', $request->date);
        }

            $contacts = $contacts->get();

            $csvHeader = [
            'お名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容',
            '作成日',
            ];

            $callback = function () use ($contacts, $csvHeader) {
            $file = fopen('php://output', 'w');

            fwrite($file, "\xEF\xBB\xBF");

            fputcsv($file, $csvHeader);

        foreach ($contacts as $contact) {
        if ($contact->gender == 1) {
            $gender = '男性';
            } elseif ($contact->gender == 2) {
            $gender = '女性';
            } else {
            $gender = 'その他';
            }

        fputcsv($file, [
            $contact->last_name . ' ' . $contact->first_name,
            $gender,
            $contact->email,
            $contact->tel,
            $contact->address,
            $contact->building,
            $contact->category ? $contact->category->content : '',
            $contact->detail,
            $contact->created_at,
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename=contacts.csv',
        ]);
    }

}