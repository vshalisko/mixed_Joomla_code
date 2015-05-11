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


<?php 
if (isset($dataGeneral->resolutions_list) && count($dataGeneral->resolutions_list->rows) > 0) {
	// echo '<pre>' . $dataGeneral->resolutions_list->string . '</pre>';		// for debugging
	echo '<h4>Lista de resoluciones/dictamenes sobre el tramite</h4>';	
	echo '<table class="table table-hover">';
	echo '<thead><tr><th class="span6">Resolución/Dictamen</th><th class="span1">Tipo</th><th class="span1">Estatus</th><th class="span2">Fecha</th><th class="span2">Origen</th></tr></thead><tbody>';
 	foreach( $dataGeneral->resolutions_list->rows as $row ) { 
		require JModuleHelper::getLayoutPath('mod_lmu1', 'resolutionslist_table_row');
	 } 
	echo '</tbody></table>';
} else {
	echo '<h4>No hay resoluciones sobre el tramite</h4>';
}


?>

