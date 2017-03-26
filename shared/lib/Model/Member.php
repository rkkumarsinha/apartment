<?php

/**
* description: Member Model for all apartment family
* @author : Rakesh Sinha
* @email : techrakesh91@gmail.com
* @website : http://apartmentbuddy.in
* 
*/

class Model_Member extends Model_Base_Table{

	public $table="member";

	function init(){
		parent::init();
		

		$this->hasOne('Flat','flat_id');

		$this->add('filestore\Field_File','profile_picture_id');

		$this->addField('name')->caption('Full Name');
		$this->addField('mobile_no');
		$this->addField('email_id');
		$this->addField('gender')->enum(['Male','Female','Other']);
		$this->addField('dob');
		$this->addField('is_married')->type('boolean')->defaultValue('false');
		$this->addField('marriage_anniversary_date')->type('boolean')->defaultValue('false');
		
		$this->addField('is_admin')->type('boolean')->defaultValue('false');
		$this->addField('relation_with_admin')->enum(['Father','Mother','Sister','Brother','Daughter','Son','Grand Father','Grand Mother','Uncle','Aunty','Nephew','Other']);

		$this->addField('created_at')->type('date');
		$this->addField('updated_at')->type('date');

		$this->addField('about_you')->type('boolean');
		
		$this->add('dynamic_model/Controller_AutoCreator');
	}
}
