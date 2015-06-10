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
if (isset($dataGeneral->case_list) && count($dataGeneral->case_list->rows) > 0) {
	// echo '<pre>' . $dataGeneral->case_list->string . '</pre>';		// for debugging
	echo '<table class="table table-hover">';
	echo '<thead><tr><th class="span2">Folio</th><th class="span3">Tipo de tramite</th>';
	echo '<th class="span1">Rol del solicitante</th><th class="span2">Fecha de inicio</th>';
	echo '<th class="span2">Estatus</th>';
	echo '<th class="span1">Anexos</th><th class="span1"></th></tr></thead><tbody>';
 	foreach( $dataGeneral->case_list->rows as $row ) { 
		require JModuleHelper::getLayoutPath('mod_lmu1', 'caselist_table_row');
	 } 
	echo '</tbody></table>';
} else {
	echo '<h4>No hay tramites iniciados por el usuario</h4>';
}


?>

