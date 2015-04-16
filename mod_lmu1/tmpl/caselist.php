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


<h3>Lista de tramites del usuario</h3>

<?php 
// print_r("<pre>");
// print_r(print_r($dataGeneral->case_list->string);  // for debugging
// print_r("</pre>");

// $user_full_name = $dataGeneral->user_info->rows[0]->person_name;
echo '<pre>' . $dataGeneral->case_list->string . '</pre>';
?>

