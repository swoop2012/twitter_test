<?php
class TagWidget extends CWidget
{
    public $limit;

    public function run()
    {
        $result = Word::model()->findAll(array('order'=>'count_used DESC','limit'=>$this->limit));
        if(!empty($result)){
            $tags = array();
            foreach(array_rand($result,count($result)) as $value){
                $tags[$result[$value]->word] = array('weight'=>$result[$value]->count_used,'url'=>Yii::app()->createUrl('/twitt/search',array('q'=>$result[$value]->word)));
            }

            $this->widget('application.extensions.YiiTagCloud.YiiTagCloud',
                array(
                    'beginColor' => '00F89A',
                    'endColor' => 'A3AEFF',
                    'minFontSize' => 8,
                    'maxFontSize' => 48,
                    'htmlOptions' => array('style'=>'width: 259px; margin-left: auto; margin-right: auto'),
                    'arrTags' => $tags,
                )
                );
        }
    }

}
?>