    @extends('layouts.app')

    @section('title', '管理画面')

    @section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @endsection

    @section('header-nav')
    <form class="header__form" action="/logout" method="POST">
        @csrf
        <button class="header__button" type="submit">logout</button>
    </form>
@endsection

@section('content')
        <div class="admin">
            <div class="admin__heading">
                <h2>Admin</h2>
            </div>

            <form class="search-form" action="/search" method="GET">
                <input
                    class="search-form__keyword"
                    type="text"
                    name="keyword"
                    value="{{ request('keyword') }}"
                    placeholder="名前やメールアドレスを入力してください"
                >

                <select class="search-form__gender" name="gender">
                    <option value="">性別</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>

                <select class="search-form__category" name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>

                <input
                    class="search-form__date"
                    type="date"
                    name="date"
                    value="{{ request('date') }}"
                >

                <button class="search-form__button" type="submit">検索</button>

                <a class="search-form__reset" href="/admin">リセット</a>
            </form>

            <div class="admin__actions">
                <a
                    class="admin__export"
                    href="{{ url('/export') . (request()->getQueryString() ? '?' . request()->getQueryString() : '') }}"
                >
                    エクスポート
                </a>

                <div class="admin__pagination">
                    @if ($contacts->onFirstPage())
                        <span class="pagination__item pagination__item--disabled">&lt;</span>
                    @else
                        <a class="pagination__item" href="{{ $contacts->appends(request()->query())->previousPageUrl() }}">&lt;</a>
                    @endif

                    @for ($i = 1; $i <= $contacts->lastPage(); $i++)
                        @if ($i == $contacts->currentPage())
                            <span class="pagination__item pagination__item--active">{{ $i }}</span>
                        @else
                            <a class="pagination__item" href="{{ $contacts->appends(request()->query())->url($i) }}">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($contacts->hasMorePages())
                        <a class="pagination__item" href="{{ $contacts->appends(request()->query())->nextPageUrl() }}">&gt;</a>
                    @else
                        <span class="pagination__item pagination__item--disabled">&gt;</span>
                    @endif
                </div>
            </div>

            <table class="admin-table">
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th>お問い合わせ内容</th>
                    <th>詳細</th>
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

                        <td class="admin-table__action">
                            <a class="admin-table__link" href="#modal-{{ $contact->id }}">詳細</a>
                        </td>
                    </tr>
                @endforeach
            </table>

            @foreach ($contacts as $contact)
                <div class="modal" id="modal-{{ $contact->id }}">
                    <a class="modal__overlay" href="#"></a>

                    <div class="modal-content">
                        <a class="modal__close-button" href="#">×</a>

                        <h2>お問い合わせ詳細</h2>

                        <div class="modal-detail">
                            <div class="modal-detail__row">
                                <span class="modal-detail__label">お名前</span>
                                <span class="modal-detail__value">{{ $contact->last_name }} {{ $contact->first_name }}</span>
                            </div>

                            <div class="modal-detail__row">
                                <span class="modal-detail__label">性別</span>
                                <span class="modal-detail__value">
                                    @if ($contact->gender == 1)
                                        男性
                                    @elseif ($contact->gender == 2)
                                        女性
                                    @else
                                        その他
                                    @endif
                                </span>
                            </div>

                            <div class="modal-detail__row">
                                <span class="modal-detail__label">メールアドレス</span>
                                <span class="modal-detail__value">{{ $contact->email }}</span>
                            </div>

                            <div class="modal-detail__row">
                                <span class="modal-detail__label">電話番号</span>
                                <span class="modal-detail__value">{{ $contact->tel }}</span>
                            </div>

                            <div class="modal-detail__row">
                                <span class="modal-detail__label">住所</span>
                                <span class="modal-detail__value">{{ $contact->address }}</span>
                            </div>

                            <div class="modal-detail__row">
                                <span class="modal-detail__label">建物名</span>
                                <span class="modal-detail__value">{{ $contact->building }}</span>
                            </div>

                            <div class="modal-detail__row">
                                <span class="modal-detail__label">お問い合わせの種類</span>
                                <span class="modal-detail__value">{{ $contact->category->content }}</span>
                            </div>

                            <div class="modal-detail__row">
                                <span class="modal-detail__label">お問い合わせ内容</span>
                                <span class="modal-detail__value">{{ $contact->detail }}</span>
                            </div>
                        </div>

                        <div class="modal-detail__row">
                        <div class="modal-detail__label">どこで知りましたか？</div>
                        <div class="modal-detail__value">
                            {{ $contact->how_found }}
                        </div>
                    </div>

            @if (!empty($contact->image_path))
                        <div class="modal-detail__row">
                        <div class="modal-detail__label">画像アップロード</div>
                        <div class="modal-detail__value">
                        <img class="modal-detail__image" src="{{ asset('storage/' . $contact->image_path) }}" alt="アップロード画像">
                    </div>
                </div>
            @endif

                        <form class="modal__delete-form" action="/delete/{{ $contact->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="modal__delete-button" type="submit">削除</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
