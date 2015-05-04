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

<tr>
<td><a href="index.php/tramite?parcel_case_id=<?php echo $row->case_id ?>">
<small><?php echo $row->system_case_identifier ?></small>
<?php echo $row->official_case_identifier ?>
</a></td>
<td><?php 
// regexp search of information from xml (3 options)
if (preg_match("/<lmdfSelector[0]>(.+?)1(.+?)<\/lmdfSelector[0]>/ui", $row->case_properties_xml, $matches)) { // looking for group 1
	echo 'Dictamen de usos y destinos';
}
if (preg_match("/<lmdfSelector[0]>(.+?)2(.+?)<\/lmdfSelector[0]>/ui", $row->case_properties_xml, $matches)) { // looking for group 1
	echo 'Dictamen de trazo, usos y destinos específicos';
}
if (preg_match("/<lmdfSelector[12]>(.+?)<\/lmdfSelector[12]>/ui", $row->case_properties_xml, $matches)) {
	echo $matches[0];
}
?></td>
<!--<td><?php echo $row->parcel_id ?></td>-->
<td><?php echo $row->open_date_time ?></td>
<td><?php echo $row->person_role ?></td>
<td><!-- Anexos --></td>
<td><?php echo $row->decisions_count ?></td>
<td><!-- Estatus --></td>
</tr>