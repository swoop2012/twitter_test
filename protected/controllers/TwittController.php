<?php

class TwittController extends Controller
{
	public function actionSearch($q=null)
	{
        $criteria = new CDbCriteria();
        Yii::app()->clientScript->registerCss('view','.view{margin-bottom:25px;}');
        $criteria->compare('t.text',$q,true);
		$dataProvider=new CActiveDataProvider('Twitt',array('criteria'=>$criteria));
		$this->render('search',array(
			'dataProvider'=>$dataProvider,
            'q'=>$q
		));
	}


}
