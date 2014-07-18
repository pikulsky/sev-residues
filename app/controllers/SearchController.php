<?php

class SearchController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		Yii::app()->getClientScript()->registerScriptFile(
			Yii::app()->assetManager->publish(
				Yii::getPathOfAlias('application.assets.js').'/app.js'
			)
		);

		$renderOptions = array(
		);
		$this->render('index', $renderOptions);
	}
	
	public function actionSearchProducts()
	{
		$query = Yii::app()->request->getQuery('query');
		$products = array();
		if (!empty($query)) {
			$products = $this->_getProducts($query);
		}
		echo json_encode($products);
		Yii::app()->end();
	}
	
	private function _getProducts($query)
	{
		$products = array(
			array(
				'name' => 'Цемент',
				'price' => 135,
				'description' => 'Два мешека цемента по 25 кг каждый',
				'dateCreated' => '2014-06-03 12:11:09',
			),
			array(
				'name' => 'Гипсокартон',
				'price' => 15,
				'description' => 'Почти полный лист, влагостойкий',
				'dateCreated' => '2014-06-10 15:17:21',
			),
			array(
				'name' => 'Шланги',
				'price' => 75,
				'description' => 'Длина 40см, 2шт.',
				'dateCreated' => '2014-06-10 15:21:21',
			),
		);
		//$query = strtolower($query);
		$result = array();
		foreach ($products as $product) {
			if (mb_stripos($product['name'], $query) !== false ||
				(mb_stripos($product['description'], $query) !== false))
			{
				$result[] = $product;
			}
		}
		return $result;
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$error = Yii::app()->errorHandler->error;
		if ($error) {
			if(Yii::app()->request->isAjaxRequest) {
				echo $error['message'];
			} else {
				$this->render('error', $error);
			}
		}
	}

}