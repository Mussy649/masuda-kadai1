    @extends('layouts.app')

    @section('title', '管理者登録')

    @section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @endsection

    @section('header-nav')
    <a class="header__link" href="/login">login</a>
    @endsection

    @section('content')
        <div class="auth">
            <div class="auth__heading">
                <h2>Register</h2>
            </div>

            <div class="auth__content">
                <form class="auth-form" action="/register" method="POST">
                    @csrf

                    <div class="auth-form__group">
                        <div class="auth-form__label">
                            <label>お名前</label>
                        </div>

                        <div class="auth-form__input">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="例：山田 太郎">
                        </div>

                        @error('name')
                            <p class="auth-form__error">{{ $message }}</p>
                        @enderror
                    </div>

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

                    <div class="auth-form__group">
                        <div class="auth-form__label">
                            <label>確認用パスワード</label>
                        </div>

                        <div class="auth-form__input">
                            <input type="password" name="password_confirmation" placeholder="例：password123">
                        </div>
                    </div>

                    <div class="auth-form__button">
                        <button class="auth-form__button-submit" type="submit">登録</button>
                    </div>
                </form>

                <div class="auth__link">
                    <a href="/login">ログインはこちら</a>
                </div>
            </div>
        </div>
    @endsection 