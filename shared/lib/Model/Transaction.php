<?php

/**
* description: Transaction .
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_Transaction extends Model_Base_Table{

	public $table="transation";

	function init(){
		parent::init();

		$this->hasOne('Apartment','apartment_id');
		$this->hasOne('Flat','flat_id');
		$this->hasOne('Member','member_id');
		$this->hasOne('Staff','staff_id');

		$this->addField('name');
		$this->addField('type')->enum(['deposite','expense']);
		$this->addField('narration');
		$this->addField('created_at')->type('date');
		$this->addField('updated_at')->type('date');

		$this->hasMany('TransactionRow','transaction_id',null,'TransactionRows');
		
		$this->add('dynamic_model/Controller_AutoCreator');		
	}
}