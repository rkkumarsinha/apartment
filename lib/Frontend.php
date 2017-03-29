<?php

class Frontend extends ApiFrontend {
    function init() {
        parent::init();

        $this->add('Layout_Apartment');
        // you can also use Layout_Fluid

        $this->add('jUI');
        
        $this->dbConnect();

        $this->addLocation();

        $auth=$this->add('Auth');
        $auth->usePasswordEncryption();
        $auth->setModel('User','username','password');
        
        $this->add('Controller_PatternRouter')
            ->link('home', ['param1','param2','param3'])
            // ->link('udaipur', ['param1','param2'])
            ->route();
        // $auth->check();
        // throw new \Exception('base_url = '.$this->app->pm->base_url." path = ".$this->app->pm->base_path." page = ".$this->app->pm->page." argument=");
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
