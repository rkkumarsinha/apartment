<?php

/**
* description: Transaction .
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_TransactionRow extends Model_Base_Table{

	public $table="transaction_row";

	function init(){
		parent::init();

		$this->hasOne('Transaction','transaction_id');

		$this->addField('amountDr');
		$this->addField('amountCr');
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}