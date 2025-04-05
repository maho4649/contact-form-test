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

        if ($request->filled('type')) {
            $query->where('type', 'like', '%' . $request->type . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // ページネーション＆検索条件の保持
        $contacts = $query->paginate(7)->appends($request->query());

        return view('admin.index', compact('contacts'));
    }

    // 問い合わせ詳細
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $contacts = Contact::paginate(7);
        return view('admin.show', compact('contact')); // ← 別のviewにする
    }
    


    public function destroy($id){
        $contact = Contact::findOrFail($id);
        $contact->delete(); // データ削除

        return redirect()->route('admin.index')->with('success', 'お問い合わせが削除されました。');
     }
    }
