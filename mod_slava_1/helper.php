<?php
/**
 * Helper class for Hello Slava! module
 * @package		mod_slava_1
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class modHelloSlavaHelper
{
    /**
     * @param array $params An object containing the module parameters
     * @access public
     */    

    public static function getModuleParamsArray()
    {
	// get and parse module parameters (for database connection)
	jimport( 'joomla.application.module.helper' );
	$my_params = JModuleHelper::getModule( 'mod_slava_1' );
	$my_params_data = explode(",",str_replace("\"","",substr($my_params->params,1,-1)));
	$my_params_array = array();
	foreach ($my_params_data as $pair) {
	    list($key,$value) = explode(':',$pair);
	    $my_params_array[$key]=$value;
	};
	return $my_params_array;
    }


    public static function getSQLQuery01( $data, $base_sql )
    {

	$my_params_array = modHelloSlavaHelper::getModuleParamsArray();
	$option = array();
        $option['driver']   = $my_params_array['databaseexternaldriver'];       	// Database driver name
	$option['host']     = $my_params_array['databaseexternalhost'];    		// Database host name
	$option['user']     = $my_params_array['databaseexternaluser'];  // User for database authentication
	$option['password'] = $my_params_array['databaseexternalpassword'];   // Password for database authentication
	$option['database'] = $my_params_array['databaseexternaldatabase'];      // Database name
	$option['prefix']   = $my_params_array['databaseexternalprefix'];             // Database prefix (may be empty)
 
	// Obtain a database connection
	$my_db = JDatabaseDriver::getInstance( $option );
	$quoted_data = $my_db->quote( $data );
	// Retrieve the shout
	$query = $base_sql . $quoted_data ;
	// Prepare the query
	$my_db->setQuery($query);
	// Load the results as a list of stdClass objects
        $rows = $my_db->loadObjectList();
	return $rows;
    }


    public static function requestCasesTable( $data, $params )
    {
        $base_sql = "SELECT * FROM list_of_cases_for_parcel WHERE parcel_case_id IS NOT NULL AND parcel_case_id LIKE ";
	$rows = modHelloSlavaHelper::getSQLQuery01( $data, $base_sql );
	$result = "";
	// Retrieve each value in the ObjectList 
 	foreach( $rows as $row ) { 
		$result .= "Predio (Parcel Map ID): " . $row->parcel_map_id . ", ";
		$result .= "Tramite (Case ID): " . $row->parcel_case_id . ", ";
		$result .= "Fecha de inicio: " . $row->open_date_time . ", ";
		$result .= "Promotor: " . $row->person_name . ", ";
		$result .= "</br>";
	 } 
	return $result;
    }



}

// The class name should be strictly the same as module helper name without spaces
class modSlava1Helper
{

     // method getAjax() is the main method, can not be ommited
     public static function getAjax()
    {
	// Function to precess Ajax submitted data and return Ajax output
	// Getting input data
	$input = JFactory::getApplication()->input;

	$variable1  = $input->get('variable1');
	// the variable 2 could be numeric only (for security reasons, as it is not passed through db->quote
	$variable2 = preg_replace('/[^0-9]/', '', $input->get('variable2'));
	$mode  = $input->get('ajax_mode');

	$base_sql = '';
	if ('parcel_info' == $mode) {
	        $base_sql = "SELECT * FROM parcels WHERE parcel_map_version_id = ". $variable2 ." AND parcel_map_id = ";
	}
	if ('case_status' == $mode) {
	        $base_sql = "SELECT * FROM case_decisions WHERE decision_status = 'vigente' 
		AND parcel_case_id = ". $variable2 . " ORDER BY decision_modification_date_time DESC LIMIT 1";
	}
                                         	

	$obj = new stdClass;
	$obj->rows = modHelloSlavaHelper::getSQLQuery01( $variable1, $base_sql );
	$result = "";

	// Retrieve each value in the ObjectList 
 	foreach( $obj->rows as $row ) {
		if ('parcel_info' == $mode) { 
			$result .= "XML:" . $row->parcel_map_properties_xml ;
		}
	 } 
	if( !$obj->rows ) {
		$result = "Consulta no regreso datos";
	}
	$obj->string = $result;
	return json_encode($obj);
      }

}
?>