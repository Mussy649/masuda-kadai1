    @extends('layouts.app')

    @section('title', '確認画面')

    @section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
    @endsection

    @section('content')
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
                        <th class="confirm-table__header">どこで知りましたか？</th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $contact['how_found'] }}" readonly>
                        </td>
                    </tr>

                    @if (!empty($contact['image_path']))
                    <tr>
                        <th class="confirm-table__header">画像アップロード</th>
                        <td class="confirm-table__text">
                        <img class="confirm__image" src="{{ asset('storage/' . $contact['image_path']) }}" alt="アップロード画像">
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <th class="confirm-table__header">お問い合わせ内容</th>
                        <td class="confirm-table__text">
                            <input type="text" value="{{ $contact['detail'] }}" readonly>
                        </td>
                    </tr>


                </table>

                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                <input type="hidden" name="email" value="{{ $contact['email'] }}">
                <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                <input type="hidden" name="address" value="{{ $contact['address'] }}">
                <input type="hidden" name="building" value="{{ $contact['building'] }}">
                <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                <input type="hidden" name="how_found" value="{{ $contact['how_found'] }}">

                @if (!empty($contact['image_path']))
                    <input type="hidden" name="image_path" value="{{ $contact['image_path'] }}">
                @endif 

                <div class="confirm__button">
                    <button class="confirm__button-submit" type="submit" name="send" value="send">送信</button>
                    <button class="confirm__link" type="submit" name="back" value="back">修正</button>
                </div>
            </form>
        </div>
    @endsection