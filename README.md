# jos-php-sdk
## 安装

使用 Composer 安装:

```
composer require flofire/jos-sdk
```

## 使用
###编写个类
```
<?php
class JDSDK{
    static public function Request($className)
    {
      $className = 'Jos\\'.$className;
      return new $className();
    }
    static public function execute($request, $token)
    {
      $client = new \Jos\JdClient();
      $client->appKey = '';
      $client->appSecret = '';
      $client->serverUrl = 'https://api.jd.com/routerjson';
      $client->accessToken = $token;
      return $client->execute($request, $token);
    }
}
?>
```


###调用示范
```
<?php
use JDSDK;
class JDExample()
{
	public $config = [
		'appKey'	=>	'123',
		'appSecret'	=>	'12345'
	];
	
	
	//搜索订单实例
	public function orderSearch()
	{
		//Request(方法名)
		$req = JDSDK::Request('OrderSearchRequest');
		//传各种参数
		$req->setPage(1);
		$req->setPageSize(12);
		$req->setStartDate(date('Y-m-d H:i:s', strtotime('-10 day')));
		$req->setEndDate(date('Y-m-d H:i:s'));
		$result = JDSDK::execute($req, 'xxxxxxtoken');
	}

	//认证实例
	public function oauth()
	{
		$config = $this->config;
		$redirect_uri = route('JDOauthCallback');
		$state = '';
		$oauthURL = "https://oauth.jd.com/oauth/authorize?response_type=code&client_id=".$config['appKey']."&redirect_uri=".$redirect_uri."&state=".$state;
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: ' . $oauthURL);
		exit();
	}

	//认证回调用实例
	public function oauthCallback(Request $requset)
	{
		$config = $this->config;
		$code = $requset->input('code');
		$state = (int)$requset->input('state');
		$alert = '授权失败';
		$redirect_uri = route('JDOauthCallback');
		if ($code != ''){
			//curl函数自行脑补
			$result = curl([
				'method'	=>	'POST',
				'url'		=>	"https://oauth.jd.com/oauth/token?grant_type=authorization_code&client_id=".$config['appKey']."&redirect_uri=".$redirect_uri."&code={$code}&state={$state}&client_secret=".$config['appSecret']
			]);
			//返回gb2312格式要进行处理
			$json = json_decode(iconv('GB2312', 'UTF-8', $result));
			if (isset($json->code) && $json->code == 0){
				$userInfo = [
					'uid'			=>	$json->uid,
					'nickname'		=>	$json->user_nick,
					//unix
					'expire_time'	=>	time() + $json->expires_in,
					'access_token'	=>	$json->access_token,
					'refresh_token'	=>	$json->refresh_token
				];
				$alert = '授权成功';
			} else {
				//{"code":"402","error_description":"缺少redirect_uri参数"} 
			}
		}
		return "<script>alert('$alert');window.opener=null;window.open('','_self');window.close();</script>";
	}
}
?>
```

