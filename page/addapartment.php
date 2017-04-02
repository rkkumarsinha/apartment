<?php
class page_addapartment extends basePage{

    public $title='Add Your Apartment';
    public $subtitle='';

    function init(){
        parent::init();

        $this->app->stickyGET('todo');
        $this->app->stickyGET('of');
        $this->app->stickyGET('user');

        if($_GET['todo'] == "verification"){
            $this->app->layout->template->trySet('title','Welcome Apartment');
            $this->app->layout->template->trySet('subtitle','verify your Apartment account');
            $this->addVerificationForm();
        }else{
            $this->app->layout->template->trySet('title','Add Your Apartment');
            $this->app->layout->template->trySet('subtitle','');
            $this->addRegistrationForm();
        }
    }

    function addVerificationForm(){
        $this->add('View_Success',null,'center')->set('Verification link has been send to email id');


        $apartment_id = $_GET['of']?:0; // for apartment id
        $user_id = $_GET['user']?:0; // user id

        $apartment_model = $this->add('Model_Apartment')->tryLoad($apartment_id);
        if(!$apartment_model->loaded())
            throw new \Exception("apartment model must loaded", 1);
        
        $user_model = $this->add('Model_User')->tryLoad($user_id);
        if(!$user_model->loaded())
            throw new \Exception("user model must loaded", 1);

        $form = $this->add('Form',null,'center');
        
        $form->addField('registered_email_id')->validate('email')->set($user_model['username']);
        $form->addField('verification_code')->validate('required');
        $form->addSubmit('Verify Account');
        if($form->isSubmitted()){
            // check hash code of user is same as verification code

            $apartment_model->activateAndVerify();
            $user_model->activateAndVerify();

            $this->app->stickyForget('of');
            $this->app->stickyForget('user');
            $this->app->stickyForget('todo');

            // login by id
            $this->app->auth->loginById($user_model->id);
            $this->app->memorize('verified_user',$user_model->id);
            // $this->app->auth->loggedIn($user_model['username'],$user_model['password']);
            $this->app->redirect($this->app->url('dashboard'))->execute();
        }

    }

    function addRegistrationForm(){

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
        $form->addField('email_id')->validate('email');
        $form->addField('mobile_no')->validate('required');
        // $form->addField('username')->validate('email');
        $form->addField('password','password')->validate('len|gt|6');
        $form->addField('password','repassword')->validate('len|gt|6');


        // $country_field->js('change',$form->js()->atk4_form('reloadField','state',[$this->app->url(),'country_id'=>$country_field->js()->val()]));
        $country_field->js('change',$state_field->js()->reload(null,null,[$this->app->url(null,['cut_object'=>$state_field->name]),'country_id'=>$country_field->js()->val()]));
        $state_field->js('change',$city_field->js()->reload(null,null,[$this->app->url(null,['cut_object'=>$city_field->name]),'state_id'=>$state_field->js()->val()]));

        $form->addSubmit('Submit Your Apartment')->addClass('btn btn-block');
        
        if($form->isSubmitted()){

            if($form['password'] != $form['repassword'])
                $form->error('password','password and confirm password must be same');
            
            // save apartment
            $apartment = $this->add('Model_Apartment');
            $apartment['name'] = $form['apartment_name'];
            $apartment['city_id'] = $form['city'];
            $apartment['state_id'] = $form['state'];
            $apartment['country_id'] = $form['country'];
            $apartment['pincode'] = $form['pincode'];
            $apartment['contact_persion_name'] = $form['contact_persion_name'];
            $apartment['contact_email_id'] = $form['email_id'];
            $apartment['contact_mobile_no'] = $form['mobile_no'];
            $apartment['is_active'] = 0;
            $apartment['is_verified'] = 0;
            $apartment->save();

            // save
            $user = $this->add('Model_User');
            $this->add('BasicAuth')
                ->usePasswordEncryption('md5')
                ->addEncryptionHook($user);

            $user['apartment_id'] = $apartment->id;
            $user['username'] = $form['email_id'];
            $user['password'] = $form['password'];
            $user['scope'] = 'ApartmentAdmin';
            $user->save();

            try{
                $user->sendWelcomeAndVerification();
            }catch(Exception $e){
                
            }
            
            $this->app->redirect($this->app->url(null,['todo'=>'verification','of'=>$apartment->id,'user'=>$user->id]));
        } 
    }

    function defaultTemplate(){
        return ['page/addapartment'];
    }
}