<?php

class Admin extends App_Frontend {
    public $title = 'Agile Toolkit™ Admin';

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

        $this->add($this->layout_class);

        $this->menu = $this->layout->addMenu('Menu_Vertical');
        $this->menu->swatch = 'ink';

        $m = $this->layout->addFooter('Menu_Horizontal');
        $m->addItem('foobar');
    }

}
