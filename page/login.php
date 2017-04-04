<?php
class page_login extends basePage{

    function init(){
        parent::init();

		$form = $this->app->layout->add('Form',null,null,['form/empty']);
        $login_layout = $form->add('View',null,null,['form/login']);
        $form->setLayout($login_layout);
        $form->addClass('material_form');

        $form->addField('username')->validate('required');
        $form->addField('password','password')->validate('required');
		        
    }

    // function defaultTemplate(){
    	// return ['page/login'];
    // }
}