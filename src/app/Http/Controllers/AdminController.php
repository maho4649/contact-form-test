<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    // 検索付きの問い合わせ一覧
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', $request->email);
        }


        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
            
        }

        if ($request->filled('type_label')) {
            $typeReverseMap = [
            'product_delivery' => '商品のお届けについて',
            'product_exchange' => '商品の交換について',
            'product_issue' => '商品トラブル',
            'shop_inquiry' => 'ショップへのお問い合わせ',
            'other' => 'その他',
    ];
       $type = $typeReverseMap[$request->type_label] ?? null;
        if ($type) {
        $query->where('type', $type);
    }
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // ページネーション＆検索条件の保持
        $contacts = $query->paginate(7)->appends($request->query());

        $genderMap = [
            'male' => '男性',
            'female' => '女性',
            'other' => 'その他',
        ];
        
       
        return view('admin.index', compact('contacts'));
    }

    
    


    public function destroy($id){
        $contact = Contact::findOrFail($id);
        $contact->delete(); // データ削除

        return redirect()->route('admin.index')->with('success', 'お問い合わせが削除されました。');
     }
    }
