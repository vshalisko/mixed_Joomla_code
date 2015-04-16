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
JHtml::_('jquery.framework');

// Instantiate global document object
$dataGeneral=new stdClass;
$doc = JFactory::getDocument();
$joomla_user = JFactory::getUser();

// Include the syndicate functions only once
require_once(dirname(__FILE__) . '/helper.php');
require_once(dirname(__FILE__) . '/javascriptmodules.php');

// Main module body generates initial module output (without Ajax requests)
// $hello = modLMUHelper::getHello();

if (!$joomla_user->guest) {
	// user logged in
	$dataGeneral->person_login = $joomla_user->username;
	$dataGeneral->person_name = $joomla_user->name;
	$dataGeneral->person_email = $joomla_user->email;
	$dataGeneral->user_info = modLMUHelper::requestUserInfo( $dataGeneral->person_login );
	$dataGeneral->case_list = modLMUHelper::requestCasesTable( '17' );
}

require(JModuleHelper::getLayoutPath('mod_lmu1'));
?>