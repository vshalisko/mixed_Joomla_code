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

$form = <<<FORM

<div>
<fieldset class="lmdfSelector0">
 
	<legend class="lmdfSelector0" style="display: none;"><span class="badge">2</span> Selecciona el grupo de tramites</legend>
	<div class="radio hasTooltip" data-placement="left" title="Elige una de 4 opciones">
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

<!--new selector of licencia type-->
<fieldset class="lmdfInputL0" style="display: none;">
	<legend class="lmdfInputL0" style="display: none;">Selecciona el tipo de licenciqa a tramitar</legend>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputL1" class="lmdfInputL1" style="display: none;">Licencia para construcción de inmuebles</sup>
			<input type="checkbox" name="lmdfInputL1" id="lmdfInputL1" style="display: none;" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputL8" class="lmdfInputL8" style="display: none;">Licencia para remodelación o restauración</sup>
			<input type="checkbox" name="lmdfInputL8" id="lmdfInputL8" style="display: none;" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputL9" class="lmdfInputL9" style="display: none;">Licencia para reconstrucción, reestructuración o adaptación</sup>
			<input type="checkbox" name="lmdfInputL9" id="lmdfInputL9" style="display: none;" />
			</label>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputL13" class="lmdfInputL13" style="display: none;">Licencia provisional de construcción</sup>
			<input type="checkbox" name="lmdfInputL13" id="lmdfInputL13" style="display: none;" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputL3" class="lmdfInputL3" style="display: none;">Licencia para construcción de canchas y áreas deportivas</sup>
			<input type="checkbox" name="lmdfInputL3" id="lmdfInputL3" style="display: none;" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputL2" class="lmdfInputL2" style="display: none;">Licencia para construcción de albercas</sup>
			<input type="checkbox" name="lmdfInputL2" id="lmdfInputL2" style="display: none;" />
			</label>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputL6" class="lmdfInputL6" style="display: none;">Licencia para acotamiento</sup>
			<input type="checkbox" name="lmdfInputL6" id="lmdfInputL6" style="display: none;" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputL4" class="lmdfInputL4" style="display: none;">Licencia para construcción de estacionamientos para usos no habitacionales</sup>
			<input type="checkbox" name="lmdfInputL4" id="lmdfInputL4" style="display: none;" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputL11" class="lmdfInputL11" style="display: none;">Licencia para ocupación de la vía pública por puestos, carpas, módulos, etcétera provisionales</sup>
			<input type="checkbox" name="lmdfInputL11" id="lmdfInputL11" style="display: none;" />
			</label>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputL5" class="lmdfInputL5" style="display: none;">Licencia para demolición</sup>
			<input type="checkbox" name="lmdfInputL5" id="lmdfInputL5" style="display: none;" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputL7" class="lmdfInputL7" style="display: none;">Licencia para instalar tapiales provisionales en la vía pública</sup>
			<input type="checkbox" name="lmdfInputL7" id="lmdfInputL7" style="display: none;" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputL10" class="lmdfInputL10" style="display: none;">Licencia para ocupación de la vía pública con materiales de construcción</sup>
			<input type="checkbox" name="lmdfInputL10" id="lmdfInputL10" style="display: none;" />
			</label>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputL12" class="lmdfInputL12" style="display: none;">Licencia para movimientos de tierra</sup>
			<input type="checkbox" name="lmdfInputL12" id="lmdfInputL12" style="display: none;" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputL14" class="lmdfInputL14" style="display: none;">Licencia para construcción de plataformas, patios de maniobra y rampas</sup>
			<input type="checkbox" name="lmdfInputL14" id="lmdfInputL14" style="display: none;" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputL15" class="lmdfInputL15" style="display: none;">Licencia similar de tipo no previsto</sup>
			<input type="checkbox" name="lmdfInputL15" id="lmdfInputL15" style="display: none;" />
			</label>
		</div>
	</div>
</fieldset>
<br />

