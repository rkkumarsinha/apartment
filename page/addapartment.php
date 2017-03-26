<?php
class page_addapartment extends basePage{

    public $title='Add Your Apartment';
    public $subtitle='';

    function init(){
        parent::init();

        $this->app->layout->template->trySet('title','Add Your Apartment');
        $this->app->layout->template->trySet('subtitle','');

        $form = $this->add('Form',null,'registration_form',['form/stackedWithFloatingLabel']);
        $apartment_section = $form->add('View_FormGroup');

        $apartment_section->add('View')->setElement('h3')->set('Apartment Information');
        $col = $apartment_section->add('Columns');
        // apartment section
        $col1 = $col->addColumn(12);
        $col2 = $col->addColumn(12);
        $col3 = $col->addColumn(3);
        $col4 = $col->addColumn(3);
        $col5 = $col->addColumn(3);
        $col6 = $col->addColumn(3);
        
        $col1->addField('apartment_name')->validate('required');
        $col2->addField('address')->validate('required');
        $col3->addField('country')->validate('required');
        $col4->addField('state')->validate('required');
        $col5->addField('city')->validate('required');
        $col6->addField('pincode')->validate('required');

        // admin section
        $admin_section = $form->add('View_FormGroup');
        $admin_section->add('View')->setElement('h3')->set('Apartment Admin Information');

        $col2 = $admin_section->add('Columns');
        $admin_col1 = $col2->addColumn(12);
        $admin_col2 = $col2->addColumn(6);
        $admin_col3 = $col2->addColumn(6);


        $admin_col1->addField('contact_persion_name')->validate('required');
        $admin_col2->addField('email_id')->validate('required');
        $admin_col3->addField('mobile_no')->validate('required');
        $admin_col2->addField('username')->validate('required');
        $admin_col3->addField('password')->validate('required');

        $form->addSubmit('Submit Your Apartment');

    }

    function defaultTemplate(){
        return ['page/addapartment'];
    }
}