<?php
/**
 * Helper class for Hello Slava! module
 * 
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class modHelloSlavaHelper
{
    /**
     * Retrieves the hello message and simple external database querry
     *
     * @param array $params An object containing the module parameters
     * @access public
     */    
    public static function getHello()
    {
        // return 'Ok!';
    }



    public static function getSQLQuery01( $data, $base_sql )
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

	$option = array();
        $option['driver']   = $my_params_array['databaseexternaldriver'];            // Database driver name
	$option['host']     = $my_params_array['databaseexternalhost'];    // Database host name
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
		$result .= "Tramite iniciado: " . $row->open_date_time . ", ";
		$result .= "Ciudadano/Persona: " . $row->person_name . ", ";
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
	$data  = $input->get('data');

	// Preparing and executing database request
        $base_sql = "SELECT * FROM list_of_decisions_for_case WHERE decision_content IS NOT NULL AND parcel_case_id = ";
	$rows = modHelloSlavaHelper::getSQLQuery01( $data, $base_sql );

	$result = "";
	if( !$rows ) {
		$result = "</br>Tramite aun sin deciciones</br>";;
	}
	// Retrieve each value in the ObjectList 
 	foreach( $rows as $row ) { 
		$result .= "</br>";
		$result .= "Tramite (Case ID): " . $row->parcel_case_id . ", ";
		$result .= "Tramite iniciado: " . $row->open_date_time . ", ";
		$result .= "Decisión: " . $row->decision_content . ", ";
		$result .= "Estatus de decición: " . $row->decision_status . ", ";
		$result .= "Fecha de decición: " . $row->decision_modification_date_time . ", ";
		$result .= "Ejecutivo: " . $row->officer_name . ", ";
		$result .= "Organismo: " . $row->officer_affiliation . ", ";
		$result .= "</br>";
	 } 

	return 'Resultados de consulta por medio de Ajax: ' . $result;
    }

}
?>