<?php

/**
 * ShopnameUrlRule
 *
 */
class ShopnameUrlRule extends CBaseUrlRule {

	// custom url rules:
	// http://www.yiiframework.com/doc/guide/1.1/ru/topics.url
	// http://habrahabr.ru/post/139689/
	// http://www.yiiframework.com/wiki/294/seo-conform-multilingual-urls-language-selector-widget-i18n/
	// http://appossum.com/appsite/techdetail/yii-urls2
	// http://www.larryullman.com/2013/02/18/understanding-routes-in-the-yii-framework/
	// http://rmcreative.ru/blog/post/svoi-klassy-dlja-pravil-routera-yii
	
	
	public function createUrl($manager, $route, $params, $ampersand)
	{
		if ($route === 'order/create') {
			if (isset($params['shopname'])) {

				// check in database for shop name
				if (User::model()->isShopExist($params['shopname'])) {

					return $params['shopname'] . '/' .  $route;
				} else {

					// TODO: since createUrl is called in our system,
					// so error should be logged
					// to notify about unknown shopname
					//('Unknown shopname: ' . $params['shopname']);

					// If shopname is unknown, then skip the shopname in URL,
					// but return 'order/create' action
					// to handle the wrong shopname in action:
					// 
					return $route;
				}
			}
		} elseif ($route === 'shop/order/create') {
			if (isset($params['shopname'])) {

				// check in database for shop name
				if (User::model()->isShopExist($params['shopname'])) {

					return $params['shopname'] . '/order/create';
				} else {

					// TODO: since createUrl is called in our system,
					// so error should be logged
					// to notify about unknown shopname
					//('Unknown shopname: ' . $params['shopname']);

					// If shopname is unknown, then skip the shopname in URL,
					// but return 'order/create' action
					// to handle the wrong shopname in action:
					// 
					return $route;
				}
			}
			
		}
		
		// do not apply this URL rule
		return false;
	}

	public function parseUrl($manager, $request, $pathInfo, $rawPathInfo)
	{
		if (preg_match('%^([\w\d\-]+)/order/create$%', $pathInfo, $matches)) {

			// check $matches[1] for shop name
			$shopName = $matches[1];

			if (User::model()->isShopExist($shopName)) {

				$_GET['shopname'] = $shopName;
				return 'order/create';
			}
		}

		// do not apply this URL rule
		return false;
	}

}
