<?php

class Admin extends App_Frontend {
    public $title = 'Apartment Buddy';

    private $controller_install_addon;

    public $layout_class = 'Layout_Fluid';

    public $auth_config = array('admin' => 'admin');

    /** Array with all addon initiators, introduced in 4.3 */
    private $addons = array();

    /**
     * Initialization.
     */
    public function init()
    {
        parent::init();
        $this->api->pathfinder
            ->addLocation(array(
                'addons' => array('vendor','shared/addons2','shared/addons'),
            ))
            ->setBasePath($this->pathfinder->base_location->getPath() . '/..');

        $this->dbConnect();
        
        $this->add('jUI');

            
        $this->add($this->layout_class);

        $this->menu = $this->layout->addMenu('Menu_Vertical');
        $this->menu->swatch = 'ink';

        $m = $this->layout->addFooter('Menu_Horizontal');
        $m->addItem('foobar');

        $this->initTopMenu();
    }

    function initTopMenu(){

        $top_menu=$this->layout->add('Menu_Horizontal',null,'Top_Menu');
        $top_menu->addItem(['Configuration','icon'=>'ajust'],'/configuration');
    }
}
