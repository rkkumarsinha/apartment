<?php

class Controller_Validator extends \Controller_Validator{

	function init(){
		parent::init();

	}

	function rule_email($a){   
        if( $a and ! filter_var($a, FILTER_VALIDATE_EMAIL)){
            return $this->fail('Must be a valid email address');
        }
    }

    function rule_required($a){
        if ($a==='' || $a===false || $a===null) {
            return $this->fail('must not be empty');
        }
    }
}