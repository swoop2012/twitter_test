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
	public $layout='//layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public function filters()
    {
	    return array(
		    'accessControl', // perform access control for CRUD operations
	    );
    }
    protected function writeNewModel(&$model,$attributes = NULL)
    {
	$modelName = get_class($model);
	    if(isset($_POST[$modelName]))
	{
	    if(!empty($attributes))
		$model->attributes = $attributes;
        
	    $model->attributes = $_POST[$modelName];
	    
	    if($model->save())
	    {
		$model = new $modelName;
		return true;
	    }
	 
	}
	return false;
    }
    protected function updateModel(&$model)
    {
	$modelName = get_class($model);
	if(isset($_POST[$modelName]))
	{
	    $model->attributes = $_POST[$modelName];
	    
	    if($model->save())
	    {
		return true;
	    }
	 
	}
	return false;
    }
    protected function setCloseScript(){
    Yii::app()->clientScript->registerScript('close_error','$(".btn.close").click(function(){
    $(this).parent().hide()
    });
    ',CClientScript::POS_END);
    }
    protected function setScript($selector,$url){
    Yii::app()->clientScript->registerScript('delete'.$url,'
    $("'.$selector.'").bind("click",function(e){
    if(confirm("Вы действительно хотите удалить запись?"))
    $.get("'.$this->createUrl($url).'",{id:$(this).data("id"),
	'.Yii::app()->request->csrfTokenName .':"'.Yii::app()->request->csrfToken.'"},function(data){
	window.location.reload();
	})
    e.preventDefault()
    })
    ',CClientScript::POS_END);
    }
    protected function getFilter($name,$field='Name',$condition=NULL,$params=NULL)
    {
	$criteria = new CDbCriteria;
	$criteria->select='id,'.$field;
	if(!empty($condition))
	    $criteria->addCondition($condition);
	if(!empty($params)) 
	    $criteria->params=$params;
	return CHtml::listData(
				CActiveRecord::model($name)->findAll($criteria),'id',$field
				);
    }
    protected function loadModel($modelName,$id){
	$model = CActiveRecord::model($modelName)->findByPk((int) $id);
	if($model==null)
	    throw new CHttpException(404,'The requested page does not exist.');
	return $model;
    } 
    protected function loadModelExt($modelName,$params){
	$model = CActiveRecord::model($modelName)->findByAttributes($params);
	if($model==null)
	    throw new CHttpException(404,'The requested page does not exist.');
	return $model;
    } 
    protected function loadModelExtRel($modelName,$relation,$params){
	$criteria = new CDbCriteria;
	if(!empty($params))
	foreach($params as $key=>$value)
	$criteria->compare($key,$value);
	$criteria->with =$relation;
	$model = CActiveRecord::model($modelName)->find($criteria);
	if($model==null)
	    throw new CHttpException(404,'The requested page does not exist.');
	return $model;
    }

}