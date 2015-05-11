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


<?php
// get module mode defined in parameters
$my_module_mode = $params->get('modulemode');

// Initialization of the global document object
$doc = JFactory::getDocument();


if ('LMDF'== $my_module_mode) {
// the option of dynamic form generation
	require JModuleHelper::getLayoutPath('mod_slava_1', 'javascripttree');
	require JModuleHelper::getLayoutPath('mod_slava_1', 'javascriptmodules');
	// Initialization of the hidden dynamic form HTML
	echo '</br><div id="lmdfDataTest"></div><input type="hidden" id="lmdfJSONoutside" value=""></br>';
        require JModuleHelper::getLayoutPath('mod_slava_1', 'lmdf');
	// Jamascript initial visualization of the form
	echo '<script type="text/javascript">lmdfInit();</script>';
}
if ('AJAX1'== $my_module_mode ) {
// the option of ajax-style output
	require JModuleHelper::getLayoutPath('mod_slava_1', 'javascriptajax');
	echo '<p>(Map parcel ID)</p>';
	echo '<form><input type="text" class="input-mini" name="ajax1data" /></br>';
	echo '<input type="button" class="input-mini" name="ajax1button" id="ajax1button" value="Consultar" /></form>';
	echo '<p><div class="ajax1result"></div></p>';
}
if ('AJAX2'== $my_module_mode ) {
// the option of ajax-style output
	require JModuleHelper::getLayoutPath('mod_slava_1', 'javascriptajax1');
}



?>

</div>



<?php 

// Las formas dinámicas (generador de forma con arbol de deciciones)

// El generador de forma dinámica funciona enteramente a nivel de cliente por medio de jQuery.
// Los elementos de forma se habilitan al analizar de los datos introducidos. Todos los elementos estan predefinidos en ldmf.php,
// pero se encuentran ocultos (con el atributo CSS). El comportamiento y dependencias entre los elementos se establecen en la estructura JSON 
// en la parte inicial del script. Los datos introducidos por el usuario son persistentes y se almacenan en la misma estructura JSON. La cadena 
// XML para almacenamiento en la base de datos se forma por medio de mismo mecanismo de arbol de decición que la farma, entonces, 
// los elementos desabilitados tampoco aparecen en XML, aunque sus datos quedan almacenados en JSON y en caso de quedar habilitados en algun 
// momento aparecn intactos en la forma y en XML.


?>



