<?php
class page_addapartment extends basePage{

    public $title='Add Your Apartment';
    public $subtitle='';

    function init(){
        parent::init();

        $this->app->layout->template->trySet('title','Add Your Apartment');
        $this->app->layout->template->trySet('subtitle','');

        $form = $this->add('Form',null,'registration_form',['form/empty']);
        $add_layout = $form->add('View',null,null,['form/addapartment']);
        $form->setLayout($add_layout);
        $form->addClass('material_form');

        $form->addField('apartment_name')->validate('required');
        $form->addField('address')->validate('required');

        $country_field = $form->addField('DropDown','country');
        $country_field->validate('required')->setEmptyText('select country');
        $country_field->setModel('ActiveCountry');

        $state_model = $this->add('Model_ActiveState');
        
        $state_field = $form->addField('DropDown','state');
        $state_field->validate('required')->setEmptyText('select state');
        
        // reload data
        if($country_id = $this->app->stickyGET('country_id')){
            $state_model->addCondition('country_id',$country_id);
        }
        $state_field->setModel($state_model);


        $city_model = $this->add('Model_ActiveCity');
        $city_field = $form->addField('DropDown','city');
        $city_field->validate('required')->setEmptyText('select city');
        
        // // reload data
        if($state_id = $this->app->stickyGET('state_id')){
            $city_model->addCondition('state_id',$state_id);
        }
        $city_field->setModel($city_model);

        $form->addField('pincode')->validate('required');

        // admin section
        $form->addField('contact_persion_name')->validate('required');
        $form->addField('email_id')->validate('required');
        $form->addField('mobile_no')->validate('required');
        $form->addField('username')->validate('required');
        $form->addField('password','password')->validate('required');


        // $country_field->js('change',$form->js()->atk4_form('reloadField','state',[$this->app->url(),'country_id'=>$country_field->js()->val()]));
        $country_field->js('change',$state_field->js()->reload(null,null,[$this->app->url(null,['cut_object'=>$state_field->name]),'country_id'=>$country_field->js()->val()]));
        $state_field->js('change',$city_field->js()->reload(null,null,[$this->app->url(null,['cut_object'=>$city_field->name]),'state_id'=>$state_field->js()->val()]));

        $form->addSubmit('Submit Your Apartment')->addClass('btn btn-block');

    }

    function defaultTemplate(){
        return ['page/addapartment'];
    }
}