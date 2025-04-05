<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(Request $request)
    {
        // バリデーション
        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'gender' => 'required',
            'email' => 'required|email',
            'area_code' => 'required|digits_between:2,4',
            'exchange_code' => 'required|digits_between:2,4',
            'subscriber_code' => 'required|digits_between:4,4',
            'address' => 'required|string',
            'type' => 'required|string', 
            'content' => 'required|string',
        ]);

        // フルネームの作成
        $fullName = $request->last_name . ' ' . $request->first_name;

        // 電話番号の結合
        $tel = $request->area_code . '-' . $request->exchange_code . '-' . $request->subscriber_code;

        // データを配列にまとめる
        $contact = $request->all();
        $contact['name'] = $fullName;  // フルネームを追加
        $contact['tel'] = $tel;        // 電話番号を追加

        // セッションに保存
        session(['contact' => $contact]);

        $contact = $request->all();

        return view('contact.confirm', compact('contact'));

        // 確認ページにリダイレクト
        return redirect()->route('contact.confirm');
    }

    public function submitContactForm(Request $request)
    {
        // フォームから送信されたデータを取得
        $contact = $request->all(); 

        // フルネームを作成
        $fullName = $request->last_name . ' ' . $request->first_name;

        // 電話番号の結合
        $tel = $request->area_code . '-' . $request->exchange_code . '-' . $request->subscriber_code;

        // データをセッションに保存
        $contact['name'] = $fullName;
        $contact['tel'] = $tel;

        session(['contact' => $contact]); 

        // 確認ページにリダイレクト
        return redirect()->route('contact.confirm');
    }

    public function store(Request $request)
    {
        // フルネームを作成
        $fullName = $request->last_name . ' ' . $request->first_name;

        // 電話番号を結合
        $tel = $request->area_code . '-' . $request->exchange_code . '-' . $request->subscriber_code;

        // 性別が未設定の場合、デフォルト値 '男性' を設定
        $gender = $request->input('gender', '男性'); // ここでデフォルト値を設定

        // 送信するデータに name と tel を追加
        $contact = $request->only(['email', 'address', 'building', 'content']);
        $contact['name'] = $fullName;  // フルネームを追加
        $contact['tel'] = $tel;        // 電話番号を追加
        $contact['gender'] = $gender;
        

        // Contact モデルに保存
        Contact::create($contact);

        return view('thanks');
    }

    public function showContactForm()
    {
        // セッションからデータを取得してビューに渡す
        $contact = session('contact', []); // 修正：エラー回避
        return view('contact.confirm', compact('contact'));
    }
}
