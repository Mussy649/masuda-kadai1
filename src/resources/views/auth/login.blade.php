<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
    <header class="header">
        <a class="header__logo" href="/">FashionablyLate</a>
    </header>

    <main>
        <div class="auth">
            <div class="auth__heading">
                <h2>Login</h2>
            </div>

            <div class="auth__content">
                <form class="auth-form" action="/login" method="POST">
                    @csrf

                    <div class="auth-form__group">
                        <div class="auth-form__label">
                            <label>メールアドレス</label>
                        </div>

                        <div class="auth-form__input">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
                        </div>

                        @error('email')
                            <p class="auth-form__error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-form__group">
                        <div class="auth-form__label">
                            <label>パスワード</label>
                        </div>

                        <div class="auth-form__input">
                            <input type="password" name="password" placeholder="例：password123">
                        </div>

                        @error('password')
                            <p class="auth-form__error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-form__button">
                        <button class="auth-form__button-submit" type="submit">ログイン</button>
                    </div>
                </form>

                <div class="auth__link">
                    <a href="/register">会員登録はこちら</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>