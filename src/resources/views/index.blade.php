    @extends('layouts.app')

    @section('title', 'お問い合わせフォーム')

    @section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @endsection

    @section('content')
        <div class="contact">
            <div class="contact__heading">
                <h2>Contact</h2>
            </div>

            <form class="form" action="/confirm" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="form__group">
                    <div class="form__label">
                        <label>お名前<span class="form__label--required">※</span></label>
                    </div>

                    <div class="form__input">
                        <div class="form__input--name">
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例：山田">
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例：太郎">
                        </div>

                        @error('last_name')
                            <p class="form__error">{{ $message }}</p>
                        @enderror

                        @error('first_name')
                            <p class="form__error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>性別<span class="form__label--required">※</span></label>
                    </div>

                    <div class="form__input form__radio">
                        <label>
                            <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>
                            男性
                        </label>

                        <label>
                            <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                            女性
                        </label>

                        <label>
                            <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
                            その他
                        </label>

                        @error('gender')
                            <p class="form__error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>メールアドレス<span class="form__label--required">※</span></label>
                    </div>

                    <div class="form__input">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">

                        @error('email')
                            <p class="form__error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>電話番号<span class="form__label--required">※</span></label>
                    </div>

                    <div class="form__input">
                        <div class="form__input--tel">
                            <input type="text" name="tel1" value="{{ old('tel1') }}" placeholder="080">
                            <span>-</span>
                            <input type="text" name="tel2" value="{{ old('tel2') }}" placeholder="1234">
                            <span>-</span>
                            <input type="text" name="tel3" value="{{ old('tel3') }}" placeholder="5678">
                        </div>

                        @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                            <p class="form__error">
                                {{ $errors->first('tel1') ?: $errors->first('tel2') ?: $errors->first('tel3') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>住所<span class="form__label--required">※</span></label>
                    </div>

                    <div class="form__input">
                        <input type="text" name="address" value="{{ old('address') }}" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">

                        @error('address')
                            <p class="form__error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>建物名</label>
                    </div>

                    <div class="form__input">
                        <input type="text" name="building" value="{{ old('building') }}" placeholder="例：千駄ヶ谷マンション101">
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>お問い合わせの種類<span class="form__label--required">※</span></label>
                    </div>

                    <div class="form__input">
                        <select name="category_id">
                            <option value="">選択してください</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->content }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <p class="form__error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>お問い合わせ内容<span class="form__label--required">※</span></label>
                    </div>

                    <div class="form__input">
                        <textarea name="detail" placeholder="お問い合わせ内容をご記入ください">{{ old('detail') }}</textarea>

                        @error('detail')
                            <p class="form__error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>どこで知りましたか？<span class="form__label--note">（複数選択可）</span><span class="form__label--required">※</span></label>
                    </div>

                <div class="form__input">
                    <div class="form__checkbox">
                        <label>
                            <input type="checkbox" name="how_found[]" value="自社サイト" {{ is_array(old('how_found')) && in_array('自社サイト', old('how_found')) ? 'checked' : '' }}>
                            自社サイト
                        </label>

                        <label>
                            <input type="checkbox" name="how_found[]" value="検索エンジン" {{ is_array(old('how_found')) && in_array('検索エンジン', old('how_found')) ? 'checked' : '' }}>
                            検索エンジン
                        </label>

                        <label>
                            <input type="checkbox" name="how_found[]" value="SNS" {{ is_array(old('how_found')) && in_array('SNS', old('how_found')) ? 'checked' : '' }}>
                            SNS
                        </label>

                        <label>
                            <input type="checkbox" name="how_found[]" value="テレビ・新聞" {{ is_array(old('how_found')) && in_array('テレビ・新聞', old('how_found')) ? 'checked' : '' }}>
                            テレビ・新聞
                        </label>

                        <label>
                            <input type="checkbox" name="how_found[]" value="友人・知人" {{ is_array(old('how_found')) && in_array('友人・知人', old('how_found')) ? 'checked' : '' }}>
                            友人・知人
                        </label>
                    </div>

                        @error('how_found')
                            <p class="form__error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__label">
                        <label>画像アップロード</label>
                    </div>

                        <div class="form__input">
                            <p class="form__note">
                                お問い合わせ内容に画像添付が必要な場合は、下記よりアップロードしてください。
                            </p>

                <div class="form__file-area">
                        <label class="form__file-label" for="image_path">
                            ファイルをアップロード
                        </label>

                        <select id="image_path" class="form__file-select" name="image_path">
                            <option value=""></option>
                            <option value="contact_images/card.jpg" {{ old('image_path') == 'contact_images/card.jpg' ? 'selected' : '' }}>card.jpg</option>
                            <option value="contact_images/card1.jpg" {{ old('image_path') == 'contact_images/card1.jpg' ? 'selected' : '' }}>card1.jpg</option>
                            <option value="contact_images/card2.jpg" {{ old('image_path') == 'contact_images/card2.jpg' ? 'selected' : '' }}>card2.jpg</option>
                            <option value="contact_images/card3.jpg" {{ old('image_path') == 'contact_images/card3.jpg' ? 'selected' : '' }}>card3.jpg</option>
                            <option value="contact_images/card4.jpg" {{ old('image_path') == 'contact_images/card4.jpg' ? 'selected' : '' }}>card4.jpg</option>
                            <option value="contact_images/card5.jpg" {{ old('image_path') == 'contact_images/card5.jpg' ? 'selected' : '' }}>card5.jpg</option>
                            <option value="contact_images/card6.jpg" {{ old('image_path') == 'contact_images/card6.jpg' ? 'selected' : '' }}>card6.jpg</option>
                            <option value="contact_images/card7.jpg" {{ old('image_path') == 'contact_images/card7.jpg' ? 'selected' : '' }}>card7.jpg</option>
                            <option value="contact_images/card8.jpg" {{ old('image_path') == 'contact_images/card8.jpg' ? 'selected' : '' }}>card8.jpg</option>
                            <option value="contact_images/card9.jpg" {{ old('image_path') == 'contact_images/card9.jpg' ? 'selected' : '' }}>card9.jpg</option>
                        </select>
                </div>
            </div>
        </div>

                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    @endsection      