<!--new selector for the group 4-->
<fieldset class="lmdfSelector2">
	<legend class="lmdfSelector2" style="display: none;">Selecciona le tipo de tramite</legend>
	<div class="radio hasTooltip" data-placement="left" title="Elige una de 4 opciones">
	<label class="lmdfSelector0">
		<input type="radio" name="lmdfSelector2" id="lmdfSelector2" value="Alineamiento" /> Tramitar de alineamiento
	</label>
	<label class="lmdfSelector0">
		<input type="radio" name="lmdfSelector2" id="lmdfSelector2" value="Número oficial" /> Designación del número oficial
	</label>
	<label class="lmdfSelector0">
		<input type="radio" name="lmdfSelector2" id="lmdfSelector2" value="Inspección" /> Inspección de inmueble para verificación de su valor
	</label>
	<label class="lmdfSelector0">
		<input type="radio" name="lmdfSelector2" id="lmdfSelector2" value="Otro" /> Tramite similar de tipo no previsto
	</label>
	</div>
</fieldset>
<br />

<fieldset class="lmdfInputS" style="display: none;">
	<legend class="lmdfInputS" style="display: none;"><span class="badge">3</span> Llena los campos requeridos</legend>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputD0" class="lmdfInputD0" style="display: none;">Predio ya cuenta con dictamen de usos y destinos</sup>
			<input type="checkbox" name="lmdfInputD0" id="lmdfInputD0" style="display: none;" class="hasTooltip" title="Selecciona casillla en caso que existe un dictamen previamente emitido" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputD1" class="lmdfInputD1" style="display: none;">Número oficial del dictamen de usos y destinos</label>
			<input type="text" name="lmdfInputD1" id="lmdfInputD1" class="input-large" style="display: none;" />
		</div>
		<div class="span4">
			<label for="lmdfInputD2" class="lmdfInputD2" style="display: none;">Fecha de emisión del dictamen de usos y destinos</label>
			<input type="text" name="lmdfInputD2" id="lmdfInputD2" class="input-large" style="display: none;" />
		</div>
	</div>
</fieldset>


<!-- Datos del predio -->
<fieldset class="lmdfInputP1" style="display: none;">
	<legend class="lmdfInputP1" style="display: none;">Introduce los datos sobre ubicación del predio</legend>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputP1" class="lmdfInputP1" style="display: none;">Calle</label>
			<input type="text" name="lmdfInputP1" id="lmdfInputP1" class="input-xlarge" style="display: none;" />
		</div>
		<div class="span6">
			<label for="lmdfInputP2" class="lmdfInputP2" style="display: none;">Número oficial</label>
			<input type="text" name="lmdfInputP2" id="lmdfInputP2" class="input-mini" style="display: none;" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputP4" class="lmdfInputP4" style="display: none;">Entre la calle</label>
			<input type="text" name="lmdfInputP4" id="lmdfInputP4" class="input-xlarge" style="display: none;" />
                </div>
		<div class="span6">
			<label for="lmdfInputP5" class="lmdfInputP5" style="display: none;">y calle</label>
			<input type="text" name="lmdfInputP5" id="lmdfInputP5" class="input-xlarge" style="display: none;" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputP3" class="lmdfInputP3" style="display: none;">Colonia</label>
			<input type="text" name="lmdfInputP3" id="lmdfInputP3" class="input-xlarge" style="display: none;" />
		</div>
		<div class="span6">
			&nbsp;
		</div>
	</div>
</fieldset>

<fieldset class="lmdfInputP6" style="display: none;">
	<legend class="lmdfInputP6" style="display: none;">Especifica la superficie del predio</legend>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputP6" class="lmdfInputP6" style="display: none;">Superficie del predio mayor que 50 m<sup>2</sup>
			<input type="checkbox" name="lmdfInputP6" id="lmdfInputP6" style="display: none;" class="hasTooltip" title="Selecciona casilla en caso que predio es mayór que 50 m" />
			</label>
                </div>
		<div class="span8">
			<label for="lmdfInputP7" class="lmdfInputP7" style="display: none;">Introduce la superficie del predio en m<sup>2</sup></label>
			<input type="text" name="lmdfInputP7" id="lmdfInputP7" class="input-mini hasTooltip" data-placement="right" style="display: none;" title="Superficie para los predios mayores que 50 m" />
		</div>
	</div>
</fieldset>

