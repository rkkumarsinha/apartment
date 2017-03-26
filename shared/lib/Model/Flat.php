<?php

/**
* description: Member Model for all apartment family
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_Flat extends Model_Base_Table{

	public $table="flat";

	function init(){
		parent::init();
		

		$this->hasOne('Apartment','apartment_id');
		$this->add('filestore\Field_File','flat_picture_id');

		$this->addField('code');

		$this->addField('name')->caption('Flat Name');
		$this->addField('owner_name');
		$this->addField('flat_no');
		$this->addField('floor_no');
		$this->addField('mobile_no');
		$this->addField('email_id');
		
		$this->addField('is_active')->type('boolean');

		$this->addField('inauguration_date')->type('date');
		$this->addField('created_at')->type('date');
		$this->addField('updated_at')->type('date');

		$this->addField('apartment_fees')->type('money')->defaultValue(0);

		$this->addField('about_us')->type('text');

		$this->hasMany('Member','member_id');
		$this->hasMany('Transaction','transaction_id');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}
