<?php

class page_index extends Page {

    public $title='Dashboard';

    function init() {
        parent::init();

        $this->add('View_Box')
            ->setHTML('Welcome to your new Web App Project. Get started by opening '.
                '<b>admin/page/index.php</b> file in your text editor and '.
                '<a href="http://book.agiletoolkit.org/" target="_blank">Reading '.
                'the documentation</a>.');


        $form = $this->add('Form');//,null,null,['form/empty']);
        $c_f = $form->addField('DropDown','country');
        $county = $this->add('Model_Country');
        $state = $this->add('Model_State');

        $this->app->stickyGET('country_id');
        if($_GET['country_id']){
  			$state->addCondition('country_id',$_GET['country_id']);
        }

        $c_f->setModel($county);
        $s_f = $form->addField('DropDown','state');
        $s_f->setModel($state);

        $c_f->js('change',$form->js()->atk4_form('reloadField','state',[$this->app->url(),'country_id'=>$c_f->js()->val()]));
		// $c_f->js('change',$s_f->js()->reload(null,null,[$this->app->url(null,['cut_object'=>$s_f->name,'country_id'=>$c_f->js()->val()])]));
    }
}
