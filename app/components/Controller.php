<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array();

	public $menuItems = array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs = array();

	public function init()
	{
		// build menu depending on user's role
		$this->menuItems = $this->_getMenuItems();

		parent::init();
	}

	public function beforeRender($view)
	{
		// enable AngularJs for all pages
		Yii::app()->clientScript->registerPackage('angularjs');

		return true;
	}

	protected function _getMenuItems()
	{
		$isGuest = Yii::app()->user->isGuest;
		
		if ($isGuest) {
			$menuItems = $this->_getGuestMenuItems();
		} else {
			
			$user = User::model()->getCurrentUser();
			if (!$user) {
				throw new Exception('Could not find user');
			}
			$userRoleId = $user->user_role_id;
			if ($userRoleId == UserRole::USER_ROLE_BUYER) {
				// buyer
				$menuItems = $this->_getBuyerMenuItems($user);
			} elseif ($userRoleId == UserRole::USER_ROLE_SELLER) {
				// seller
				$menuItems = $this->_getSellerMenuItems($user);
			} else {
				throw new Exception('Unknown user role id');
			}
		}
		return $menuItems;
	}
	
	protected function _getGuestMenuItems()
	{
		$menuItems = array(
			array(
				'class' => 'bootstrap.widgets.TbMenu',
				'items' => array(
					array('divider' => true),
					//array('label' => Yii::t('main', 'Login'), 'url' => array('/login/index')),
				),
			),
		);
		return $menuItems;
	}

	protected function _getBuyerMenuItems($user)
	{
		$menuItems = array(
			array(
				'class' => 'bootstrap.widgets.TbMenu',
				'items' => array(
					array('divider' => true),
					array('label' => Yii::t('main', 'Orders'), 'url' => array('/order/index')),
					array('label' => Yii::t('main', 'Money'), 'url' => array('/money/index')),
					array('label' => Yii::t('main', 'Messages'), 'url' => array('/message/index')),
					array('label' => Yii::t('main', 'Settings'), 'url' => array('/settings/index')),
					array('divider' => true),
					array('label' => Yii::t('main', 'Logout').' (' . $user->username . ')', 'url' => array('/login/logout')),
				),
			),
			'<p class="navbar-text pull-right">Logged in as buyer <a href="#">' . $user->username . '</a></p>',
		);
		return $menuItems;
	}

	protected function _getSellerMenuItems($user)
	{
		$menuItems = array(
			array(
				'class' => 'bootstrap.widgets.TbMenu',
				'items' => array(
					array('divider' => true),
					array('label' => Yii::t('main', 'Orders'), 'url' => array('/shop/order/index')),
					array('label' => Yii::t('main', 'Purchases'), 'url' => array('/shop/purchase/index')),
					array('label' => Yii::t('ShopModule.money', 'Money'), 'url' => array('/shop/money/index')),
					array('label' => Yii::t('main', 'Messages'), 'url' => array('/shop/message/index')),
					array('label' => Yii::t('main', 'Clients'), 'url' => array('/shop/client/index')),
					array('label' => Yii::t('main', 'Settings'), 'url' => array('/shop/settings/index')),
					array('divider' => true),
					array('label' => Yii::t('main', 'Logout').' (' . $user->username . ')', 'url' => array('/login/logout')),
				),
			),
			'<p class="navbar-text pull-right">Logged in as seller <a href="#">' . $user->username . '</a></p>',
		);
		return $menuItems;
	}
	
}
