# Rese（リーズ）

ある企業のグループ会社の飲食店予約サービス

## 作成した目的

外部の飲食店予約サービスは手数料の支払いが発生するため、自社で予約サービスを持ちたい。

## URL

http://xxxxxxx

## 他のリポトロジー

http://

## 機能一覧

-   会員登録
-   ログイン
-   ログアウト
-   ユーザー情報取得
-   ユーザー飲食店お気に入り一覧取得
-   ユーザー飲食店予約情報取得
-   飲食店一覧取得
-   飲食店詳細取得
-   飲食店お気に入り追加
-   飲食店お気に入り削除
-   飲食店予約情報追加
-   飲食店予約情報削除
-   エリアで検索する
-   ジャンルで検索する
-   店名で検索する

## 使用技術

-   Laravel 8.83.26(Framework, PHP 7.4)
-   jQuery(3.5.1)

## テーブル設計

- **[参照ページ](https://docs.google.com/spreadsheets/d/1PPSwFs4CRRKUTM0Z75WfnCJP4IAOYAt7k38oznpVvbc/edit#gid=1635115377)**

##　ER図

- **[参照ページ](https://docs.google.com/spreadsheets/d/1PPSwFs4CRRKUTM0Z75WfnCJP4IAOYAt7k38oznpVvbc/edit#gid=320603785)**

## 環境構築

-   ”git push xxxxx”でダウンロードした後、"php artisan serve"を実行。

## 特記事項

-   アカウントは利用者とサイト管理者、店舗管理者の３種類
-   利用者は登録画面から利用者自身が利用できるが、その他は管理画面でのみ登録できる
-   店舗管理者は管理している店舗の運用日時の設定ができる
