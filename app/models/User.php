<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $phone
 * @property integer $user_role_id
 * @property string $password
 * @property string $salt
 * @property string $username
 * @property string $login_ip
 * @property string $login_attempts
 * @property string $login_time
 * @property string $validation_key
 * @property string $password_strategy
 * @property integer $requires_new_password
 * @property string $create_id
 * @property string $create_time
 * @property string $update_id
 * @property string $update_time
 * @property string $delete_id
 * @property string $delete_time
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Manager[] $managers
 * @property Order[] $orders
 * @property UserRole $userRole
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_role_id, password, username, login_ip, login_attempts, requires_new_password, status', 'required'),
			array('user_role_id, requires_new_password, status', 'numerical', 'integerOnly' => true),
			array('firstname, lastname, phone, password, salt, username, login_ip, validation_key, password_strategy', 'length', 'max'=>255),
			array('email', 'length', 'max'=>100),
			array('login_attempts, create_id, update_id, delete_id', 'length', 'max'=>10),
			array('create_time, update_time, delete_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firstname, lastname, email, phone, user_role_id, password, salt, username, login_ip, login_attempts, login_time, validation_key, password_strategy, requires_new_password, create_id, create_time, update_id, update_time, delete_id, delete_time, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'managers' => array(self::HAS_MANY, 'Manager', 'user_id'),
			'orders' => array(self::HAS_MANY, 'Order', 'user_id'),
			'userRole' => array(self::BELONGS_TO, 'UserRole', 'user_role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('', 'ID'),
			'firstname' => Yii::t('', 'Firstname'),
			'lastname' => Yii::t('', 'Lastname'),
			'email' => Yii::t('', 'Email'),
			'phone' => Yii::t('', 'Phone'),
			'user_role_id' => Yii::t('', 'User Role'),
			'password' => Yii::t('', 'Password'),
			'salt' => Yii::t('', 'Salt'),
			'username' => Yii::t('', 'Username'),
			'login_ip' => Yii::t('', 'Login Ip'),
			'login_attempts' => Yii::t('', 'Login Attempts'),
			'login_time' => Yii::t('', 'Login Time'),
			'validation_key' => Yii::t('', 'Validation Key'),
			'password_strategy' => Yii::t('', 'Password Strategy'),
			'requires_new_password' => Yii::t('', 'Requires New Password'),
			'create_id' => Yii::t('', 'Create'),
			'create_time' => Yii::t('', 'Create Time'),
			'update_id' => Yii::t('', 'Update'),
			'update_time' => Yii::t('', 'Update Time'),
			'delete_id' => Yii::t('', 'Delete'),
			'delete_time' => Yii::t('', 'Delete Time'),
			'status' => Yii::t('', 'Status'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('firstname', $this->firstname, true);
		$criteria->compare('lastname', $this->lastname, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('phone', $this->phone, true);
		$criteria->compare('user_role_id', $this->user_role_id);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('salt', $this->salt, true);
		$criteria->compare('username', $this->username, true);
		$criteria->compare('login_ip', $this->login_ip, true);
		$criteria->compare('login_attempts', $this->login_attempts, true);
		$criteria->compare('login_time', $this->login_time, true);
		$criteria->compare('validation_key', $this->validation_key, true);
		$criteria->compare('password_strategy', $this->password_strategy, true);
		$criteria->compare('requires_new_password', $this->requires_new_password);
		$criteria->compare('create_id', $this->create_id, true);
		$criteria->compare('create_time', $this->create_time, true);
		$criteria->compare('update_id', $this->update_id, true);
		$criteria->compare('update_time', $this->update_time, true);
		$criteria->compare('delete_id', $this->delete_id, true);
		$criteria->compare('delete_time', $this->delete_time, true);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	/**
	 * Returns array, each item includes a shop name
	 * @return array shop names
	 */
	public function getShopNames()
	{
		$shopNames = Yii::app()->db->createCommand()
			->select('name')
			->from('shop')
			->queryAll();
		return $shopNames;
	}

	public function isShopExist($shopName) {

		$shop_id = $this->getShopIdByName($shopName);
		return $shop_id !== null;
	}

	public function getShopIdByName($shopName) {

		$user = Yii::app()->db->createCommand()
			->select('s.id')
			->from('user u')
			->join('shop s', 'u.shop_id = s.id')
			->where('s.name = :name', array(':name' => $shopName))
			->queryRow();

		return $user !== false ? $user['id'] : null;
	}

	/**
	 * Returns the shop name for the current seller
	 * NOTE: use it if the current user is seller
	 */
	public function getCurrentSellerShopName() {

		$userId = $this->getCurrentUserId();
		$shop = Yii::app()->db->createCommand()
			->select('s.name')
			->from('user u')
			->join('shop s', 'u.shop_id = s.id')
			->where('u.id = :user_id', array(':user_id' => $userId))
			->queryRow();

		return $shop !== false ? $shop['name'] : null;
	}

	public function getCurrentUserRoleId()
	{
		$user = $this->getCurrentUser();

		if (!$user) {
			throw new Exception('Could not find user');
		}

		return $user->user_role_id;
	}

	public function isCurrentUserSeller()
	{
		$user = $this->getCurrentUser();

		if (!$user) {
			throw new Exception('Could not find user');
		}

		return (UserRole::USER_ROLE_SELLER == $user->user_role_id);
	}
	
	public function isUserSeller($userId)
	{
		$user = $this->getUser($userId);

		if (!$user) {
			throw new Exception('Could not find user');
		}

		return (UserRole::USER_ROLE_SELLER == $user->user_role_id);
	}


	public function getCurrentSellerShopId()
	{
		$user = $this->getCurrentUser();

		if (!$user) {
			throw new Exception('Could not find user');
		}

		return $user->shop_id;
	}

	public function getCurrentUserId()
	{
		return Yii::app()->user->id;
	}

	public function getUser($userId)
	{
		$user = User::model()->findByPk($userId);
		return $user;
	}

	public function getCurrentUser()
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
		return $user;
	}

	public function createSeller($data)
	{
		$seller = new User();
		$seller->username = $data->username;
		$seller->password = $data->password; // TODO crypt + salt
		$seller->email = $data->email;
		$seller->user_role_id = UserRole::USER_ROLE_SELLER;
		$seller->salt = ''; // TODO
		$seller->login_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		$seller->login_attempts = 0;
		$seller->validation_key = '';
		$seller->password_strategy = '';
		$seller->requires_new_password = 0;
		$seller->status = 0;

		$shop = new Shop();
		$shop->name = $this->slugify($data->shopname);
        $shop->base_currency_id = Currency::CURRENCY_UAH;
		if (!$shop->save()) {
			// TODO return errors from model
			return false;
		}
		$seller->shop_id = $shop->id;

		if (!$seller->save()) {
			// TODO return errors from model
			return false;
		}

		return $seller;
	}

	public function slugify($str)
	{
		// this will replace all non alphanumeric char with '-'
		$slug = preg_replace('@[\s!:;_\?=\\\+\*/%&#]+@', '-', $str);
		// convert string to lowercase
		$slug = mb_strtolower($slug);
		// trim whitespaces
		$slug = trim($slug, '-');
		return $slug;
	}

	public function createBuyer($data)
	{
		$buyer = new User();
		$buyer->username = $data->username;
		$buyer->password = $data->password; // TODO crypt + salt
		$buyer->email = $data->email;
		$buyer->user_role_id = UserRole::USER_ROLE_BUYER;
		$buyer->salt = ''; // TODO
		$buyer->login_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		$buyer->login_attempts = 0;
		$buyer->validation_key = '';
		$buyer->password_strategy = '';
		$buyer->requires_new_password = 0;
		$buyer->status = 0;

		if (!$buyer->save()) {
			// TODO return errors from model
			return false;
		}

		return $buyer;
	}
	public function getUsersForSeller($shopId)
	{
		$connection = Yii::app()->db;
		$command = $connection->createCommand();
		$fields = array(
			'user.id as userId',
			'user.firstname as userFirstname',
			'user.lastname as userLastname',
		);

		$command->selectDistinct($fields);
		$command->from('order');

		$command->join('user', 'order.user_id = user.id');

		$command->where('order.shop_id = :shop_id', array(':shop_id' => $shopId));
		
		
		$dataReader = $command->query();
		$shopUsersData = $dataReader->readAll();
		return $shopUsersData;
	}

	public function getUserIdByProductId($productId)
	{
		$connection = Yii::app()->db;
		$command = $connection->createCommand();

		$command->select('order.user_id');
		$command->from('product');
		$command->join('order', 'order.id = product.order_id');

		$command->where('product.id = :product_id',
			array(
				':product_id' => $productId,
			)
		);
		$userIdByProductId = $command->queryScalar();
		return $userIdByProductId;
	}

}