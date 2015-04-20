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

// Instantiate global document object

$form = <<<FORM

<div>

<fieldset class="lmdfSelector0">
<div class="radio">
<label class="lmdfSelector0">
	<input type="radio" name="lmdfSelector0" id="lmdfSelector0" value="Grupo 1" /> Tramitar Dictamen de Uso de Suelo
</label>
<label class="lmdfSelector0">
	<input type="radio" name="lmdfSelector0" id="lmdfSelector0" value="Grupo 2" /> Tramitar Licencia de Construcción
</label>
</div>
<span class="badge">1</span>
</fieldset>

<br />

<div class="control-group">
<label for="lmdfInput0" class="lmdfInput0">Primer campo</label>
<input type="text" name="lmdfInput0" id="lmdfInput0" class="input-xxlarge" placeholder="escribe texto aquí" /><span class="badge">2</span>
</div>

<br />

<label for="lmdfSelector1" class="lmdfSelector1" style="display: none;">Etiqueta para el selector de tramite de Dictamen</label>
<select name="lmdfSelector1" id="lmdfSelector1" style="display: none;">
	<option>Elige el tramite de Dictamen</option>
	<option value="Tramite 1">Tramite 1</option>
	<option value="Tramite 2">Tramite 2</option>
	<option value="Tramite 3">Tramite 3</option>
	<option value="Tramite 4">Tramite 4</option>
</select>

<label for="lmdfSelector2" class="lmdfSelector2" style="display: none;">Etiqueta para el selector de teamite de Licencia</label>
<select name="lmdfSelector2" id="lmdfSelector2" style="display: none;">
	<option>Elige el tramite de Licencia</option>
	<option value="Tramite 5">Tramite 5</option>
	<option value="Tramite 6">Tramite 6</option>
	<option value="Tramite 7">Tramite 7</option>
	<option value="Tramite 8">Tramite 8</option>
	<option value="Tramite 9">Tramite 9</option>
	<option value="Tramite 10">Tramite 10</option>
</select>

<br />

<label for="lmdfInput2" class="lmdfInput2" style="display: none;">Etiqueta para el campo de entrada 2</label>
<input type="text" name="lmdfInput2" id="lmdfInput2" style="display: none;" />

<fieldset class="lmdfInput3" style="display: none;">
	<legend class="lmdfInput3" style="display: none;">Leyenda para el grupo de elementos 3 y 4</legend>

	<label for="lmdfInput3" class="lmdfInput3" style="display: none;">Etiqueta para el campo de entrada 3</label>
	<input type="text" name="lmdfInput3" id="lmdfInput3" class="input-mini" style="display: none;" />

	<label for="lmdfInput4" class="lmdfInput4" style="display: none;">Etiqueta para el campo de entrada 4</label>
	<input type="text" name="lmdfInput4" id="lmdfInput4" class="input-mini" style="display: none;" />
</fieldset>

<fieldset class="lmdfInput5" style="display: none;">
	<legend class="lmdfInput3" style="display: none;">Leyenda para el grupo de elementos 5</legend>
	<label for="lmdfInput5" class="lmdfInput5" style="display: none;">Etiqueta para el campo de entrada 5</label>
	<textarea type="textarea" name="lmdfInput5" id="lmdfInput5" style="display: none;" rows="10" cols="30"></textarea>
</fieldset>


<br />
</div>

FORM;

echo '<div id="hidden_lmdf" style="display:none;">';
echo $form;
echo '</div>';

echo '<script type="text/javascript">';
// echo 'alert($("#hidden_lmdf").html());';    // debugging
echo '$(".insertion_lmdf").append($("#hidden_lmdf").html());';
echo '</script>';

?>