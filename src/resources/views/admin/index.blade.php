<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問い合わせ一覧</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h2>問い合わせ一覧</h2>
    <div class="auth-buttons" style="text-align: right; margin-bottom: 16px;">
    <a href="{{ route('login') }}">
        <button type="button" class="btn btn-primary">ログイン</button>
    </a>
    <a href="{{ route('register') }}">
        <button type="button" class="btn btn-success">新規登録</button>
    </a>
</div>

    <form action="{{ route('admin.index') }}" method="GET">
    @csrf
    <input type="text" name="name" placeholder="名前" value="{{ request('name') }}">
    <input type="email" name="email" placeholder="メールアドレス" value="{{ request('email') }}">

    <select name="gender">
        <option value="">性別</option>
        <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
        <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
        <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
    </select>

    <input type="text" name="type" placeholder="お問い合わせ種類" value="{{ request('type') }}">
    <input type="date" name="date" value="{{ request('date') }}">

    <button type="submit">検索</button>
    <a href="{{ route('admin.index') }}"><button type="button">リセット</button></a>
</form>

    <table border="1">
        <thead>
            <tr>
                <th>名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>問い合わせの種類</th>
                <th>詳細</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->gender }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->type }}</td>
                <td>
                    <!-- 詳細ボタン -->
                    <a href="{{ route('admin.show', $contact->id) }}" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#contactModal{{ $contact->id }}">詳細</a>
                </td>
                <td>
                    <!-- 削除ボタン -->
                    <form action="{{ route('admin.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- モーダル部分（複数のモーダルを作成） -->
    @foreach($contacts as $contact)
    <div class="modal fade" id="contactModal{{ $contact->id }}" tabindex="-1" aria-labelledby="contactModalLabel{{ $contact->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel{{ $contact->id }}">問い合わせ詳細</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- モーダル内に詳細情報を表示 -->
                    <p><strong>名前:</strong> {{ $contact->name }}</p>
                    <p><strong>性別:</strong> {{ $contact->gender }}</p>
                    <p><strong>メールアドレス:</strong> {{ $contact->email }}</p>
                    <p><strong>お問い合わせ種類:</strong> {{ $contact->type }}</p>
                    <p><strong>内容:</strong> {{ $contact->content }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>

