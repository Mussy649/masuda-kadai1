## アプリケーション名

基礎学習ターム 確認テスト\_お問い合わせフォーム

## 概要

お問い合わせフォームアプリです。
一般ユーザーはお問い合わせ内容を入力・確認・送信できます。
管理者はログイン後、管理画面でお問い合わせ内容の一覧確認、検索、詳細表示、削除、CSVエクスポートを行えます。

## 実装機能

- お問い合わせ入力機能
- 入力内容確認機能
- お問い合わせ内容保存機能
- FormRequestを使用したバリデーション機能
- サンクスページ表示機能
- 管理画面表示機能
- お問い合わせ検索機能
  - 名前検索
  - メールアドレス検索
  - 性別検索
  - お問い合わせ種類検索
  - 日付検索
- お問い合わせ詳細表示機能（モーダル）
- お問い合わせ削除機能
- CSVエクスポート機能
- ユーザー登録機能
- ログイン機能
- ログアウト機能
- 認証ユーザーのみ管理画面へアクセス可能

## 環境構築

### 1. リポジトリからダウンロード

```bash
git clone git@github.com:Mussy649/masuda-kadai1.git
```

### 2. 「.env.example」をコピーして「.env」を作成し、DBの設定を変更

```bash
cp .env.example .env
```

`.env` ファイル内の該当箇所を以下のように変更します。

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

### 3. Dockerコンテナを構築・起動

```bash
docker-compose up -d --build
```

### 4. phpコンテナにログインしてComposer依存パッケージをインストール

```bash
docker-compose exec php bash
composer install
```

### 5. アプリケーションキーを作成

```bash
php artisan key:generate
```

### 6. DBのテーブルを作成

```bash
php artisan migrate
```

### 7. DBのテーブルに初期データを投入

```bash
php artisan db:seed
```

※ `php artisan db:seed` で categories の初期データが入らない場合は、以下を実行してください。

```bash
php artisan db:seed --class=CategoriesTableSeeder
```

### 8. キャッシュをクリア

```bash
php artisan optimize:clear
```

### 9. 権限エラーが発生した場合

`The stream or file could not be opened` エラーが発生した場合は、`src` ディレクトリ内の `storage` ディレクトリに権限を設定します。

```bash
chmod -R 777 storage
```

## 使用技術（実行環境）

- PHP 8.1
- Laravel 8.x
- Laravel Fortify
- MySQL
- nginx
- Docker / Docker Compose

## URL

- お問い合わせフォーム：http://localhost/
- ユーザー登録：http://localhost/register
- ログイン：http://localhost/login
- 管理画面：http://localhost/admin

※ 管理画面はログイン後のみアクセス可能です。  
初回利用時は `/register` からユーザー登録を行い、その後 `/admin` にアクセスしてください。

## ユースケース図

![ユースケース図](usecase.drawio.png)

## ER図

![ER図](ER.drawio.png)

## 補足

本アプリでは、課題のテーブル仕様書に合わせて、contacts テーブルのお問い合わせ種類カラム名を `categry_id` としています。  
そのため、ER図・Model・Controller・Blade内でも `categry_id` を使用しています。
