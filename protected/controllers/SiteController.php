<?php

class SiteController extends Controller
{
    protected $max_id;
    protected $since_id=NULL;

    public function actionIndex()
	{
        $model = new UserTwitterForm;
        $validated = false;
        if(isset($_POST['UserTwitterForm'])){
            $model->attributes = $_POST['UserTwitterForm'];
            if($model->validate())
                $validated = true;
                $request = Yii::app()->request;
                $params = array('user_id'=>$model->result['id'],$request->csrfTokenName=>$request->csrfToken);
                if(isset($model->result['last_parsed_twitt']) && !empty($model->result['last_parsed_twitt']))
                    $params['last_parsed_twitt'] = $model->result['last_parsed_twitt'];
                Yii::app()->clientScript->registerScript('load_twitts',"
                var content = $('#ajax-content'),
                    sidebar = $('#sidebar');
                content.show();
                function refreshTags(){
                    if(sidebar.length)
                    return $.get('".$this->createUrl('refreshTags')."',{},function(data){
                        sidebar.html(data.content);
                    },'json');
                }
                $.post('".$this->createUrl('loadTwitts')."',".CJavaScript::encode($params).",function(data){
                    console.log(data);
                    content.html('<h3>Данные были загружены</h3>');
                    var result = refreshTags()
                    $.when(result).done(function(){content.fadeOut(1200);})

                },'json');
                ",CClientScript::POS_READY);

        }
        $this->render('index',compact('model','validated'));
	}

    public function actionLoadTwitts(){
        if(isset($_POST['user_id'])){
            $transaction = Yii::app()->db->beginTransaction();
            $this->getTwitts($_POST['user_id'],200,isset($_POST['last_parsed_twitt']) ? $_POST['last_parsed_twitt']:null);

            if(!empty($this->since_id))
                User::model()->updateByPk($_POST['user_id'],array('last_parsed_twitt'=>$this->since_id));

            try{
                $transaction->commit();
                echo CJSON::encode(array('status'=>'success'));
            }
            catch(Exception $e){

                $transaction->rollback();
                Yii::log($e->getMessage(),CLogger::LEVEL_ERROR);
                echo CJSON::encode(array('status'=>'failure'));
            }

        }
        else
            echo CJSON::encode(array('status'=>'failure'));
    }

    public function actionRefreshTags(){
           echo CJSON::encode(array('content'=> $this->widget('application.extensions.Tag.TagWidget',
               array('limit'=>25)
      ,true)));
    }

    private function getTwitts($user,$count,$lastId=null,$maxId=NULL){
            $twitter = new TwitterAPIExchange(Yii::app()->params['twitter_settings']);
            $params = array('include_entities'=>false,'count'=>$count);
            $params['user_id'] = $user;

            if(!empty($lastId))
                $params['since_id'] = $lastId;
            if(!empty($maxId))
                $params['max_id'] = $maxId;
            $result = CJSON::decode($twitter->setGetfield('?'.http_build_query($params))
                ->buildOauth('https://api.twitter.com/1.1/statuses/user_timeline.json', 'GET')
                ->performRequest());
            $this->writeTwitts($result);

            $countResult = count($result);
            $this->max_id = isset($result[$countResult-1]['id_str']) ? $result[$countResult-1]['id_str']:null;
            if($countResult==$count)
                $this->getTwitts($user,$count,$lastId,$this->max_id);
        return $lastId;
    }

    private function writeTwitts($twitts){

        if(isset($twitts['errors']))
            Yii::log(CVarDumper::dumpAsString($twitts['errors']),CLogger::LEVEL_ERROR);
        if(!empty($twitts)&&!isset($twitts['errors'])){
            $this->since_id = $this->since_id < $twitts[0]['id_str'] ? $twitts[0]['id_str'] : $this->since_id;

            $pattern = "/[\s,\#,\-,\",http:\/\/.\w+.\w+]+/";
            $db = Yii::app()->db;
            foreach($twitts as $twitt){
                if($twitt['id_str']==$this->max_id)
                    continue;
                $model = new Twitt();
                $model->attributes = array(
                    'id'=>$twitt['id_str'],
                    'created_at'=>date('Y-m-d H:i:s',strtotime($twitt['created_at'])),
                    'text'=>$twitt['text'],
                    'search_text'=>mb_strtolower($twitt['text'],'utf-8'),
                    'user_id'=>isset($twitt['user']['id']) ? $twitt['user']['id']:null,
                    'retweet_count'=>$twitt['retweet_count'],
                    'favorite_count'=>$twitt['favorite_count'],
                );
                $model->save(false);


                $matches = preg_split($pattern,$model->search_text ,NULL,PREG_SPLIT_NO_EMPTY);
                if(!empty($matches))
                    foreach($matches as $value){
                        $db->createCommand("INSERT INTO {{word}}(`word`,`count_used`) VALUES(:val,1)
                        ON DUPLICATE KEY UPDATE `count_used`=`count_used`+1")->bindValue(':val',$value)->execute();
                    }
            }
        }
    }

    public function actionError(){
	    
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}


}