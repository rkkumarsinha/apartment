<?php

/**
* description: Transaction .
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_ApartmentAdmin extends Model_Base_Table{

	public $table="apartment_admin";

	function init(){
		parent::init();

		$this->hasOne('Apartment','apartment_id');
		$this->hasOne('Member','member_id');
		
		$this->addField('created_at')->type('datetime');
		$this->addField('is_active_admin');
		$this->addField('narration');
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}