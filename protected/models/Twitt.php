<?php

/**
 * This is the model class for table "{{twitt}}".
 *
 * The followings are the available columns in table '{{twitt}}':
 * @property string $id
 * @property string $created_at
 * @property string $text
 * @property string $search_text
 * @property string $user_id
 * @property string $retweet_count
 * @property string $favorite_count
 */
class Twitt extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Twitt the static model class
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
		return '{{twitt}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, user_id', 'required'),
			array('id, user_id', 'length', 'max'=>20),
			array('text,search_text', 'length', 'max'=>256),
			array('retweet_count, favorite_count', 'length', 'max'=>10),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, created_at, text, user_id, retweet_count, favorite_count', 'safe', 'on'=>'search'),
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
            'user'=>array(self::BELONGS_TO,'User','user_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'created_at' => 'Дата создания',
			'text' => 'Текст',
			'user_id' => 'Пользоваетль',
			'retweet_count' => 'Кол-во ретвиттов',
			'favorite_count' => 'Кол-во лайков',
		);
	}


}