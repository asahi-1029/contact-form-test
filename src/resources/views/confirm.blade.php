<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
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
                <h2 class="contact-form__title">Confirm</h2>
            </div>
        </div>
        <form class="form" action="/thanks" method="post">
            @csrf
            <div class="confirm-table">
                <table class="confirm-table__inner">
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お名前</th>
                        <td class="confirm-table__text">
                            <input type="text" name="name" value="{{ $contact['last_name'] }} {{ $contact['first_name'] }}" readonly>
                            <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                            <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">性別</th>
                        <td class="confirm-table__text">
                            @php
                                $genderLabels = [
                                    1 => '男性',
                                    2 => '女性',
                                    3 => 'その他',
                                ];
                                $gender = $contact['gender'] ?? null;
                            @endphp
                            <input type="text" name="gender" value="{{ $genderLabels[$gender] ?? '' }}" readonly>
                            <input type="hidden" name="gender" value="{{ $gender }}">
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">メールアドレス</th>
                        <td class="confirm-table__text">
                            <input type="text" name="email" value="{{ $contact['email'] }}" readonly>
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">電話番号</th>
                        <td class="confirm-table__text">
                            <input type="text" name="tel" value="{{ $contact['tel'] }}" readonly>
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">住所</th>
                        <td class="confirm-table__text">
                            <input type="text" name="address" value="{{ $contact['address'] }}" readonly>
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">建物名</th>
                        <td class="confirm-table__text">
                            <input type="text" name="building" value="{{ $contact['building'] }}" readonly>
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせの種類</th>
                        <td class="confirm-table__text">
                            @php
                                $categoryLabels = [
                                    1 => '商品のお届けについて',
                                    2 => '商品の交換について',
                                    3 => '商品トラブル',
                                    4 => 'ショップへのお問い合わせ',
                                    5 => 'その他'
                                ];
                                $categoryKind = $contact['category_id'] ?? null;
                            @endphp
                            <input type="text" name="category_id" value="{{ $categoryLabels[$categoryKind] ?? '' }} " readonly>
                            <input type="hidden" name="category_id" value="{{ $categoryKind }}">
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせ内容</th>
                        <td class="confirm-table__text">
                            <textarea name="detail" readonly>{{ $contact['detail'] }}</textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">送信</button>
                <a class="form__update" href="/">修正</a>
            </div>
        </form>
    </main>
</body>
</html>