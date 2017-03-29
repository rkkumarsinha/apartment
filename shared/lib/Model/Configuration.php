<?php

class Model_Configuration extends Model_Base_Table{
	public $table="configuration";

	function init(){
		parent::init();

		$this->addField('host')->hint('ie. for gmail smtp.gmail.com');
		$this->addField('username')->hint('your email id ie. xyz@doiman.com');
		$this->addField('password')->type('password');
		$this->addField('smtp_secure')->enum(['ssl','tls']);
		$this->addField('port');
		$this->addField('from_email')->hint('your email id ie. xyz@doiman.com');
		$this->addField('reply_to')->hint('your email id ie. xyz@doiman.com');
		$this->addField('footer')->type('text');

		// sms api setting
		$this->addField('gateway_url')->hint('http://api.alerts.solutionsinfini.com/v3/?method=sms');
		$this->addField('api_key');
		$this->addField('sender');
		$this->addField('format');
		$this->addField('custom');
		
		//ccavenue api setting
		$this->addField('test_mode')->setValueList([1=>'yes',0=>'no']);
		$this->addField('merchant_id');
		$this->addField('access_code');
		$this->addField('working_key');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}