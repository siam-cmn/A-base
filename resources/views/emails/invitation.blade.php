<p>{{ $user->last_name }} {{ $user->first_name }} 様</p>

<p>ご利用のサービスにアカウントが作成されました。</p>
<p>以下のログイン情報を使用してログインしてください。</p>

<hr>
<p>ログインメールアドレス: {{ $user->email }}</p>
<p>初期パスワード: <strong>{{ $plainPassword }}</strong></p>
<hr>

<p>ログイン後、必ずパスワードの変更をお願いいたします。</p>
<a href="{{ url('/login') }}">ログイン画面へ</a>
