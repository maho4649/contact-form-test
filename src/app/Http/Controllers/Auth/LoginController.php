<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * ログインフォームの表示
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * ログイン処理
     */
    public function login(LoginRequest $request)
    {
        // バリデーション済みの入力を取得
        $validated = $request->validated();

        // ユーザーを取得
        $user = User::where('email', $validated['email'])->first();

       


        // ユーザーが存在し、パスワードが一致すればログイン
        if ($user && Hash::check($validated['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('admin.index');
        }

        // 認証失敗時
        return back()->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。'])->withInput();
    }

    /**
     * ログアウト処理
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
