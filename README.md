# alipay
[![Latest Stable Version](http://www.maiguoer.com/haiaouang/alipay/stable.svg)](https://packagist.org/packages/haiaouang/alipay)
[![License](http://www.maiguoer.com/haiaouang/alipay/license.svg)](https://packagist.org/packages/haiaouang/alipay)

laravel支付包手机支付包

## 安装

在你的终端运行以下命令

`composer require haiaouang/alipay`

或者在composer.json中添加

`"haiaouang/alipay": "1.0.*"`

然后在你的终端运行以下命令

`composer update`

安装依赖包 [haiaouang/support](https://github.com/haiaouang/support)

安装依赖包 [haiaouang/pusher](https://github.com/haiaouang/pusher)

在配置文件中添加 config/app.php

```php
    'providers' => [
        /**
         * 添加供应商
         */
        Hht\Payer\PayerServiceProvider::class,
        /**
         * 添加供应商
         */
        Hht\Support\ServiceProvider::class,
    ],
```

生成配置文件

`php artisan vendor:publish`

设置推送信息的参数 config/payers.php

## 调用

修改config/payrs.php对应的配置

```php
<?php

return [

    'default' => 'alipay',

    'launchers' => [

        'alipay' => [
			'driver' => 'alipay',
			
			//合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串
			'partner' => '',

			//收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
			'seller_id' => '',

			//商户的私钥,此处填写原始私钥去头去尾
			'private_key' => '',

			//支付宝的公钥
			'alipay_public_key' => '',

			//签名方式
			'sign_type' => 'RSA',

			//字符编码格式 目前支持 gbk 或 utf-8
			'input_charset' => 'utf-8',

			// 支付类型 ，无需修改
			'payment_type' => '1',

			// 产品类型，无需修改
			'service' => 'create_direct_pay_by_user',

			// 产品类型，无需修改
			'sdk_service' => 'mobile.securitypay.pay',

			// 支付超时时间
			'payment_time' => '30m',
	
        ],

    ],

];
```

## 依赖包

* haiaouang/support : https://github.com/haiaouang/support
* haiaouang/payer : https://github.com/haiaouang/payer
