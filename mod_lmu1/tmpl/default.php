<?php
/**
 * Template for LMU module
 * @package		mod_lmu1
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die('Restricted access'); ?>



<div id="divmodlmu1" name="divmodlmu1">
<h4>
<?php echo $hello;?>
</h4>

<?php
if (isset($dataGeneral->person_login)) {
	echo '<div class="span12">';
	require JModuleHelper::getLayoutPath('mod_lmu1', 'userinfo');
	echo '</div><br />';
	if (isset($dataGeneral->case_list)) {
		echo '<div class="span12">';
		require JModuleHelper::getLayoutPath('mod_lmu1', 'caselist');
		echo '</div><br />';
	} else {
		echo '<div class="span12">';
		print("<h4>No existen los tramites iniciados por el usuario</h4>");
		echo '</div><br />';
	}
	echo '<div class="span12">';
	require JModuleHelper::getLayoutPath('mod_lmu1', 'forms');
	echo '</div><br />';
} else {
	echo '<div class="span12">';
	require JModuleHelper::getLayoutPath('mod_lmu1', 'login_required');
	echo '</div><br />';
}

?>
</div><br />


<div class="span12 iteminfo">
<span>Elementos obsoletos</span>
</div>
