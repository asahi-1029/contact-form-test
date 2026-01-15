<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>
<body>
<header class="header">
    <div class="header__inner">
        <h1 class="header__title">FashionablyLate</h1>
        <a href="/register" class="header__button">register</a>
    </div>
</header>


<main class="main">
    <h2 class="main__title">Login</h2>
    <div class="register">
        <form class="register__form" action="/login" method="post">
            @csrf
            <div class="form__group">
                <label class="form__label">メールアドレス</label>
                <input type="text" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <label class="form__label">パスワード</label>
                <input type="password" name="password" placeholder="例：coachtech1106">
                <div class="form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit">ログイン</button>
            </div>
        </form>
    </div>
</main>
    
</body>
</html>