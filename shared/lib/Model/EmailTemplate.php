<?php

class Model_EmailTemplate extends Model_Base_Table{
	public $table = "email_template";

	function init(){
		parent::init();

		$this->addField('name');
		$this->addField('subject');
		$this->addField('body')->type('text');
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}