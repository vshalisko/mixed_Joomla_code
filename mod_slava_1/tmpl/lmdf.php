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
<p><span class="badge">2</span><span> Selecciona el tipo de tramite:</span></p>
<div class="radio">
<label class="lmdfSelector0">
	<input type="radio" name="lmdfSelector0" id="lmdfSelector0" value="Grupo 1 Usos" /> Tramitar el dictamen de usos y destinos 
</label>
<label class="lmdfSelector0">
	<input type="radio" name="lmdfSelector0" id="lmdfSelector0" value="Grupo 2 Trazo" /> Tramitar el dictamen de trazo, usos y destinos específicos
</label>
<label class="lmdfSelector0">
	<input type="radio" name="lmdfSelector0" id="lmdfSelector0" value="Grupo 3 Licencia" /> Tramitar la licencia (15 tipos de licencia)
</label>
<label class="lmdfSelector0">
	<input type="radio" name="lmdfSelector0" id="lmdfSelector0" value="Grupo 4 Alineamiento" /> Realizar el tramite de alineamiento y número oficial
</label>
</div>
</fieldset>

<br />

<label for="lmdfSelector1" class="lmdfSelector1" style="display: none;">Selleciona el tipo de licencia a tramitar de la lista:</label>
<select name="lmdfSelector1" id="lmdfSelector1" class="input-xxlarge" style="display: none;">
	<option>Elige el tipo de licencia</option>
	<option value="Tramite 1 LConstruccionInmueble">Licencia para construcción de inmueble</option>
	<option value="Tramite 2 LConstruccionAlberca">Licencia para construcción de albercas</option>
	<option value="Tramite 3 LConstruccionCancha">Licencia para construcción de canchas y áreas deportivas</option>
	<option value="Tramite 4 LConstruccionEstacionamientos">Licencia para construcción de estacionamientos para usos no habitacionales</option>
	<option value="Tramite 14 LConstruccionPlataformas">Licencia para construcción de plataformas, patios de maniobra y rampas</option>
	<option value="Tramite 8 LRemodelacion">Licencia para remodelación o restauración</option>
	<option value="Tramite 9 LReconstruccion">Licencia para reconstrucción, reestructuración o adaptación</option>
	<option value="Tramite 5 LDemolicion">Licencia para demolición</option>
	<option value="Tramite 6 LAcotamiento">Licencia para acotamiento</option>
	<option value="Tramite 7 LTapiales">Licencia para instalar tapiales provisionales en la vía pública</option>
	<option value="Tramite 10 LOcupacionViasMateriales">Licencia para ocupación de la vía pública con materiales de construcción</option>
	<option value="Tramite 11 LOcupacionViasPuestos">Licencia para ocupación de la vía pública por puestos, carpas, módulos, etcétera. provisionales</option>
	<option value="Tramite 12 LMovimientoTierra">Licencia para movimientos de tierra</option>
	<option value="Tramite 13 LConstruccionProvisional">Licencia provisional de construcción</option>
	<option value="Tramite 15 LNoPrevista">Licencia similar de tipo no previsto</option>
</select>

<label for="lmdfSelector2" class="lmdfSelector2" style="display: none;">Seleccione el tipo de tramite de la lista:</label>
<select name="lmdfSelector2" id="lmdfSelector2" sclass="input-xxlarge" tyle="display: none;">
	<option>Elige el tramite de tremite de alineamiento</option>
	<option value="Tramite A">Tramite A</option>
	<option value="Tramite B">Tramite B</option>
	<option value="Tramite C">Tramite C</option>
	<option value="Tramite D">Tramite D</option>
	<option value="Tramite E">Tramite E</option>
	<option value="Tramite F">Tramite F</option>
</select>

<br />

<p><span class="badge">3</span> Llena los campos requeridos:</p>

<div class="control-group">
<label for="lmdfInput0" class="lmdfInput0">Primer campo</label>
<input type="text" name="lmdfInput0" id="lmdfInput0" class="input-xxlarge" placeholder="escribe texto aquí" />
</div>

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