<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    //お問い合わせフォーム入力画面
    public function index()
    {
        return view('index');
    }

    //お問い合わせフォーム入力画面で確認画面ボタンを押したときのアクション
    public function confirm(ContactRequest $request)
    {
        $request->merge(['tel' => $request->tel1 . $request->tel2 . $request->tel3]);
        $request->merge(['name' => $request->last_name . $request->first_name]);
        
        $contact = $request->only([
        'last_name','first_name','name','gender','email',
        'tel','tel1','tel2','tel3','address','building','category_id','detail'
        ]);
        //すべての入力データをセッションに保存
        $request->session()->put('contact', $contact);
        return view('confirm',compact('contact'));
    }

    public function store(Request $request)
    {
       // セッションから確認画面のデータを取得
        $contact = $request->session()->get('contact');

        // DBに保存するデータだけ取り出す
        $saveData = [
            'last_name'   => $contact['last_name'],
            'first_name'  => $contact['first_name'],
            'gender'      => $contact['gender'],
            'email'       => $contact['email'],
            'tel'         => $contact['tel'],   
            'address'     => $contact['address'],
            'building'    => $contact['building'],
            'category_id' => $contact['category_id'],
            'detail'      => $contact['detail'],
        ];
        Contact::create($saveData);
        $request->session()->forget('contact');
        return view('thanks');
    }
}
