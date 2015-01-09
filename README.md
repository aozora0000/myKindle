# myKindle

## Summary
[kindle.amazon.co.jp](kindle.amazon.co.jp)にアクセスし、購入履歴のあるkindleコンテンツのリストを取得するCLIアプリケーションです。

ゆくゆくはブクログやブックメーターとの連携・蔵書管理アプリケーションとの連携を考えています。
## Usage
```
cp .env.cp .env
vi .env


AMAZON_LOGIN_ID=test@exaple.com
AMAZON_LOGIN_PASS=exapmle

app/mykindle list:get
```

## Issuse
- 購入した事の無い洋書が混入している
- 毎回スクレイプするので重い(update処理で取得に変更するべき)

## TODO
- ソート処理の充実
- DB接続
- CSV入出力
- ブクログ・ブックメーターとの連携
