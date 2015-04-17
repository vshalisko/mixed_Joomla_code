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
// print_r("<pre>");
// print_r($dataGeneral->user_info->string);  // for debugging
// print_r("</pre>");

$user_full_name = $dataGeneral->user_info->rows[0]->person_name;
$user_curp = $dataGeneral->user_info->rows[0]->person_curp;
?>

<?php
$personal_data_form_flag = 0;

if (isset($user_full_name)) {
	// welcome user
	echo '<h4>Bienvenidos ';
	echo $user_full_name;
	echo '!</h4>';
	if (isset($user_curp)) {
		echo '<div class="span6">CURP: ';
		echo $user_curp;
		echo ', e-mail: ';
		echo $dataGeneral->person_email;
		echo '</div><div class="span3 ofset1">';
		echo '<a href="index.php/9-sistema-de-tramite/12-datos-del-promotor-de-tramite"><i class="icon-pencil"></i> <small>[editar los datos personales]</small></a>';
		echo '</div>';
	} else {
		// no CURP
		echo '<h4 class="text-warning">CURP no registrado. Para continuar trabajo con sistema se requiere capturar su CURP.</h4>';
		$personal_data_form_flag = 1;
	}
} else {
	// no user full name
	echo '<h4 class="text-warning">Para continuar trabajo con sistema se requiere capturar su nombre completo y CURP.</h4>';
	$personal_data_form_flag = 1;
}
?>

<?php 
if (1 == $personal_data_form_flag) {
	echo '<div class="span10 offset1">';
	echo '<form action="index.php/9-sistema-de-tramite/12-datos-del-promotor-de-tramite" method="post">';
	echo '<button type="submit" class="btn btn-large btn-block btn-primary" type="button">Capturar los datos personales</button>';
	echo '</form>';
	echo '</div><p style="padding-bottom: 50px;">&nbsp;</p>';
}
?>


