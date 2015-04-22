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

<h3>Nuevo tramite: Paso 3 - anexar los documentos y someter el tramite</h3>
(id <?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>, folio <?php echo $dataGeneral->case_new_id->rows[0]->official_case_identifier ?>)
<?php
require JModuleHelper::getLayoutPath('mod_slava_1', 'javascripttree');  // se carga arbol de decición de otro modulo
?>
