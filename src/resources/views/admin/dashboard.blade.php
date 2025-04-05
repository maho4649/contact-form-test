<h1>管理画面</h1>
<p>ようこそ、{{ Auth::user()->name }}さん！</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">ログアウト</button>
</form>
