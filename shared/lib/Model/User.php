<?php

/**
* description: User Model used for Authentication basically.
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.com
* 
*/

class Model_User extends Model_Base_Table{

	public $table="user";

	function init(){
		parent::init();
		
		$this->hasOne('Member','member_id');
		$this->hasOne('Apartment','apartment_id')->defaultValue(0);

		$this->addField('username');
		$this->addField('password')->type('password');
		$this->addField('scope')->enum(['Member','ApartmentAdmin','SuperUser','Admin'])->defaultValue('Member');
		$this->addField('hash');
		$this->addField('last_login_date')->type('datetime');
		$this->addField('is_verified')->type('boolean')->defaultValue(0);
		$this->addField('is_blocked')->type('boolean')->defaultValue(0);
		$this->addField('is_active')->type('boolean')->defaultValue(0);
		$this->addField('last_otp')->type('datetime');
		$this->addField('mobile_no');

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function activateAndVerify(){
		if(!$this->loaded()) throw new \Exception("user model must loaded");

		$this['is_active'] = true;
		$this['is_verified'] = true;
		$this['is_blocked'] = false;
		$this['hash'] = 0;
		return $this->save();
	}

	function sendVerification(){
		if(!$this->loaded())throw new \Exception("user model must loaded", 1);
		
		$template = $this->add('Model_Template');
		$template->addCondition('name','ACCOUNTVERIFICATION');
		$template->tryLoadAny();
		if(!$template->loaded())
			throw new \Exception("email template not found");
		
		$subject = $template['subject'];
		$body = $template['body'];
		$to = $this['username'];

		$this['hash'] = strtoupper(substr(md5(rand(111111,999999)),5,6));
        $this['last_otp'] = $this->app->now;
        $this->save();
        
        $url = $this->api->url('addapartment',['todo'=>'verification','hash'=>$this['hash'],'user'=>$this->id,'email'=>$this['username']]);
        $body = str_replace("{activation_link}", $url, $body);

		$out_box = $this->add('Model_Outbox');
		$out_box->sendEmail($to,$subject,$body,$this);
	}

	function isEmailExist(){

	}

}
