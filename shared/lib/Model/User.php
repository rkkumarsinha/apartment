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

	function sendWelcomeAndVerification(){
		if(!$this->loaded())throw new \Exception("user model must loaded", 1);
		
		// 
		// $to = "techrakesh91@gmail.com";
		// $message = "message body come here";
		// $subject = "subject";

		// $out_box = $this->add('Model_Outbox');
		// $out_box->sendEmail($to,$subject,$message,$this);

	}
}
