<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        //
        $contacts = Contact::with('category')
        ->KeywordSearch($request->keyword)
        ->GenderSearch($request->gender)
        ->CategorySearch($request->category_id)
        ->DateSearch($request->created_at)
        ->paginate(7)
        ->withQueryString();
        $categories = Category::all();
        return view('manage', compact('contacts','categories'));
    }

    public function delete(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

    public function reset()
    {
        return redirect('/admin');
    }
}
