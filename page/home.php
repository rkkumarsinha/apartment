<?php
class page_home extends Page{

    function init(){

        parent::init();
    	
        $this->app->stickyGET('param1');
        $this->app->stickyGET('param2');

        // $this->app->layout->template->tryDel('banner_section');

        // $this->app->stickyGET('reload');
        // $this->app->layout->add('View',null,'banner_content')->setHtml('<div class="brand"> hello</div>');
    	// $v = $this->add('View')->set("hello =".$_GET['param1']." = ".$_GET['param2']." reload = ".$_GET['reload']." = rand ".rand(90,100));
    	// $this->add('Button')->js('click',$v->js()->reload(['reload'=>rand(111,9999)]));

    }
}