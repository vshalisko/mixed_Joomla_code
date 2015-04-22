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
<p><span class="badge">2</span><span> Selecciona el tipo de servicio:</span></p>
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
	<input type="radio" name="lmdfSelector0" id="lmdfSelector0" value="Grupo 4 Alineamiento" /> Realizar el tramite de alineamiento, designación del número oficial o inspección de valor
</label>
</div>
</fieldset>

<br />

<label for="lmdfSelector1" class="lmdfSelector1" style="display: none;">Selleciona el tipo de licencia a tramitar de la lista:</label>
<select name="lmdfSelector1" id="lmdfSelector1" class="input-xxlarge" style="display: none;">
	<option>Elige el tipo de licencia</option>
	<option value="Tramite 1 LConstruccionInmueble">Licencia para construcción de inmuebles</option>
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
	<option>Elige el tipo de tramite</option>
	<option value="Tramite 16 Alineamiento">Alineamiento</option>
	<option value="Tramite 17 DesignacionNumero">Designación del número oficial</option>
	<option value="Tramite 18 Inspeccion">Inspección de inmueble para verificación de su valor</option>
	<option value="Tramite 19 TNoPrevisto">Tramite similar de tipo no previsto</option>
</select>

<br />

<p><span class="badge">3</span> Llena los campos requeridos:</p>

<fieldset class="lmdfInputS0" style="display: none;">
	<legend class="lmdfInputS0" style="display: none;">Introduce los datos adicionales sobre solicitante</legend>

	<div class="row-fluid">
		<div class="span2">
			<label for="lmdfInputS0" class="lmdfInputS0" style="display: none;">Giro comercial</sup>
			<input type="checkbox" name="lmdfInputS0" id="lmdfInputS0" style="display: none;" />
			</label>
		</div>
		<div class="span10">
			<label for="lmdfInputS1" class="lmdfInputS1" style="display: none;">Razón social</label>
			<input type="text" name="lmdfInputS1" id="lmdfInputS1" class="input-xxlarge" style="display: none;" />
		</div>
	</div>

	<label for="lmdfInputS8" class="lmdfInputS8" style="display: none;">Tipo de giro comercial</label>
	<input type="text" name="lmdfInputS8" id="lmdfInputS8" class="input-xlarge" style="display: none;" />

	<label for="lmdfInputS2" class="lmdfInputS2" style="display: none;">Domicilio</label>
	<textarea type="textarea" name="lmdfInputS2" id="lmdfInputS2" class="input-xlarge" style="display: none;" ></textarea>

	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputS3" class="lmdfInputS3" style="display: none;">Colonia</label>
			<input type="text" name="lmdfInputS3" id="lmdfInputS3" class="input-xlarge" style="display: none;" />
                </div>
		<div class="span8">
			<label for="lmdfInputS4" class="lmdfInputS4" style="display: none;">Código postal</label>
			<input type="text" name="lmdfInputS4" id="lmdfInputS4" class="input-mini" style="display: none;" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputS5" class="lmdfInputS5" style="display: none;">Ciudad</label>
			<input type="text" name="lmdfInputS5" id="lmdfInputS5" class="input-xlarge" style="display: none;" />
                </div>
		<div class="span8">
			<label for="lmdfInputS6" class="lmdfInputS6" style="display: none;">Estado</label>
			<input type="text" name="lmdfInputS6" id="lmdfInputS6" class="input-xlarge" style="display: none;" />
		</div>
	</div>

		<label for="lmdfInputS7" class="lmdfInputS7" style="display: none;">Teléfono de contacto</label>
		<input type="text" name="lmdfInputS7" id="lmdfInputS7" class="input-large" style="display: none;" />

</fieldset>

<fieldset class="lmdfInputP1" style="display: none;">
	<legend class="lmdfInputP1" style="display: none;">Introduce los datos sobre ubicación del predio en forma textual</legend>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputP1" class="lmdfInputP1" style="display: none;">Calle</label>
			<input type="text" name="lmdfInputP1" id="lmdfInputP1" class="input-xlarge" style="display: none;" />
		</div>
		<div class="span8">
			<label for="lmdfInputP2" class="lmdfInputP2" style="display: none;">Número oficial</label>
			<input type="text" name="lmdfInputP2" id="lmdfInputP2" class="input-mini" style="display: none;" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputP4" class="lmdfInputP4" style="display: none;">Entre la calle</label>
			<input type="text" name="lmdfInputP4" id="lmdfInputP4" class="input-xlarge" style="display: none;" />
                </div>
		<div class="span8">
			<label for="lmdfInputP5" class="lmdfInputP5" style="display: none;">y calle</label>
			<input type="text" name="lmdfInputP5" id="lmdfInputP5" class="input-xlarge" style="display: none;" />
		</div>
	</div>
	<label for="lmdfInputP3" class="lmdfInputP3" style="display: none;">Colonia</label>
	<input type="text" name="lmdfInputP3" id="lmdfInputP3" class="input-xlarge" style="display: none;" />
</fieldset>

<fieldset class="lmdfInputP6" style="display: none;">
	<legend class="lmdfInputP6" style="display: none;">Especifica la superficie del predio</legend>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputP6" class="lmdfInputP6" style="display: none;">Superficie del predio mayor que 50 m<sup>2</sup>
			<input type="checkbox" name="lmdfInputP6" id="lmdfInputP6" style="display: none;" />
			</label>
                </div>
		<div class="span8">
			<label for="lmdfInputP7" class="lmdfInputP7" style="display: none;">Introduce la superficie del predio en m<sup>2</sup></label>
			<input type="text" name="lmdfInputP7" id="lmdfInputP7" class="input-mini" style="display: none;" />
		</div>
	</div>
</fieldset>

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

<fieldset class="lmdfInputC1" style="display: none;">
	<legend class="lmdfInputC1" style="display: none;">Comentario</legend>
	<label for="lmdfInputC1" class="lmdfInputC1" style="display: none;">Comentario del solicitante sobre contenido de tramite</label>
	<textarea type="textarea" class="input-xxlarge" name="lmdfInputC1" id="lmdfInputC1" style="display: none;" rows="10" cols="30"></textarea>
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