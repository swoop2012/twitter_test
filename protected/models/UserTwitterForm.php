<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UserTwitterForm extends CFormModel
{
	public $username;
    public $result;


	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username', 'required'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'username'=>'Введите имя пользователя твиттера, или id',
		);
	}

    protected function afterValidate(){
        $params = is_numeric($this->username) ? array('id'=>$this->username):array('screen_name'=>$this->username);
        $model  = User::model()->findByAttributes($params);
        if(!empty($model)){
            $this->result = $model->attributes;
            return parent::afterValidate();
        }
        $result = $this->getUser($this->username);
        if(isset($result['errors']) && !empty($result['errors']))
            $this->addError('username','Такого пользователя не существует');
        else{
            foreach($result as $value){
            $user = new User();
            $user->attributes = array(
                'id'=>$value['id'],
                'name'=>$value['name'],
                'description'=>$value['description'],
                'profile_image_url'=>$value['profile_image_url'],
                'screen_name'=>$value['screen_name'],
            );
            $user->save(false);
            $this->result = $user->attributes;
            }
        }
        return parent::afterValidate();

    }

    private function getUser($user){
        $twitter = new TwitterAPIExchange(Yii::app()->params['twitter_settings']);
        if(is_numeric($user))
            $getfield = '?user_id='.$user;
        else
            $getfield = '?screen_name='.$user;
        $getfield.='&include_entities=false';
        return CJSON::decode($twitter->setGetfield($getfield)
            ->buildOauth('https://api.twitter.com/1.1/users/lookup.json', 'GET')
            ->performRequest());

    }


}
