<?php

/**
* description: country
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_Country extends Model_Base_Table{

	public $table="country";

	function init(){
		parent::init();

		$this->addField('name');
		$this->addField('is_active')->type('boolean')->defaultValue(1);
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}