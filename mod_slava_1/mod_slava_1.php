<?php
/**
 * Entry point for Hello Slava! module
 * @package		mod_slava_1
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
 
$databaseuser = $params->get('databaseexternaluser');

// Include the syndicate functions only once
require_once(dirname(__FILE__) . '/helper.php');

// Instantiate global document object
$doc = JFactory::getDocument();

// Ajax related JavaScript code, note the module name in request options
$js = <<<JS
(function ($) {
	$(document).on('click', 'input[name=slavabutton]', function () {
		var value   = $('input[name=slavadata]').val(),
			request = {
					'option' : 'com_ajax',
					'module' : 'slava_1',
					'data'   :  value,
					'format' : 'debug'
				};
		$.ajax({
			type   : 'POST',
			data   : request,
			success: function (response) {
				$('.slavastatus').html(response);
			}
		});
		return false;
	});
})(jQuery)
JS;

$doc->addScriptDeclaration($js);

// Main module body generates initial module output (without Ajax requests)
$hello = modHelloSlavaHelper::getHello();
$sql_query_result = modHelloSlavaHelper::requestCasesTable( '%', $params );

require(JModuleHelper::getLayoutPath('mod_slava_1'));
?>