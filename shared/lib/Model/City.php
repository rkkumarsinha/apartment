<?php

/**
* description: state
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_City extends Model_Base_Table{

	public $table="city";

	function init(){
		parent::init();

		$this->hasOne('State','state_id');
		$this->addField('name');
		$this->addField('is_active')->type('boolean')->defaultValue(1);
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}