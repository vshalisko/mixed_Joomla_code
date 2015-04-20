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
<td><a href="index.php/sistema-de-tramite?parcel_case_id=<?php echo $row->parcel_case_id ?>"><?php echo $row->official_case_identifier ?></a></td>
<td><?php echo $row->parcel_id ?></td>
<td><?php echo $row->open_date_time ?></td>
<td><?php echo $row->person_role ?></td>
</tr>