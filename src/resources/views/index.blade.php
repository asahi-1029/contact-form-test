<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__title">FashionablyLate</h1>
        </div>
    </header>

    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2 class="contact-form__title">Contact</h2>
            </div>
        </div>

        <form class="form" action="/confirm" method="post">
            @csrf

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group--content">
                    <div class="form__input--text name-input">
                        <div class="name-input__field">
                            <input type="text" name="last_name" placeholder="例:山田" 
                                value="{{ old('last_name', session('contact.last_name')) }}">
                            @error('last_name')
                            <div class="form__error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="name-input__field">
                            <input type="text" name="first_name" placeholder="例:太郎" 
                                value="{{ old('first_name', session('contact.first_name')) }}">
                            @error('first_name')
                            <div class="form__error">{{ $message }}</div>
                            @enderror
                        </div>                     
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group--content">
                    @php
                        // oldを優先し、なければsessionの値を使う
                        $gender = old('gender', session('contact.gender'));
                    @endphp
                    <div class="form__input--radio">
                        <input type="radio" id="gender1" name="gender" value="1" {{ $gender == 1 ? 'checked' : '' }}>
                        <label for="gender1">男性</label>

                        <input type="radio" id="gender2" name="gender" value="2" {{ $gender == 2 ? 'checked' : '' }}>
                        <label for="gender2">女性</label>

                        <input type="radio" id="gender3" name="gender" value="3" {{ $gender == 3 ? 'checked' : '' }}>
                        <label for="gender3">その他</label>
                    </div>
                    <div class="form__error">
                        @error('gender')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group--content">
                    <div class="form__input--text">
                        <input type="text" name="email" placeholder="例:test@example.com"
                            value="{{ old('email', session('contact.email')) }}">
                    </div>
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group--content">
                    <div class="tel__input">
                        <input type="tel" name="tel1" placeholder="080"
                            value="{{ old('tel1', session('contact.tel1')) }}">
                        <span class="hyphen">-</span>
                        <input type="tel" name="tel2" placeholder="1234"
                            value="{{ old('tel2', session('contact.tel2')) }}">
                        <span class="hyphen">-</span>
                        <input type="tel" name="tel3" placeholder="5678"
                            value="{{ old('tel3', session('contact.tel3')) }}">
                    </div>
                    <div class="form__error">
                        {{ $errors->first('tel1') ?? $errors->first('tel2') ?? $errors->first('tel3') }}
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group--content">
                    <div class="form__input--text">
                        <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3"
                            value="{{ old('address', session('contact.address')) }}">
                    </div>
                    <div class="form__error">
                        @error('address')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group--content">
                    <div class="form__input--text">
                        <input type="text" name="building" placeholder="例:千駄ヶ谷マンション1-2-3"
                            value="{{ old('building', session('contact.building')) }}">
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group--content">
                    @php
                        // oldを優先し、なければsessionの値を使う
                        $category_id = old('category_id', session('contact.category_id'));
                    @endphp

                    <div class="form__input--text select-wrapper">
                        <select name="category_id">
                            <option value="">選択してください</option>
                            <option value="1" {{ $category_id == 1 ? 'selected' : '' }}>商品のお届けについて</option>
                            <option value="2" {{ $category_id == 2 ? 'selected' : '' }}>商品の交換について</option>
                            <option value="3" {{ $category_id == 3 ? 'selected' : '' }}>商品トラブル</option>
                            <option value="4" {{ $category_id == 4 ? 'selected' : '' }}>ショップへのお問い合わせ</option>
                            <option value="5" {{ $category_id == 5 ? 'selected' : '' }}>その他</option>
                        </select>
                    </div>
                    <div class="form__error">
                        @error('category_id')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group--content">
                    <div class="form__input--textarea">
                        <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', session('contact.detail')) }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('detail')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面</button>
            </div>

        </form>
    </main>
</body>
</html>