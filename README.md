# wp-env

`@wordpress/env` による WordPress 開発環境を構築する

前提としては [Docker](https://www.docker.com/) が起動していること！

&nbsp;&nbsp;
&nbsp;&nbsp;

## ディレクトリ

| ディレクトリ | ディレクトリ | 内容                              |
| ------------ | ------------ | --------------------------------- |
| public       | adminer      | Adminer（データベース管理ツール） |
|              | plugins      | プラグインを格納                  |
|              | themes       | テーマファイルを格納              |
| sql          |              | SQL を格納                        |

&nbsp;&nbsp;

## 各種コマンド

`@wordpress/env` パッケージインストール

```
$ npm install
```

### サーバ起動

```
$ npx wp-env start
```

- [フロントエンド](http://localhost:3030/)
- [管理画面](http://localhost:3030/wp-admin/)
<!-- - [Adminer](http://localhost:3030/wp-content/adminer/) -->

### サーバ停止

```
$ npx wp-env stop
```

### データベースのリセット

```
$ npx wp-env clean all
```

### データベースのインポート

```
$ npx wp-env run cli wp db import sql/wordpress.sql
```

### データベースのエクスポート

```
$ npx wp-env run cli wp db export sql/wordpress.sql
```

### データーベース情報

| user | root |
| password | password |
| db | wordpress |
| host | 127.0.0.1 |
| port | docker ps |

### 最初からやり直す

```
$ npx wp-env destroy
```

&nbsp;&nbsp;

---

## 参考サイト

- [@wordpress/env](https://ja.wordpress.org/team/handbook/block-editor/reference-guides/packages/packages-env/)
- [@wordpress/env(wp-env)を使った WordPress 開発環境構築](https://codecodeweb.com/blog/699/)
