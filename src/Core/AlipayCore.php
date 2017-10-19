<?php namespace Hht\AliPay\Core;

class AlipayCore 
{
	/**
	 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
	 * @param array $param 需要拼接的数组
	 * @return string 拼接完成以后的字符串
	 */
	public static function createLinkstring($param) {
        $arg  = "";
		
		foreach ($param as $key => $val)
		{
			$arg .= $key . "=" . $val . "&";
		}

		//去掉最后一个&字符
		$arg = substr($arg, 0, count($arg) - 2);

		//如果存在转义字符，那么去掉转义
		if (get_magic_quotes_gpc())
			$arg = stripslashes($arg);

		return $arg;
    }

	/**
	 * 除去数组中的空值和签名参数
	 * @param array $param 签名参数组
	 * @return string 去掉空值与签名参数后的新签名参数组
	 */
	public static function paramFilter($param) {
		$param_filter = [];
		
		foreach ($param as $key => $val)
		{
			if ($key == "sign")
				continue;

			if ($key == "sign_type")
				continue;

			if ($val == "")
				continue;

			$param_filter[$key] = $val;
		}

		return $param_filter;
    }

	/**
	 * 对数组排序
	 * @param array $param 排序前的数组
	 * @return string 排序后的数组
	 */
	public static function argSort($param) {
		ksort($param);
		reset($param);

		return $param;
	}
}
