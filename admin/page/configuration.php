<?php

class page_configuration extends Page{

	function init(){
		parent::init();

		$tabs = $this->add('Tabs');
		$tab_template = $tabs->addTab('Email Templates');
		$tab_location = $tabs->addTab('Location');
		
		$crud = $tab_template->add('CRUD');
		$crud->setModel('EmailTemplate');

		$location_tabs = $tab_location->add('Tabs');

		$tab_country = $location_tabs->addTab('Country');
		$tab_state = $location_tabs->addTab('State');
		$tab_city = $location_tabs->addTab('City');

		$crud_country = $tab_country->add('CRUD');
		$crud_country->setModel('Country');

		$crud_state = $tab_state->add('CRUD');
		$crud_state->setModel('State');

		$crud_city = $tab_city->add('CRUD');
		$crud_city->setModel('City');
	}
}