<!-- Datos sobre solicitante -->
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
			<input type="text" name="lmdfInputS1" id="lmdfInputS1" class="span10" style="display: none;" placeholder="escribe nombre completo de la persona moral" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span2">
			&nbsp;
		</div>
		<div class="span10">
			<label for="lmdfInputS8" class="lmdfInputS8" style="display: none;">Tipo de giro comercial</label>
			<input type="text" name="lmdfInputS8" id="lmdfInputS8" class="span10" style="display: none;" placeholder="describe la actividad comercial" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<label for="lmdfInputS2" class="lmdfInputS2" style="display: none;">Domicilio del solicitante</label>
			<textarea type="textarea" name="lmdfInputS2" id="lmdfInputS2" class="input-xxlarge" style="display: none;" ></textarea>
		</div>
	</div>


	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputS3" class="lmdfInputS3" style="display: none;">Colonia</label>
			<input type="text" name="lmdfInputS3" id="lmdfInputS3" class="input-xlarge" style="display: none;" />
                </div>
		<div class="span6">
			<label for="lmdfInputS4" class="lmdfInputS4" style="display: none;">Código postal</label>
			<input type="text" name="lmdfInputS4" id="lmdfInputS4" class="input-mini" style="display: none;" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputS5" class="lmdfInputS5" style="display: none;">Ciudad</label>
			<input type="text" name="lmdfInputS5" id="lmdfInputS5" class="input-xlarge" style="display: none;" />
                </div>
		<div class="span6">
			<label for="lmdfInputS6" class="lmdfInputS6" style="display: none;">Estado</label>
			<input type="text" name="lmdfInputS6" id="lmdfInputS6" class="input-xlarge" style="display: none;" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<label for="lmdfInputS7" class="lmdfInputS7" style="display: none;">Teléfono de contacto</label>
			<input type="text" name="lmdfInputS7" id="lmdfInputS7" class="input-xlarge" style="display: none;" />
		</div>
	</div>
</fieldset>

<!-- Datos sobre propietario -->
<fieldset class="lmdfInputPR0" style="display: none;">
	<legend class="lmdfInputPR0" style="display: none;">Introduce los datos adicionales sobre el propietario</legend>
	<div class="row-fluid">
		<div class="span2">
			<label for="lmdfInputPR0" class="lmdfInputPR0" style="display: none;">Propietario es distinto del solicitante</sup>
			<input type="checkbox" name="lmdfInputPR0" id="lmdfInputPR0" style="display: none;" class="hasTooltip" title="Casilla queda seleccionada en caso que propietario es distinto del solicitante" />
			</label>
		</div>
		<div class="span10">
			<label for="lmdfInputPR1" class="lmdfInputPR1" style="display: none;">Nombre completo del propietario</label>
			<input type="text" name="lmdfInputPR1" id="lmdfInputPR1" class="span10" style="display: none;" placeholder="escribe nombre completo del propietario tal como aparece en la identificación oficial" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<label for="lmdfInputPR2" class="lmdfInputPR2" style="display: none;">Domicilio del propietario</label>
			<textarea type="textarea" name="lmdfInputPR2" id="lmdfInputPR2" class="input-xxlarge" style="display: none;" ></textarea>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputPR3" class="lmdfInputPR3" style="display: none;">Colonia</label>
			<input type="text" name="lmdfInputPR3" id="lmdfInputPR3" class="input-xlarge" style="display: none;" />
                </div>
		<div class="span6">
			<label for="lmdfInputPR4" class="lmdfInputPR4" style="display: none;">Código postal</label>
			<input type="text" name="lmdfInputPR4" id="lmdfInputPR4" class="input-mini" style="display: none;" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputPR5" class="lmdfInputPR5" style="display: none;">Ciudad</label>
			<input type="text" name="lmdfInputPR5" id="lmdfInputPR5" class="input-xlarge" style="display: none;" />
                </div>
		<div class="span6">
			<label for="lmdfInputPR6" class="lmdfInputPR6" style="display: none;">Estado</label>
			<input type="text" name="lmdfInputPR6" id="lmdfInputPR6" class="input-xlarge" style="display: none;" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputPR7" class="lmdfInputPR7" style="display: none;">Teléfono de contacto</label>
			<input type="text" name="lmdfInputPR7" id="lmdfInputPR7" class="input-xlarge" style="display: none;" />
		</div>
		<div class="span6">
			<label for="lmdfInputPR8" class="lmdfInputPR8" style="display: none;">Dirección del correo electrónico</label>
			<input type="text" name="lmdfInputPR8" id="lmdfInputPR8" class="input-xlarge" style="display: none;" />
		</div>
	</div>
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