<?php

namespace Addons\Jssdk\Model;

use Home\Model\WeixinModel;

/**
 * Jssdk的微信模型
 */
class WeixinAddonModel extends WeixinModel {
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'Jssdk' ); // 获取后台插件的配置参数

		// 其中token和openid这两个参数一定要传，否则程序不知道是哪个微信用户进入了系统
		$param ['token'] = get_token ();
		$param ['openid'] = get_openid ();

		$url = addons_url ( 'Jssdk://Jssdk/index', $param );

		// 组装微信需要的图文数据，格式是固定的
		$articles [0] = array (
			'Title' => 'UCToo微信JSSDK演示案例',
			'Description' => '微信开放平台JSSDK演示案例合辑',
			'PicUrl' => SITE_URL . '/Addons/Jssdk/View/default/Public/images/logo.jpg',
			'Url' => $url
		);
		$this->replyNews ( $articles );
	}
	
	// 关注公众号事件
	public function subscribe() {
		return true;
	}
	
	// 取消关注公众号事件
	public function unsubscribe() {
		return true;
	}
	
	// 扫描带参数二维码事件
	public function scan() {
		return true;
	}
	
	// 上报地理位置事件
	public function location() {
		return true;
	}
	
	// 自定义菜单事件
	public function click($data) {
		\Think\Log::record('jssdkarray:'.$data.'custommenu de click:'.arrayToXml($data) );
	}

	// 自定义菜单连接事件
	public function view($data) {
		\Think\Log::record('jssdkviewarray:'.$data.'custommenu de click:'.arrayToXml($data) );
		redirect ( $data ['EventKey'] );
	}
}
        	