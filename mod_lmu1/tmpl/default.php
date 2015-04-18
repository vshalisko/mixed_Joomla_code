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
	$case_list_flag = 1;
	echo '<div class="span12">';
	require JModuleHelper::getLayoutPath('mod_lmu1', 'userinfo');
	echo '</div>';
	if (0 == $personal_data_form_flag && isset($dataGeneral->new_case)) { 
		echo '<div class="span12 iteminfo"><span>Iniciar nuevo tramite</span></div><div class="span12">';
		require JModuleHelper::getLayoutPath('mod_lmu1', 'forms');
		echo '</div><p></p>';
		$case_list_flag = 0;
	}
	if (0 == $personal_data_form_flag && isset($dataGeneral->case_details)) { 
		echo '<div class="span12 iteminfo"><span>Detalles del tramite</span></div><div class="span12">';
		require JModuleHelper::getLayoutPath('mod_lmu1', 'case_details');
		echo '</div><p></p>';
		$case_list_flag = 0;
	}
	if (1 == $case_list_flag) {
		// boton de iniciar nuevo tramite
		echo '<div class="span12">';
		echo '<form action="index.php/9-sistema-de-tramite/10-inicio-tramite" method="post">';
		echo '<input type="hidden" id="parcel_map_id" name="parcel_map_id" value="455" />';           // debugging
		echo '<input type="hidden" id="parcel_map_id" name="parcel_map_version_id" value="2" />';     // debugging
		echo '<button type="submit" class="btn btn-primary" type="button">Iniciar nuevo tramite</button>';
		echo '</form>';
		echo 'Paso 1: Seleccionar parcela en mapa; Paso 2: Llenar formulario; Paso 3: Anexar los documentos';
		echo '</div><p style="padding-bottom: 30px;">&nbsp;</p>';
	}
	if (1 == $case_list_flag) {
		// lista de tramites
		echo '<div class="span12 iteminfo"><span>Lista de tramites</span></div><div class="span12">';
		require JModuleHelper::getLayoutPath('mod_lmu1', 'caselist');
		echo '</div><p></p>';
	}

} else {
	echo '<div class="span12">';
	require JModuleHelper::getLayoutPath('mod_lmu1', 'login_required');
	echo '</div><p></p>';
}

?>
</div><br />


<div class="span12 iteminfo">
<span>Elementos obsoletos</span>
</div>
