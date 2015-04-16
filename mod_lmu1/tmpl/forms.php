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

<h3>Prueba 3: Las formas dinámicas (generador de forma con arbol de deciciones)</h3>

El generador de forma dinámica funciona enteramente a nivel de cliente por medio de jQuery.
Los elementos de forma se habilitan al analizar de los datos introducidos. Todos los elementos estan predefinidos en ldmf.php,
pero se encuentran ocultos (con el atributo CSS). El comportamiento y dependencias entre los elementos se establecen en la estructura JSON 
en la parte inicial del script. Los datos introducidos por el usuario son persistentes y se almacenan en la misma estructura JSON. La cadena 
XML para almacenamiento en la base de datos se forma por medio de mismo mecanismo de arbol de decición que la farma, entonces, 
los elementos desabilitados tampoco aparecen en XML, aunque sus datos quedan almacenados en JSON y en caso de quedar habilitados en algun 
momento aparecn intactos en la forma y en XML.

<div id="lmdfDataTest"></div>
<input type="hidden" id="lmdfJSONoutside" value="">
</br>

<?php
require JModuleHelper::getLayoutPath('mod_lmu1', 'lmdf');
?>

<pre><div id="lmdfXMLout1">[cadena xml formada debe aparecer aquí]</div></pre>

<script type="text/javascript">
lmdfInit();
</script>


<h3>Generador de formas</h3>
