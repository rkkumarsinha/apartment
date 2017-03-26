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
        
        $this->dbConnect();

        $this->addLocation();

        $auth=$this->add('Auth');
        $auth->usePasswordEncryption();
        $auth->setModel('User','username','password');
        // $auth->check();
        
    }

    function addLocation(){
        $this->api->pathfinder
            ->addLocation(array(
                'addons' => array('vendor','shared/addons2','shared/addons'),
                'addons' => array('vendor','shared/addons2','shared/addons'),
                'css' => array('vendor','shared/templates/assets','templates/assets'),
                'js' => array('vendor','shared/templates/assets/js','templates/assets/js'),
                'php' => array('vendor','shared/lib')
            ))
            ->setBasePath($this->pathfinder->base_location->getPath() );            
    }
}
