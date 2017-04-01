<?php

/**
* description: country
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_ActiveState extends Model_State{

	function init(){
		parent::init();

		$this->addCondition('is_active',1);
	}
}