<?php
class page_signin extends Page{

    function init(){

        parent::init();
    	
        $form = $this->add('Form',null,null,['form/stackedWithFloatingLabel']);
        $form->addField('line','userid',"User/ e-mail id/ Mobile No")->validate('required');
        $form->addField('password','password')->validate('required');
        $form->addField('DatePicker','date')->validate('required');
        $form->addSubmit('Sign In');


    }
}