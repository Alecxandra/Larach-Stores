<?php

class HomePage extends Page{
	static $many_many = array(
		'Stores' => 'Store'
	);


	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Tiendas', new GridField('Tiendas', 'Tiendas', $this->Stores(), new GridFieldConfig_RelationEditor()));
		return $fields;
	}
}

class HomePage_Controller extends Page_Controller{

}
