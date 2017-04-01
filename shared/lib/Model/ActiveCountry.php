<?php

/**
* description: country
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_ActiveCountry extends Model_Country{

	function init(){
		parent::init();

		$this->addCondition('is_active',1);
	}
}