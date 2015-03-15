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
defined('_JEXEC') or die('Restricted access'); ?>
<div id="divmodslava1" name="divmodslava1">
<h4>
<?php echo $hello;?>
</h4>
<h3>Contenido actual de tabla de tramites</h3>
<pre>
<?php print_r($sql_query_result);?>
</pre>

</br>
<h3>Consulta de resoluciones y dictamenes oara un tramite especifico (introduce código Case ID de la lista)</h3>
<form>
	<input type="text" name="slavadata" />
	<input type="button" name="slavabutton" id="slavabutton" value="Consultar"/>
</form>
<H3><div class="slavastatus">[los resultados de subconsulta deben aparecer aquí]</div></H3>
</div>