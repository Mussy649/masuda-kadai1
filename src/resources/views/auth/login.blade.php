    @extends('layouts.app')

    @section('title', 'ログイン')

    @section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @endsection

    @section('header-nav')
    <a class="header__link" href="/register">register</a>
    @endsection

    @section('content')
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

            </div>
        </div>
    
    @endsection
    