<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問い合わせ詳細</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h2>問い合わせ詳細</h2>
    
<p><strong>名前:</strong> {{ $contact->name }}</p>
<p><strong>性別:</strong> {{ $contact->gender }}</p>
<p><strong>メールアドレス:</strong> {{ $contact->email }}</p>
<p><strong>お問い合わせ種類:</strong> {{ $contact->type }}</p>
<p><strong>内容:</strong> {{ $contact->content }}</p>



    <table border="1">
        <tr>
            <th>名前</th>
            <td>{{ $contact->name }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>{{ $contact->gender }}</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $contact->email }}</td>
        </tr>
        <tr>
            <th>問い合わせの種類</th>
            <td>{{ $contact->type }}</td>
        </tr>
        <tr>
            <th>詳細</th>
            <td>{{ $contact->confirm }}</td>
        </tr>
    </table>
    <br>
    <a href="{{ route('admin.index') }}">戻る</a>
</body>
</html>
