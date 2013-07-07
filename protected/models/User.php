<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $id
 * @property string $name
 * @property string $screen_name
 * @property string $description
 * @property string $profile_image_url
 * @property string $last_parsed_twitt
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, last_parsed_twitt', 'length', 'max'=>20),
			array('name', 'length', 'max'=>70),
			array('screen_name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>255),
			array('profile_image_url', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, screen_name, description, profile_image_url, last_parsed_twitt', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'screen_name' => 'Screen Name',
			'description' => 'Description',
			'profile_image_url' => 'Profile Image Url',
			'last_parsed_twitt' => 'Last Parsed Twitt',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('screen_name',$this->screen_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('profile_image_url',$this->profile_image_url,true);
		$criteria->compare('last_parsed_twitt',$this->last_parsed_twitt,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}