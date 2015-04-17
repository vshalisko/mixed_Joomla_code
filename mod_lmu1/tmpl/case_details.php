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

<h4>Detalles del tramite <?php echo $dataGeneral->case_list->rows[0]->official_case_identifier ?></h4>

<pre>
Folio de tramite: <?php echo $dataGeneral->case_details->rows[0]->official_case_identifier ?> <br />
ID de tramite: <?php echo $dataGeneral->case_details->rows[0]->case_id ?> <br />
ID de parcela en mapa: <?php echo $dataGeneral->case_details->rows[0]->parcel_id ?>  <br />
Tramites antecesores: <?php echo $dataGeneral->case_details->rows[0]->nested_case_id ?> <br />
Fecha de inicio: <?php echo $dataGeneral->case_details->rows[0]->open_date_time ?> <br />
Rol de solicitante: <?php echo $dataGeneral->case_details->rows[0]->person_role ?> <br />
Nombre de solicitante: <?php echo $dataGeneral->case_details->rows[0]->person_name ?>  <br />
Detelles del predio (XML): <?php echo $dataGeneral->case_details->rows[0]->case_parcel_properties_xml ?>  <br />
Detalles de tramite (XML): <?php echo $dataGeneral->case_details->rows[0]->case_properties_xml ?>  <br />
Número de deciciones: <?php echo $dataGeneral->case_details->rows[0]->decisions_count ?>  <br />
</pre>

<pre>
<?php echo $dataGeneral->case_details->string ?>
</pre>