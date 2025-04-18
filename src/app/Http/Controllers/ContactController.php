<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function confirm(ContactRequest $request)
    {
        
        // 入力値取得
        $contact = $request->validated();

       

        // 氏名結合
        $contact['name'] = $contact['last_name'] . ' ' . $contact['first_name'];

        // 電話番号結合
        $contact['tel'] = $contact['area_code'] . '-' . $contact['exchange_code'] . '-' . $contact['subscriber_code'];

        // 性別日本語変換
        $genderMap = [
            'male' => '男性',
            'female' => '女性',
            'other' => 'その他',
        ];
        $contact['gender'] = $genderMap[$contact['gender']] ?? '未設定';

        // 種別日本語変換
        $typeMap = [
            'product_delivery' => '商品のお届けについて',
            'product_exchange' => '商品の交換について',
            'product_issue' => '商品トラブル',
            'shop_inquiry' => 'ショップへのお問い合わせ',
            'other' => 'その他',
        ];
        $contact['type_label'] = $typeMap[$contact['type']] ?? '不明'; // 表示用
        
        // セッションに保存（store で使う）
        $request->session()->put('contact', $contact);

        return view('contact.confirm', ['contact' => $contact]);
    }

    public function store(Request $request)
    {
        $contact = $request->session()->get('contact');

        // データベース保存
        Contact::create([
            'name' => $contact['name'],
            'gender' => $contact['gender'],
            'email' => $contact['email'],
            'tel' => $contact['tel'],
            'address' => $contact['address'],
            'building' => $contact['building'],
            'type' => $contact['type_label'],
            'content' => $contact['content'],
        ]);

        // セッション削除
        $request->session()->forget('contact');

        return view('thanks');
    }
}