<?php

/**
* description: state
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_State extends Model_Base_Table{

	public $table="state";

	function init(){
		parent::init();

		$this->hasOne('Country','country_id');
		$this->addField('name');
		$this->addField('is_active')->type('boolean')->defaultValue(1);
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}