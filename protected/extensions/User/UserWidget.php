<?php
class UserWidget extends CWidget
{
  public $user;
  public function run()
  {

    $this->render('user',array('user'=>$this->user));
  }

}
?>