<?php

/**
* description: state
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_ActiveCity extends Model_City{

	function init(){
		parent::init();

		$this->addCondition('is_active',1);
	}
}