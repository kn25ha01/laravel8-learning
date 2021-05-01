# laravel8_learning

* https://laravel.com/docs/8.x
* https://readouble.com/

## versions

```sail-8.0/app
php -v # v8.0.2
php artisan -V # v8.29.0
node -v # v15.10.0
npm -v # v7.5.3
yarn -v # v1.22.5
```

```mysql:8.0
mysql --version # v8.0.23
```

## alias

```
alias sail='bash vendor/bin/sail'
```

## sail commands

```
sail
sail up
sail up -d
sail down
sail shell
```

https://www.ritolab.com/entry/217

## Migration

https://laravel.com/docs/8.x/migrations

```create
php artisan make:migration create_users_table # テーブル作成
```

```migrate
php artisan migrate # マイグレート実行
composer dump-autoload # マイグレートに失敗した場合のみ
php artisan migrate:status # これまで実行されたマイグレート確認
```

```rollback
php artisan migrate:rollback # マイグレートの最後のバッチのロールバック
php artisan migrate:rollback --step=5 # 最後の5つのマイグレートをロールバック
php artisan migrate:reset # 全てのマイグレートをロールバック
```

```rollback & migrate
php artisan migrate:refresh # 全てのマイグレートをロールバックしてから、マイグレート
php artisan migrate:refresh --seed
php artisan migrate:refresh --step=5 # 指定した数だけロールバックしてから、マイグレート
php artisan migrate:fresh # 全てのテーブルを削除してから、マイグレート
php artisan migrate:fresh --seed
```

* freshするとBatchが初期化される

### schema:dump

肥大化するmigrationファイル、処理をschemaフォルダのdumpファイルに移しておくことで、
初期化の高速化、管理の複雑さ低減が望める。

* Laravel 8.0 からの新機能
* seederには未対応らしい

参考：https://blog.capilano-fw.com/?p=6877

```
php artisan schema:dump
php artisan schema:dump --prune
```

## Eloquent ORM (Object Relational Mapping)

データベースから取得したデータをオブジェクトとして扱える

```
php artisan make:model Models/User
```

## route

```
php artisan make:controller BlogController
```

```
routes/web.php
 -> app/Http/Contorollers/~.php
 -> resources/view/~.blade.php
```

## Bootstrap 導入

```
composer require laravel/ui
php artisan ui bootstrap
npm install
npm run dev # 初回エラーするかも？
```

* インストールが完了すると、以下のファイルに書き込まれる
  * public/css/app.css
  * public/js/app.js

## seeder/factory

```
php artisan make:seeder クラス名
php artisan make:factory クラス名
```

```
php artisan db:seed ## デフォルトのDatabaseSeederクラスのみ
php artisan db:seed --class=クラス名
```

## Request

```
php artisan make:request BlogRequest
```

[validationの日本語化](https://readouble.com/laravel/8.x/ja/validation-php.html)

```
php -r "copy('https://readouble.com/laravel/8.x/ja/install-ja-lang-files.php', 'install-ja-lang.php');"
php -f install-ja-lang.php
php -r "unlink('install-ja-lang.php');"
```