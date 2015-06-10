<?php
/**
 * Entry point for LMU module
 * @package		mod_lmu1
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined('_JEXEC' ) or die('Restricted access');
error_reporting( E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING );
JHtml::_('jquery.framework');

// Instantiate global document object
$dataGeneral=new stdClass;
$doc = JFactory::getDocument();
$joomla_user = JFactory::getUser();

if (isset($_GET)) foreach ($_GET as $k=>$v): 
	$dataGeneral->post->$k=$v;
endforeach;
if (isset($_POST)) foreach ($_POST as $k=>$v): 
	$dataGeneral->post->$k=$v;
endforeach;


// Include the syndicate functions only once
require_once(dirname(__FILE__) . '/helper.php');
// require_once(dirname(__FILE__) . '/javascriptmodules.php');

if (!$joomla_user->guest) {
	// user logged in
	$dataGeneral->person_login = $joomla_user->username;
	$dataGeneral->person_name = $joomla_user->name;
	$dataGeneral->person_email = $joomla_user->email;
	$dataGeneral->user_info = modLMUHelper::requestUserInfo( $dataGeneral->person_login );
	if (isset($dataGeneral->user_info->rows[0]->person_id)) {
		$dataGeneral->case_list = modLMUHelper::requestCasesTable( $dataGeneral->user_info->rows[0]->person_id );
	}
	if (isset($dataGeneral->post->parcel_case_id) && isset($dataGeneral->user_info->rows[0]->person_id)) {
		// there is case_id present and valid user
		// request and output case details
		$dataGeneral->case_details = modLMUHelper::requestCaseDetails( $dataGeneral->user_info->rows[0]->person_id, $dataGeneral->post->parcel_case_id );
		$dataGeneral->resolutions_list = modLMUHelper::requestResolutionsTable( $dataGeneral->post->parcel_case_id );
	}
	if (isset($dataGeneral->post->npf) && isset($dataGeneral->user_info->rows[0]->person_id)) {
		// the new record was added to table, that means we should pass to recover last inserted ID for this user an render "step 3"
		$dataGeneral->case_step3 = 1;
                $dataGeneral->case_new_id = modLMUHelper::requestCaseLastID( $dataGeneral->user_info->rows[0]->person_id );
	}
	if (isset($dataGeneral->post->npf_submit) && isset($dataGeneral->user_info->rows[0]->person_id) &&
		isset($dataGeneral->post->parcel_case_id)) {
		// Submit "step 3" confirmation page, i.e. "step 4"
		modLMUHelper::submitNewCaseForResolution($dataGeneral->post->parcel_case_id);
		$dataGeneral->case_step4 = 1;
	}


}

require(JModuleHelper::getLayoutPath('mod_lmu1'));
?>