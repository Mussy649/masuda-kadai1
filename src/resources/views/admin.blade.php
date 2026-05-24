<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
    <header class="header">
        <a class="header__logo" href="/">FashionablyLate</a>
    </header>

    <main>
        <div class="admin">
            <div class="admin__heading">
                <h2>Admin</h2>
            </div>

            <div class="admin__logout">
                <form action="/logout" method="POST">
                    @csrf
                    <button class="admin__logout-button" type="submit">logout</button>
                </form>
            </div>

            <form class="search-form" action="/search" method="GET">
                <input class="search-form__keyword" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

                <select name="gender">
                    <option value="">性別</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>

                <select name="categry_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('categry_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>

                <input type="date" name="date" value="{{ request('date') }}">

                <button class="search-form__button" type="submit">検索</button>
            </form>

            <div class="admin__actions">
                <a class="admin__export" href="{{ url('/export') . (request()->getQueryString() ? '?' . request()->getQueryString() : '') }}">
                    エクスポート
                </a>

                <a class="admin__reset" href="/admin">リセット</a>
            </div>

            <table class="admin-table">
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th>お問い合わせ内容</th>
                    <th>詳細</th>
                    <th>削除</th>
                </tr>

                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>

                        <td>
                            @if ($contact->gender == 1)
                                男性
                            @elseif ($contact->gender == 2)
                                女性
                            @else
                                その他
                            @endif
                        </td>

                        <td>{{ $contact->email }}</td>

                        <td>{{ $contact->category->content }}</td>

                        <td>{{ $contact->detail }}</td>

                        <td>
                            <a class="admin-table__link" href="#modal-{{ $contact->id }}">詳細</a>
                        </td>

                        <td>
                            <form action="/delete" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $contact->id }}">
                                <button class="admin-table__button" type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            @foreach ($contacts as $contact)
                <div id="modal-{{ $contact->id }}" class="modal">
                    <div class="modal-content">
                        <h2>お問い合わせ詳細</h2>

                        <p>お名前：{{ $contact->last_name }} {{ $contact->first_name }}</p>

                        <p>
                            性別：
                            @if ($contact->gender == 1)
                                男性
                            @elseif ($contact->gender == 2)
                                女性
                            @else
                                その他
                            @endif
                        </p>

                        <p>メールアドレス：{{ $contact->email }}</p>
                        <p>電話番号：{{ $contact->tel }}</p>
                        <p>住所：{{ $contact->address }}</p>
                        <p>建物名：{{ $contact->building }}</p>
                        <p>お問い合わせの種類：{{ $contact->category->content }}</p>
                        <p>お問い合わせ内容：{{ $contact->detail }}</p>

                        <a class="modal__close" href="#">閉じる</a>
                    </div>
                </div>
            @endforeach

            <div class="pagination">
                {{ $contacts->appends(request()->query())->links() }}
            </div>
        </div>
    </main>
</body>
</html>