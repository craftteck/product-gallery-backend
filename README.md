# Pruduct Gallary Backend

作成したプロダクト（サービス）を展示できるサービス「Product Gallary」のAPI。  

面白いアイデアでサービスを作ったはよいものの、ユーザーを獲得することが難しく、人目に触れずにクローズしてゆくサービスは多い。  
特に個人開発者においては、プレスリリースを出す費用がなかったり、そもそもサービスの完成度が高くなくて公開しにくいケースも多い。  
そういったサービス開発者のため、以下の機能を備えたサービスを開発したい。

* 気軽に安く、多くの人にサービスを公開できる
* 閲覧者からサービスについてのフィードバックをもらえる
* 資金力や開発力のある閲覧者にサービスを譲渡できる

## インストール

1. リポジトリのクローン
```
git clone https://github.com/craftteck/product-gallery-backend.git
```

2. プロジェクトに移動

```
cd product-gallery-backend
```

3. .envファイルの作成

```
cp .env.example .env
```

4. パッケージのインストール

```
composer install
```

5. APP_KEYの作成

```
php artisan key:generate
```

6. Dockerコンテナ起動

```
./vendor/bin/sail up -d
```

7. 動作確認

```
sail composer check
```

> [!NOTE]
> 以下が実行される
> - phpstan analyse
> - php-cs-fixer fix --dry-run
> - phpunit

## 技術スタック

* 言語：PHP 8.3
* フレームワーク：Laravel 11.0
* DB：PostgreSQL 15
* インフラ：未定
* アーキテクチャ：クリーンアーキテクチャ、DDD、REST API

## アーキテクチャ

クリーンアーキテクチャとドメイン駆動設計（DDD）の考えを採用する。
内から外への依存は許容しない。

![クリーンアーキテクチャ](https://github.com/user-attachments/assets/b84eb8a3-f902-47ca-aad5-1a7d90233de2)

### Controller

* LaravelのControllerを利用する
* 外部入力の受け取り、Usecaseへの処理移譲、出力の生成を実施する
* 命名規則
  * 例：`CreateUserController.php`
  * 操作内容ごとにプレフィックスを付与する
    * 新規作成 - Create
    * 詳細取得 - Detail
    * 更新 - Update
    * 削除 - Delete
    * 一覧取得 - Search
* ディレクトリ
  * `app/Http/Controllers/`以下に配置する
  * 対象リソースごとにディレクトリを作成する（例：`app/Http/Controllers/User/CreateUserController.php`）

### Request

* LaravelのFormRequestを利用する
* ここでは主に書式チェックのみを実施し、ビジネスルールに関するバリデーションは別途ドメインエンティティやドメインサービスで実施する
* 命名規則
  * 例：CreateUserRequest.php
  * 操作内容ごとにプレフィックスを付与する（Create、Update...）
* ディレクトリ
  * `app/Http/Requests/`以下に配置する
  * 対象リソースごとにディレクトリを作成する（例：`app/Http/Requests/User/CreateUserRequest.php`）
 
### Model

* LaravelのEloquent Modelを利用する
* ModelはDBに関連する処理（リレーションなど）の記載にとどめ、ドメインルールやロジックは後述するDomain層のクラスに記載する
* 命名規則
  * 例：User.php
* ディレクトリ
  * `app/Http/Models/`以下に配置する

### Usecase層

##### Usecase

* 一連の処理（ユースケース）の流れを記載する
* 必要に応じて、ドメインエンティティ、ドメインサービス、リポジトリの呼び出しを実施し、処理を組み立てる
* 命名規則
  * 例：`CreateUserUsecase.php`
  * 操作内容ごとにプレフィックスを付与する（Create、Update...）
* ディレクトリ
  * `packages/Usecase/`以下に配置する
  * 対象リソース、操作内容ごとにディレクトリを作成する（例：`packages/Usecase/User/Create/CreateUserController.php`）

##### Usecase Interface

* コントローラーとの疎結合化、責務の明確化などのため、UsecaseのInterfaceを作成する
* [WIP]

##### UsecaseInput

* コントローラーとの疎結合化、引数の増加などを防ぐため、Inputクラスを受け取る
* [WIP]

##### UsecaseOutput

* コントローラーとの疎結合化、ドメイン知識の流出を防ぐため、Outputクラスを返す
* [WIP]

##### Query Service

* 一覧取得処理など、リポジトリでは扱えない複数集約にまたがる処理を記載する
* [WIP]

### Domain層

アプリケーションのビジネスルールやビジネスロジックを記載する。

##### Entity

* ドメインオブジェクト
* 対象のエンティティに関するルールやロジックは、エンティティクラス内に記述する
* 命名規則
  * 例：User.php、Product.php
  * 対象のエンティティを表す、適切な名称をつける
* ディレクトリ
  * `packages/Domain/`以下に配置する
  * 対象のドメインごとにディレクトリを作成する（例：`packages/Domain/User/User.php`）

##### Value Object

* 値オブジェクト
* 重要な意味を持つ値は基本的に値オブジェクトを作成し、ルールを記載する
* 命名規則
  * 例：Money.php、ProductCode.php
  * 対象の値を表す、適切な名称をつける
* ディレクトリ
  * `packages/Domain/`以下に配置する
  * 特定のドメインと密接に関連する場合、そのドメインのディレクトリ内に配置する（例：`packages/Domain/Product/ProductCode.php`）
  * 特定のドメインとの関連がなく、共通のオブジェクトとなる場合、`packages/Domain/Common`以下に配置する

##### Domain Service

* 複数のエンティティにまたがるロジックや、エンティティ内に記載すると不自然になるロジックはドメインサービスに記載する
* 命名規則
  * 例：PasswordService.php
  * 対象サービスクラスの責務を表す、適切な名称をつける
* ディレクトリ
  * `packages/Domain/`以下に配置する
  * 特定のドメインと密接に関連する場合、そのドメインのディレクトリ内に配置する（例：`packages/Domain/Password/PasswordService.php`）
 
##### Repository Interface

* 依存性を逆転させるため、リポジトリのインターフェースを作成する
* 命名規則
  * 例：UserRepositoryInterface.php
  * 接頭辞として対象のドメイン、接尾辞としてInterfaceを付与する
* ディレクトリ
  * `packages/Domain/`以下に配置する
  * 対象のドメインのディレクトリ内に配置する（例：`packages/Domain/User/UserRepositoryInterface.php`）

### Infrastructure

DBやその他のインフラの処理や設定を配置する。

##### Repository

* リポジトリの実処理を記載するクラス
* リポジトリの引数・戻り値はエンティティを介すること
* リポジトリは集約単位で処理を実施すること
* 一覧取得など、複数集約にまたがるクエリを発行する必要がある場合はクエリサービスに処理を任せる
* 命名規則
  * 例：UserRepository
* ディレクトリ
  * `packages/Infrastructure/`以下に配置する
  * 対象のドメインのディレクトリ内に配置する（例：`packages/Infrastructure/User/UserRepository.php`）
 
