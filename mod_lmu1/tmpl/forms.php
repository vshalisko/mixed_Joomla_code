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
ID: <?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>, folio provisional: <?php echo $dataGeneral->case_new_id->rows[0]->system_case_identifier ?>

<input type="hidden" id="lmdfJSONoutside" value="<?php echo $dataGeneral->case_new_id->rows[0]->case_properties_json ?>">

<?php
echo '<div><fieldset class="lmdfSelector0"><legend>Anexar documentos (formatos de archivos PDF e imagenes gráficos)</legend>';
require JModuleHelper::getLayoutPath('mod_slava_1', 'javascripttree');  // se carga arbol de decición de otro modulo
require JModuleHelper::getLayoutPath('mod_lmu1', 'docs');  // se cargan formas de documentos
require JModuleHelper::getLayoutPath('mod_slava_1', 'javascriptdocs');  // se carga componente de parser de documentos requeridos
// The initial visualization of the document list
echo '<script type="text/javascript">docInit();</script>';
echo '<br /></fieldset></div>';

// submit case button (should be disabled before all required documentas were attached)
echo '<div class="span12">';
echo '<form action="tramite" method="post">';
echo '<input type="hidden" id="parcel_case_id" name="parcel_case_id" value="'. $dataGeneral->case_new_id->rows[0]->parcel_case_id .'" />';
echo '<input type="hidden" id="case_submit" name="npf_submit" value="1" />';
echo '<button type="submit" class="btn btn-primary btn-large hasTooltip" type="button" title="Someter tramite para revisión por un ejecutivo" data-placement="right">Someter tramite</button>';
echo '</form>';
?>
