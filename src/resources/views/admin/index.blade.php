<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問い合わせ一覧</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <style>
        .hidden{
            display:none;
        }

        body {
            padding: 2rem;
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #f9f9f9;
        }

        h2 {
            margin-bottom: 2rem;
            font-weight: bold;
        }

        form input,
        form select {
            margin-right: 8px;
            margin-bottom: 8px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            margin-right: 8px;
            
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .auth-buttons {
            text-align: right;
            margin-bottom: 16px;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 6px;
        }

        .btn-info {
            background-color: #0dcaf0;
            border: none;
            color: #fff;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: #fff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: #fff;
        }

        .btn-success {
            background-color: #198754;
            border: none;
            color: #fff;
        }

        .modal-content {
            border-radius: 12px;
        }

        /* 新たに追加したスタイル */
        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        .form-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

        .pagination-container {
            display: flex;
            align-items: center;
        }

        .btn-large {
        padding: 15px 25px; /* ボタンのサイズ */
        font-size: 18px; /* フォントサイズ */
        width: 150px; /* 幅を揃える */
    }
    </style>
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
        <div class="form-group">
            <div>
                <input type="text" name="name" placeholder="名前" value="{{ request('name') }}">
                <input type="email" name="email" placeholder="メールアドレス" value="{{ request('email') }}">
                <select name="gender">
                    <option value="">性別</option>
                    <option value="男性" {{ request('gender') == 'male' ? 'selected' : '' }}>男性</option>
                    <option value="女性" {{ request('gender') == 'female' ? 'selected' : '' }}>女性</option>
                    <option value="その他" {{ request('gender') == 'other' ? 'selected' : '' }}>その他</option>
                </select>
                <select name="type_label">
                    <option value="">お問い合わせ種類を選択</option>
                    <option value="product_delivery" {{ request('type_label') == 'product_delivery' ? 'selected' : '' }}>商品のお届けについて</option>
                    <option value="product_exchange" {{ request('type_label') == 'product_exchange' ? 'selected' : '' }}>商品の交換について</option>
                    <option value="product_issue" {{ request('type_label') == 'product_issue' ? 'selected' : '' }}>商品トラブル</option>
                    <option value="shop_inquiry" {{ request('type_label') == 'shop_inquiry' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                    <option value="other" {{ request('type_label') == 'other' ? 'selected' : '' }}>その他</option>
                </select>
                <input type="date" name="date" value="{{ request('date') }}">
            </div>
            <div class="pagination-container">
                <button type="submit" class="btn btn-primary btn-large">検索</button>
                <a href="{{ route('admin.index') }}"><button type="button" class="btn btn-secondary btn-large">リセット</button></a>
                <ul class="pagination ms-3">
                    <!-- 前のページのリンク -->
                    @if ($contacts->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">前へ</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $contacts->previousPageUrl() }}">前へ</a></li>
                    @endif

                    <!-- 数字ページのリンク -->
                    @foreach ($contacts->getUrlRange(1, $contacts->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $contacts->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <!-- 次のページのリンク -->
                    @if ($contacts->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $contacts->nextPageUrl() }}">次へ</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">次へ</span></li>
                    @endif
                </ul>
            </div>
        </div>
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
                <td>{{ $contact->type}}</td>
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
        <div class="modal-dialog modal-lg">
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
                    <p><strong>電話番号:</strong> {{ $contact->tel }}</p>
                    <p><strong>住所:</strong> {{ $contact->address }}</p>
                    <p><strong>建物名:</strong> {{ $contact->building }}</p>
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
