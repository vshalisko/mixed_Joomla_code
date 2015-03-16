<?php 
/**
 * @package		layout helper alerts for mod_qlform Mareike Riegel
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;
// echo "This is my alerts";

if (isset($warning)) {
	echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button>';
	echo '<h4>Aviso:</h4>';
	echo $warning;
	echo '</div>';
	// JFactory::getApplication()->enqueueMessage(JText::_($warning), 'warning');
}
?>