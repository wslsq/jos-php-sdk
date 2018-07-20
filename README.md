# jos-php-sdk
## 安装

使用 Composer 安装:

```
composer require flofire/jos-sdk
```

## 使用
```

function jos($request){
  $c = new \Jos\JdClient();
  $c->appKey = $appKey;
  $c->appSecret = $appSecret;
  $c->serverUrl = $serverUrl;
  $c->accessToken = $token;
  $c->execute($request, $token);
}

jos(new Jos\AfsserviceAlltaskGetRequest());
```
