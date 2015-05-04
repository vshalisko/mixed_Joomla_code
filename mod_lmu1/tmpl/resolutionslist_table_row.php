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
<td><?php echo $row->decision_content ?></td>
<td><?php echo $row->decision_status ?></td>
<td><?php echo $row->decision_modification_date_time ?></td>
<td>
<?php 
if (isset($row->officer_id) && $row->officer_id == 1) {
        // the officer_id = 1 means that this is automatic decicions
	echo 'sistema/robot';
} else {
	echo 'ejecutivo';
}
?> 
</td>
</tr>