<?php

/**
* description: Apartment Model used for Authentication basically.
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_Apartment extends Model_Base_Table{

	public $table="apartment";

	function init(){
		parent::init();
				
		$this->addField('name');
		$this->addField('address');

		$this->hasOne('City','city_id');
		$this->hasOne('State','state_id');
		$this->hasOne('Country','country_id');

		$this->addField('pincode');
		$this->addField('code');
		$this->addField('is_active')->type('boolean')->defaultValue(0);
		$this->addField('is_verified')->type('boolean')->defaultValue(0);

		$this->addField('contact_persion_name');
		$this->addField('contact_email_id');
		$this->addField('contact_mobile_no');

		$this->addField('inauguration_date')->type('date');
		$this->addField('created_at')->type('datetime')->defaultValue($this->app->now);
		$this->addField('updated_at')->type('datetime')->defaultValue($this->app->now);
		$this->addField('starting_date')->type('date')->defaultValue($this->app->now);

		// builder information
		$this->addField('builder_name');
		$this->addField('builder_mobile_no');
		$this->addField('builder_email');

		// member fees management
		$this->addField('per_month_per_member_maintenance_fees');
		$this->addField('last_day_of_member_fees_submission');
		$this->addField('remind_after_days')->type('int');
		$this->addField('remind_one_time')->type('boolean');

		// penalty
		$this->addField('penalty');
		$this->addField('penalty_apply_after_days_from_last_date_of_submission');
		$this->addField('penalty_one_time')->type('boolean')->defaultValue(0);
		$this->addField('penalty_recurring')->setValueList(['day'=>'Day','month'=>"Month"]);
		
		$this->hasMany('Flat','flat_id');
		$this->hasMany('Staff','staff_id');
		$this->hasMany('Transaction','transaction_id');
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function activate(){
		if(!$this->loaded()) throw new \Exception("apartment model must loaded");

		$this['is_active'] = true;
		$this->save();
		return $this;
	}

	function verify(){
		if(!$this->loaded()) throw new \Exception("apartment model must loaded");
		
		$this['is_verified'] = true;
		$this->save();
		return $this;
	}

	function activateAndVerify(){
		if(!$this->loaded()) throw new \Exception("apartment model must loaded", 1);

		$this['is_verified'] = 1;
        $this['is_active'] = 1;
        return $this->save();
	}
}
