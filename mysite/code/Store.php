<?php

class Store extends DataObject{

	static $db = array(
		'Name' => 'Text',
		'Address' => 'Text',
		'Latitude' => 'Decimal(12,10)',
		'Longitude' => 'Decimal(12,10)',
	);

}
