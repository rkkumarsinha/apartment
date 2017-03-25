<?php

class Frontend extends ApiFrontend {
    function init() {
        parent::init();

        $this->add('Controller_PatternRouter')
			->link('home', ['param1','param2'])
			->route();

        $this->add('Layout_Apartment');
        // you can also use Layout_Fluid

        $this->add('jUI');
        $this->api->pathfinder
            ->addLocation(array(
                'addons' => array('vendor','shared/addons2','shared/addons'),
                'css' => array('vendor','shared/templates/assets','templates/assets'),
            ))
            ->setBasePath($this->pathfinder->base_location->getPath() );
    }
}
