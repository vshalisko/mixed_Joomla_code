<?php
/**
 * Template for Hello Slava! module
 * @package		mod_slava_1
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die('Restricted access'); 

$docs = <<<DOCS

<div>
<label for="docRequired1" class="docRequired1" style="display: none;">Documento requerido 1</label>
<input type="text" name="docRequired1" id="docRequired1" style="display: none;" />
</div>

DOCS;

echo '<div id="hidden_docs">';
echo $docs;
echo '</div>';

?>