<?php

class page_apartment extends Page{

	function init(){
		parent::init();

		$crud = $this->add('CRUD');
		$crud->setModel('Apartment');
	}
}