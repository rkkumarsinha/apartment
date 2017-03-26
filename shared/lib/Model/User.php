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

		$this->addField('username');
		$this->addField('password')->type('password');
		$this->addField('scope')->enum(['Member','ApartmentAdmin','SuperUser','Admin'])->defaultValue('Member');
		$this->addField('hash');
		$this->addField('last_login_date')->type('datetime');
		$this->addField('status')->enum(['Active','Inactive'])->defaultValue('Active');
		$this->addField('is_verified')->type('boolean')->defaultValue(0);
		$this->addField('is_blocked')->type('boolean')->defaultValue(0);

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}
