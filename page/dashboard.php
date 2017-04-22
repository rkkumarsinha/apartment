<?php

class page_dashboard extends basePage{

    function init(){
        parent::init();

		// if(!$this->app->auth->model->loaded()){
		// 	$this->app->redirect($this->app->url('login'));
		// }

		// if($v_user_id = $this->app->recall('verified_user')){
		// 	$this->add('View_Success')->set('your account is verified successfully'.$v_user_id );
		// 	$this->app->forget('verified_user');
		// }

        $user_name = $this->app->auth->model->id;
        // $this->add('View_Info')->set($user_name);
        $this->add('View_Info')->set('Welcome to admin panel');
    }

}