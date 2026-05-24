<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
    <header class="header">
        <a class="header__logo" href="/">FashionablyLate</a>
    </header>

    <main>
        <div class="confirm">
            <div class="confirm__heading">
                <h2>Confirm</h2>
            </div>

            <form action="/thanks" method="POST">
                @csrf

                <table class="confirm-table">
                    <tr>
                        <th class="confirm-table__header">お名前</th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $contact['last_name'] }} {{ $contact['first_name'] }}" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th class="confirm-table__header">性別</th>
                        <td class="confirm-table__text">
                            @if ($contact['gender'] == 1)
                                <input type="text" value="男性" readonly>
                            @elseif ($contact['gender'] == 2)
                                <input type="text" value="女性" readonly>
                            @else
                                <input type="text" value="その他" readonly>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="confirm-table__header">メールアドレス</th>
                        <td class="confirm-table__text">
                            <input type="email" value="{{ $contact['email'] }}" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th class="confirm-table__header">電話番号</th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $contact['tel'] }}" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th class="confirm-table__header">住所</th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $contact['address'] }}" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th class="confirm-table__header">建物名</th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $contact['building'] }}" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th class="confirm-table__header">お問い合わせの種類</th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $category->content }}" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th class="confirm-table__header">お問い合わせ内容</th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $contact['detail'] }}" readonly>
                        </td>
                    </tr>
                </table>

                <input type="hidden" name="categry_id" value="{{ $contact['categry_id'] }}">
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                <input type="hidden" name="email" value="{{ $contact['email'] }}">
                <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
                <input type="hidden" name="address" value="{{ $contact['address'] }}">
                <input type="hidden" name="building" value="{{ $contact['building'] }}">
                <input type="hidden" name="detail" value="{{ $contact['detail'] }}">

                <div class="confirm__button">
                    <button class="confirm__button-submit" type="submit">送信</button>
                    <a class="confirm__link" href="/">修正</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
