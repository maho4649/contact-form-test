<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: "Helvetica Neue", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .register-container h2 {
            text-align: center;
            margin-bottom: 24px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1976D2;
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>新規登録</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="名前" value="{{ old('name') }}">
            <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
            <input type="password" name="password" placeholder="パスワード">
            <input type="password" name="password_confirmation" placeholder="パスワード確認">
            <button type="submit">登録</button>
        </form>

        <a class="login-link" href="{{ route('login') }}">ログインページへ</a>
    </div>
</body>
</html>
