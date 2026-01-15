<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/manage.css') }}">
</head>
<body>

<header class="header">
    <div class="header__inner">
        <h1 class="header__title">FashionablyLate</h1>
        <form action="/logout" method="post">
            @csrf
            <button class="header-button">logout</button>
        </form>
    </div>
</header>

<main class="main">
    <h2 class="main__title">Admin</h2>

    {{-- 検索フォーム --}}
    <form class="search-form" method="get" action="/search">
        <div class="search-form__row">
            {{-- 名前・メール --}}
            <input
                type="text"
                name="keyword"
                class="search-form__input"
                placeholder="名前やメールアドレスを入力してください"
                value="{{ request('keyword') }}"
            >

            {{-- 性別 --}}
            <select name="gender" class="search-form__select search-form__item--gender">
                <option value="">性別</option>
                <option value="0" @selected(request('gender')==='1')>全て</option>
                <option value="1" @selected(request('gender')==='1')>男性</option>
                <option value="2" @selected(request('gender')==='2')>女性</option>
                <option value="3" @selected(request('gender')==='3')>その他</option>
            </select>

            {{-- お問い合わせ種類 --}}
            <select name="category_id" class="search-form__select search-form__item--type">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            {{-- 年/月/日（カレンダー） --}}
            <input
                type="date"
                name="created_at"
                class="search-form__date"
                value="{{ request('date') }}"
            >

            <button class="search-form__button search-form__button--search">
                検索
            </button>

            <a href="/reset"
               class="search-form__button search-form__button--reset">
                リセット
            </a>
        </div>

        <div class="admin-controls">
            {{-- エクスポート --}}
            <div class="search-form__export">
                <button type="submit" formaction="">
                    エクスポート
                </button>
            </div>

            {{-- ページネーション --}}
            <div class="pagination">
                {{ $contacts->links()}}
            </div>
        </div>
    </form>

    {{-- 一覧テーブル --}}
    <div class="admin-table">
        <table class="admin-table__inner">
            <thead>
                <tr class="admin-table__row admin-table__row--header">
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                    <tr class="admin-table__row">
                        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                        <td>
                            @if ($contact->gender === 1)
                                男性
                            @elseif ($contact->gender === 2)
                                女性
                            @else
                                その他
                            @endif
                        </td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->content }}</td>
                        <td>
                            <a href="javascript:void(0)"
                               class="admin-table__detail-button" onclick="openModal({{ json_encode($contact) }}, '{{ $contact->category->content }}')">
                                詳細
                            </a>
                            <!-- JavaScript関数 openModal() を呼ぶ。-->
                            <!-- {{ json_encode($contact) }} PHPをJavascriptのオブジェクトに変換 -->
                            <div id="contactModal" class="modal">
                                <div class="modal__content">
                                    <button class="modal__close" onclick="closeModal()">×</button>
                                    <div class="modal__body">
                                        <table class="modal-table">
                                            <tr><th>お名前</th><td id="modal-name"></td></tr>
                                            <tr><th>性別</th><td id="modal-gender"></td></tr>
                                            <tr><th>メールアドレス</th><td id="modal-email"></td></tr>
                                            <tr><th>電話番号</th><td id="modal-tel"></td></tr>
                                            <tr><th>住所</th><td id="modal-address"></td></tr>
                                            <tr><th>建物名</th><td id="modal-building"></td></tr>
                                            <tr><th>お問い合わせの種類</th><td id="modal-category"></td></tr>
                                            <tr><th>お問い合わせ内容</th><td id="modal-detail"></td></tr>
                                        </table>
                                    </div>
                                    <form action="/delete" method="POST" class="modal__footer">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="id" id="modal-id">
                                        <button type="submit" class="modal__delete-btn">削除</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">該当するデータがありません</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</main>
<script>
    function openModal(contact, categoryContent) {
    const modal = document.getElementById('contactModal');
    
    // データの流し込み
    document.getElementById('modal-id').value = contact.id;
    document.getElementById('modal-name').innerText = contact.last_name + ' ' + contact.first_name;
    document.getElementById('modal-email').innerText = contact.email;
    document.getElementById('modal-tel').innerText = contact.tel;
    document.getElementById('modal-address').innerText = contact.address;
    document.getElementById('modal-building').innerText = contact.building || '';
    document.getElementById('modal-category').innerText = categoryContent;
    document.getElementById('modal-detail').innerText = contact.detail;

    // 性別の変換
    const genders = {1: '男性', 2: '女性', 3: 'その他'};
    document.getElementById('modal-gender').innerText = genders[contact.gender];

    //モーダルを表示
    modal.style.display = 'flex';
}

//モーダルを非表示にするだけ
function closeModal() {
    document.getElementById('contactModal').style.display = 'none';
}
</script>
</body>
</html>
