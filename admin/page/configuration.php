<?php

class page_configuration extends Page{

	function init(){
		parent::init();

		$tab = $this->add('Tabs');
		$template = $tab->addTab('Email Templates');
		
		$crud = $template->add('CRUD');
		$crud->setModel('EmailTemplate');
		
	}
}