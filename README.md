# アプリケーション名
お問い合わせフォーム

## 環境構築

## Dockerビルド
- git clone git@github.com:asahi-1029/contact-form-test.git
- docker-compose up -d --build

## Laravel環境構築
- docker-compose exec php bash
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate
- php artisan db:seed

## 開発環境
- お問い合わせフォーム入力画面 : http://localhost/
- お問い合わせ確認画面 : http://localhost/confirm
- サンクス画面 : http://localhost/thanks
- 管理画面 : http://localhost/admin
- 検索 : http://localhost/search
- 検索リセット : http://localhost/reset
- お問い合わせフォーム削除 : http://localhost/delete
- ユーザー登録画面 : http://localhost/register
- ログイン : http://localhost/login
- ログアウト : http://localhost/logout

## 使用技術（実行環境）
- PHP 8.2.11
- Laravel 8.83.8
- jquery 3.7.1.min.js
- MySQL 8.0.26
- nginx 1.21.1

## ER図
<img width="904" height="1214" alt="image" src="https://github.com/user-attachments/assets/d53292fc-0954-4d9d-9bc7-9b499bfa9719" />


