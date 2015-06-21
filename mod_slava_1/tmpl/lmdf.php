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

$style = <<<CSS
/**
 * Alignment for the checkbox labels (does not work)
 */
.checkbox {
    vertical-align: middle;
    position: relative;
}

CSS;

$doc->addStyleDeclaration( $style );


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

<!--new selector of licencia type-->
<fieldset class="lmdfInputL0" style="display: none;" >
	<legend class="lmdfInputL0" style="display: none;">Selecciona el tipo de licencia a tramitar</legend>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputL1" class="lmdfInputL1 checkbox" style="display: none;">I. Licencia de construcción, incluye inspección por m<sup>2</sup> de construcción
			<input type="checkbox" name="lmdfInputL1" id="lmdfInputL1" style="display: none;" />
			</label>
		</div>
		<div class="span6">
			<fieldset class="lmdfSelectorL1A">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
				<span class="lmdfSelectorL1A">Opción:</span>
				<label class="lmdfSelectorL1A">
					<input type="radio" name="lmdfSelectorL1A" id="lmdfSelectorL1A" value="A" /> A. Inmuebles de uso habitacional
				</label>
				<label class="lmdfSelectorL1A">
					<input type="radio" name="lmdfSelectorL1A" id="lmdfSelectorL1A" value="B" /> B. Inmuebles de uso no habitacional
				</label>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputL2" class="lmdfInputL2 checkbox" style="display: none;">II. Licencias para construcción de albercas, por metro cúbico de capacidad
			<input type="checkbox" name="lmdfInputL2" id="lmdfInputL2" style="display: none;" />
			</label>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputL3" class="lmdfInputL3 checkbox" style="display: none;">III. Construcciones de canchas y áreas deportivas, por metro cuadrado
			<input type="checkbox" name="lmdfInputL3" id="lmdfInputL3" style="display: none;" />
			</label>
		</div>            	
	</div>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputL4" class="lmdfInputL4 checkbox" style="display: none;">IV. Estacionamientos para usos no habitacionales, por metro cuadrado
			<input type="checkbox" name="lmdfInputL4" id="lmdfInputL4" style="display: none;" />
			</label>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span10">
			<label for="lmdfInputL5" class="lmdfInputL5 checkbox" style="display: none;">V. Licencia para demolición, sobre el importe de los derechos que se determinen de acuerdo a la fracción I, de este artículo
			<input type="checkbox" name="lmdfInputL5" id="lmdfInputL5" style="display: none;" />
			</label>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span10">
			<label for="lmdfInputL6" class="lmdfInputL6 checkbox" style="display: none;">VI. Licencia para acotamiento de predios baldíos, bardado en colindancia y demolición de muros, por metro lineal
			<input type="checkbox" name="lmdfInputL6" id="lmdfInputL6" style="display: none;" />
			</label>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span10">
			<label for="lmdfInputL7" class="lmdfInputL7 checkbox" style="display: none;">VII. Licencia para instalar tapiales provisionales en la vía pública, por metro lineal
			<input type="checkbox" name="lmdfInputL7" id="lmdfInputL7" style="display: none;" />
			</label>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span10">
			<label for="lmdfInputL8" class="lmdfInputL8 checkbox" style="display: none;">VIII. Licencias para remodelación o restauración sobre el importe de los derechos determinados de acuerdo a la fracción I, de este artículo
			<input type="checkbox" name="lmdfInputL8" id="lmdfInputL8" style="display: none;" />
			</label>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span10">
			<label for="lmdfInputL9" class="lmdfInputL9 checkbox" style="display: none;">IX. Licencias para reconstrucción, reestructuración o adaptación, sobre el importe de los derechos determinados de acuerdo con la fracción I, de este artículo en los términos previstos por el Ordenamiento de Construcción
			<input type="checkbox" name="lmdfInputL9" id="lmdfInputL9" style="display: none;" />
			</label>
		</div>
	</div>
 	<div class="row-fluid">
		<div class="span10">
			<label for="lmdfInputL10" class="lmdfInputL10 checkbox" style="display: none;">X. Licencias para ocupación en la vía pública con materiales de construcción, las cuales se otorgarán siempre y cuando se ajusten a los lineamientos señalados por la dirección de obras públicas y desarrollo urbano por metro cuadrado, por día
			<input type="checkbox" name="lmdfInputL10" id="lmdfInputL10" style="display: none;" />
			</label>
		</div>
	</div>
 	<div class="row-fluid">
		<div class="span10">
			<label for="lmdfInputL11" class="lmdfInputL11 checkbox" style="display: none;">XI. Por puestos, carpas, módulos, etcétera. provisionales en la vía pública, por metro cuadrado por día
			<input type="checkbox" name="lmdfInputL11" id="lmdfInputL11" style="display: none;" />
			</label>
		</div>
	</div>
 	<div class="row-fluid">
		<div class="span10">
			<label for="lmdfInputL12" class="lmdfInputL12 checkbox" style="display: none;">XII. Licencias para movimientos de tierra, previo dictamen de la dirección de obras públicas y desarrollo urbano, por metro cúbico
			<input type="checkbox" name="lmdfInputL12" id="lmdfInputL12" style="display: none;" />
			</label>
		</div>
	</div>
 	<div class="row-fluid">
		<div class="span10">
			<label for="lmdfInputL13" class="lmdfInputL13 checkbox" style="display: none;">XIII. Licencias provisionales de construcción, sobre el importe de los derechos que se determinen de acuerdo a la fracción I de este artículo, el 15% adicional, y únicamente en aquellos casos que a juicio de la dependencia municipal de obras públicas pueda otorgarse
			<input type="checkbox" name="lmdfInputL13" id="lmdfInputL13" style="display: none;" />
			</label>
		</div>
	</div>
 	<div class="row-fluid">
		<div class="span10">
			<label for="lmdfInputL14" class="lmdfInputL14 checkbox" style="display: none;">XIV. Plataformas, Patios de Maniobra y Rampas que tengan material consolidado a base de tepetate, asfalto, empedrado o concreto hidraulico
			<input type="checkbox" name="lmdfInputL14" id="lmdfInputL14" style="display: none;" />
			</label>
		</div>
	</div>
 	<div class="row-fluid">
		<div class="span10">
			<label for="lmdfInputL15" class="lmdfInputL15 checkbox" style="display: none;">XV. Licencias similares no previstos en este artículo, por metro cuadrado o fracción
			<input type="checkbox" name="lmdfInputL15" id="lmdfInputL15" style="display: none;" />
			</label>
		</div>
	</div>
</fieldset>

<!--new selector for the group 4-->
<fieldset class="lmdfSelector2" style="display: none;">
	<legend class="lmdfSelector2" style="display: none;">Selecciona el tipo de trámite</legend>
	<div class="row-fluid">
		<div class="span6">
			<div class="radio hasTooltip" data-placement="left" title="Elige una de 4 opciones">
				<label class="lmdfSelector0">
					<input type="radio" name="lmdfSelector2" id="lmdfSelector2" value="Alineamiento" /> I. Alineamiento, por metro lineal según el tipo de construcción
				</label>
				<label class="lmdfSelector0">
					<input type="radio" name="lmdfSelector2" id="lmdfSelector2" value="Número oficial" /> II. Designación de número oficial según el tipo de construcción
				</label>
				<label class="lmdfSelector0">
					<input type="radio" name="lmdfSelector2" id="lmdfSelector2" value="Inspección" /> III. Inspecciones, a solicitud del interesado, sobre el valor que se determine según la tabla de valores de la fracción I, del artículo 45 de esta ley, aplicado a construcciones, de acuerdo con su clasificación y tipo, para verificación de valores sobre inmuebles
				</label>
				<label class="lmdfSelector0">
					<input type="radio" name="lmdfSelector2" id="lmdfSelector2" value="Otro" /> IV. Servicios similares no previstos en este artículo, por m<sup>2</sup>
				</label>
			</div>
		</div>
		<div class="span6">
			<fieldset class="lmdfSelector2A">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
					<span class="lmdfSelector2A">Opción:</span>
					<label class="lmdfSelector2A">
						<input type="radio" name="lmdfSelector2A" id="lmdfSelector2A" value="A" /> A. Inmuebles de uso habitacional
					</label>
					<label class="lmdfSelector2A">
						<input type="radio" name="lmdfSelector2A" id="lmdfSelector2A" value="B" /> B. Inmuebles de uso no habitacional
					</label>
				</div>
			</fieldset>
		</div>
	</div>
</fieldset>

<fieldset class="lmdfInputS" style="display: none;">
	<legend class="lmdfInputS" style="display: none;"><span class="badge">3</span> Llena los campos requeridos</legend>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputD0" class="lmdfInputD0 checkbox" style="display: none;">Predio ya cuenta con dictamen de usos y destinos</sup>
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
<br />
	<div class="row-fluid">
		<div class="span4">
			<fieldset class="lmdfSelectorD3">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
					<span class="lmdfSelectorD3">Especifica escritura o contrato de compra-venta:</span>
					<label class="lmdfSelectorD3">
						<input type="radio" name="lmdfSelectorD3" id="lmdfSelectorD3" value="escritura" /> Escritura
					</label>
					<label class="lmdfSelectorD3">
						<input type="radio" name="lmdfSelectorD3" id="lmdfSelectorD3" value="contrato de compra-venta" /> Contrato de compra-venta
					</label>
				</div>
			</fieldset>
		</div>
		<div class="span4">
			<!-- Opcion escritura -->
			<label for="lmdfInputD3" class="lmdfInputD3" style="display: none;">Número de escritura</label>
			<input type="text" name="lmdfInputD3" id="lmdfInputD3" class="input-large" style="display: none;" />
			<!-- Opcion contrato -->
			<label for="lmdfInputD4" class="lmdfInputD4" style="display: none;">Número de contrato de compra-venta</label>
			<input type="text" name="lmdfInputD4" id="lmdfInputD4" class="input-large" style="display: none;" />
		</div>
		<div class="span4">
			<label for="lmdfInputD5" class="lmdfInputD5" style="display: none;">Fecha de contrato de compra-venta</label>
			<input type="text" name="lmdfInputD5" id="lmdfInputD5" class="input-large" style="display: none;" />
		</div>
	</div>
</fieldset>

<!-- Datos especificos sobre licencias -->
<fieldset class="lmdfInputL20 lmdfSelectorL30 lmdfSelectorL32" style="display: none;">
	<legend class="lmdfInputL20 lmdfSelectorL30 lmdfSelectorL32" style="display: none;">Detalles de licencias</legend>
	<div class="row-fluid">
		<div class="span4">
			<fieldset class="lmdfSelectorL30">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
				<span class="lmdfSelectorL30">Densidad:</span>
				<label class="lmdfSelectorL30">
					<input type="radio" name="lmdfSelectorL30" id="lmdfSelectorL30" value="alta" /> Alta
				</label>
				<label class="lmdfSelectorL30">
					<input type="radio" name="lmdfSelectorL30" id="lmdfSelectorL30" value="media" /> Media
				</label>
				<label class="lmdfSelectorL30">
					<input type="radio" name="lmdfSelectorL30" id="lmdfSelectorL30" value=baja" /> Baja
				</label>
				<label class="lmdfSelectorL30">
					<input type="radio" name="lmdfSelectorL30" id="lmdfSelectorL30" value="minima" /> Mínima
				</label>
				</div>
			</fieldset>
		</div>
		<div class="span4">
			<fieldset class="lmdfSelectorL31">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
				<span class="lmdfSelectorL31">Tipo de vivienda:</span>
				<label class="lmdfSelectorL31">
					<input type="radio" name="lmdfSelectorL31" id="lmdfSelectorL31" value="unifamiliar" /> Unifamiliar
				</label>
				<label class="lmdfSelectorL31">
					<input type="radio" name="lmdfSelectorL31" id="lmdfSelectorL31" value="plurifamiliar horizontal" /> Plurifamiliar horizontal
				</label>
				<label class="lmdfSelectorL31">
					<input type="radio" name="lmdfSelectorL31" id="lmdfSelectorL31" value="plurifamiliar vertical" /> Plurifamiliar vertical
				</label>
				</div>
			</fieldset>
                </div>
  	</div>
<br />
	<div class="row-fluid">
		<div class="span4">
			<fieldset class="lmdfSelectorL32">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
				<span class="lmdfSelectorL32">Tipo de uso no habitacional:</span>
				<label class="lmdfSelectorL32">
					<input type="radio" name="lmdfSelectorL32" id="lmdfSelectorL32" value="comercio y servicios" /> Comercio y servicios
				</label>
				<label class="lmdfSelectorL32">
					<input type="radio" name="lmdfSelectorL32" id="lmdfSelectorL32" value="uso turístico" /> Uso turístico
				</label>
				<label class="lmdfSelectorL32">
					<input type="radio" name="lmdfSelectorL32" id="lmdfSelectorL32" value="industria" /> Industria
				</label>
				<label class="lmdfSelectorL32">
					<input type="radio" name="lmdfSelectorL32" id="lmdfSelectorL32" value="equipamiento y otros" /> Equipamiento y otros
				</label>
				</div>
			</fieldset>
		</div>
		<div class="span6 lmdfSelectorL33" style="display: none;">
			<fieldset class="lmdfSelectorL33">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
				<span class="lmdfSelectorL33">Tipo de comercio y servicios:</span>
				<label class="lmdfSelectorL33">
					<input type="radio" name="lmdfSelectorL33" id="lmdfSelectorL33" value="barrial" /> Barrial
				</label>
				<label class="lmdfSelectorL33">
					<input type="radio" name="lmdfSelectorL33" id="lmdfSelectorL33" value="central" /> Central
				</label>
				<label class="lmdfSelectorL33">
					<input type="radio" name="lmdfSelectorL33" id="lmdfSelectorL33" value="distrital" /> Distrital
				</label>
				<label class="lmdfSelectorL33">
					<input type="radio" name="lmdfSelectorL33" id="lmdfSelectorL33" value="regional" /> Regional
				</label>
				</div>
			</fieldset>
                </div>
		<div class="span6 lmdfSelectorL34" style="display: none;">
			<fieldset class="lmdfSelectorL34">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
				<span class="lmdfSelectorL34">Tipo de uso turistico:</span>
				<label class="lmdfSelectorL34">
					<input type="radio" name="lmdfSelectorL34" id="lmdfSelectorL34" value="campestre" /> Campestre
				</label>
				<label class="lmdfSelectorL34">
					<input type="radio" name="lmdfSelectorL34" id="lmdfSelectorL34" value="hotelero densidad alta" /> Hotelero densidad alta
				</label>
				<label class="lmdfSelectorL34">
					<input type="radio" name="lmdfSelectorL34" id="lmdfSelectorL34" value="hotelero densidad media" /> Hotelero densidad media
				</label>
				<label class="lmdfSelectorL34">
					<input type="radio" name="lmdfSelectorL34" id="lmdfSelectorL34" value="hotelero densidad baja" /> Hotelero densidad baja
				</label>
				<label class="lmdfSelectorL34">
					<input type="radio" name="lmdfSelectorL34" id="lmdfSelectorL34" value="hotelero densidad mínima" /> Hotelero densidad mínima
				</label>
				</div>
			</fieldset>
                </div>
        	<div class="span6 lmdfSelectorL35" style="display: none;">
			<fieldset class="lmdfSelectorL35">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
				<span class="lmdfSelectorL35">Tipo de industria:</span>
				<label class="lmdfSelectorL35">
					<input type="radio" name="lmdfSelectorL35" id="lmdfSelectorL35" value="ligera riesgo bajo" /> Ligiera, riesgo bajo
				</label>
				<label class="lmdfSelectorL35">
					<input type="radio" name="lmdfSelectorL35" id="lmdfSelectorL35" value="media riesgo merio" /> Media, riesgo medio
				</label>
				<label class="lmdfSelectorL35">
					<input type="radio" name="lmdfSelectorL35" id="lmdfSelectorL35" value="pesada riesgo alto" /> Pesada, riesgo alto
				</label>
				</div>
			</fieldset>
                </div>
        	<div class="span6 lmdfSelectorL36" style="display: none;">
			<fieldset class="lmdfSelectorL36">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
				<span class="lmdfSelectorL36">Tipo de equipamiento y otros:</span>
				<label class="lmdfSelectorL36">
					<input type="radio" name="lmdfSelectorL36" id="lmdfSelectorL36" value="institucional" /> Institucional
				</label>
				<label class="lmdfSelectorL36">
					<input type="radio" name="lmdfSelectorL36" id="lmdfSelectorL36" value="regional" /> Regional
				</label>
				<label class="lmdfSelectorL36">
					<input type="radio" name="lmdfSelectorL36" id="lmdfSelectorL36" value="espacios verdes" /> Espacios verdes
				</label>
				<label class="lmdfSelectorL36">
					<input type="radio" name="lmdfSelectorL36" id="lmdfSelectorL36" value="especial" /> Especial
				</label>
				<label class="lmdfSelectorL36">
					<input type="radio" name="lmdfSelectorL36" id="lmdfSelectorL36" value="infraestructura" /> Infraestructura
				</label>
				</div>
			</fieldset>
                </div>
  	</div>
<br />
	<div class="row-fluid">
		<div class="span4 lmdfSelectorL25" style="display: none;">
			<fieldset class="lmdfSelectorL25">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
				<span class="lmdfSelectorL25">Tipo de estacionamiento:</span>
				<label class="lmdfSelectorL25">
					<input type="radio" name="lmdfSelectorL25" id="lmdfSelectorL25" value="cubierto" /> Cubierto
				</label>
				<label class="lmdfSelectorL25">
					<input type="radio" name="lmdfSelectorL25" id="lmdfSelectorL25" value="descubierto" /> Descubierto
				</label>
				</div>
			</fieldset>
		</div>
		<div class="span4 lmdfSelectorL21" style="display: none;">
			<fieldset class="lmdfSelectorL21">
				<div class="radio hasTooltip" data-placement="left" title="Elige una opcion">
				<span class="lmdfSelectorL21">Tipo de reparacipon:</span>
				<label class="lmdfSelectorL21">
					<input type="radio" name="lmdfSelectorL21" id="lmdfSelectorL21" value="reparación menor" /> Reparación menor
				</label>
				<label class="lmdfSelectorL21">
					<input type="radio" name="lmdfSelectorL21" id="lmdfSelectorL21" value="reparación mayor o adaptación" /> Reparación mayor o adaptación
				</label>
				</div>
			</fieldset>
		</div>
  	</div>
<br />
	<div class="row-fluid">
		<div class="span3 lmdfInputL23" style="display: none;">
			<label for="lmdfInputL23" class="lmdfInputL23" style="display: none;">La superficie en m<sup>2</sup> apmarado</label>
			<input type="text" name="lmdfInputL23" id="lmdfInputL23" class="input-mini hasTooltip" data-placement="right" style="display: none;" title="Superficie" />
			</label>
		</div>
		<div class="span3 lmdfInputL27" style="display: none;">
			<label for="lmdfInputL27" class="lmdfInputL27" style="display: none;">Distancia en m apmarado</label>
			<input type="text" name="lmdfInputL27" id="lmdfInputL27" class="input-mini hasTooltip" data-placement="right" style="display: none;" title="Distancia" />
			</label>
		</div>
		<div class="span3 lmdfInputL26" style="display: none;">
			<label for="lmdfInputL26" class="lmdfInputL26" style="display: none;">El volumen en m<sup>3</sup> apmarado</label>
			<input type="text" name="lmdfInputL26" id="lmdfInputL26" class="input-mini hasTooltip" data-placement="right" style="display: none;" title="Volumen" />
			</label>
		</div>
		<div class="span3 lmdfInputL24" style="display: none;">
			<label for="lmdfInputL24" class="lmdfInputL24" style="display: none;">El periodo en días apmarado</label>
			<input type="text" name="lmdfInputL24" id="lmdfInputL24" class="input-mini hasTooltip" data-placement="right" style="display: none;" title="Periodo (días)" />
			</label>
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
		<div class="span2">
			<label for="lmdfInputP2" class="lmdfInputP2" style="display: none;">Número oficial</label>
			<input type="text" name="lmdfInputP2" id="lmdfInputP2" class="input-mini" style="display: none;" />
		</div>
		<div class="span4">
			<label for="lmdfInputP2A" class="lmdfInputP2A checkbox" style="display: none;">Comprobante del número oficial
			<input type="checkbox" name="lmdfInputP2A" id="lmdfInputP2A" style="display: none;" class="hasTooltip" title="Selecciona casillla en caso que existe un comprobante de asignación del número oficial" />
			</label>
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
			<label for="lmdfInputP8" class="lmdfInputP8" style="display: none;">Manzana</label>
			<input type="text" name="lmdfInputP8" id="lmdfInputP8" class="input-xlarge" style="display: none;" />
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<label for="lmdfInputP9" class="lmdfInputP9" style="display: none;">Lote</label>
			<input type="text" name="lmdfInputP9" id="lmdfInputP9" class="input-xlarge" style="display: none;" />
		</div>
		<div class="span6">
			<label for="lmdfInputP10" class="lmdfInputP10" style="display: none;">Clave catastral</label>
			<input type="text" name="lmdfInputP10" id="lmdfInputP10" class="input-xlarge" style="display: none;" />
		</div>
	</div>
</fieldset>

<fieldset class="lmdfInputP16" style="display: none;">
	<legend class="lmdfInputP16" style="display: none;">Ubicación en el centro histórico</legend>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputP16" class="checkbox lmdfInputP16" style="display: none;">Ubicado en el centro histórico
			<input type="checkbox" name="lmdfInputP16" id="lmdfInputP16" style="display: none;" class="hasTooltip" title="Selecciona casilla en caso que predio se encuentra en el centro histórico" />
			</label>
                </div>
		<div class="span4">
			<label for="lmdfInputP17" class="checkbox lmdfInputP17" style="display: none;">Restauración en el centro histórico
			<input type="checkbox" name="lmdfInputP17" id="lmdfInputP17" style="display: none;" class="hasTooltip" title="Selecciona casilla en caso que trata de restauración de inmueble en el centro histórico" />
			</label>
		</div>
		<div class="span4">
			<label for="lmdfInputP18" class="checkbox lmdfInputP18" style="display: none;">Remodelación en el centro histórico
			<input type="checkbox" name="lmdfInputP18" id="lmdfInputP18" style="display: none;" class="hasTooltip" title="Selecciona casilla en caso que trata de remodelación de inmueble en el centro histórico" />
			</label>
		</div>

	</div>
</fieldset>


<fieldset class="lmdfInputP11" style="display: none;">
	<legend class="lmdfInputP11" style="display: none;">Presencia de servicios</legend>
	<div class="row-fluid">
		<div class="span2">
			<label for="lmdfInputP11" class="checkbox lmdfInputP11" style="display: none;">Agua
			<input type="checkbox" name="lmdfInputP11" id="lmdfInputP11" style="display: none;" class="hasTooltip" title="Selecciona casilla en caso que predio cuenta con servicios de agua" />
			</label>
                </div>
		<div class="span2">
			<label for="lmdfInputP12" class="checkbox lmdfInputP12" style="display: none;">Drenaje
			<input type="checkbox" name="lmdfInputP12" id="lmdfInputP12" style="display: none;" class="hasTooltip" title="Selecciona casilla en caso que predio cuenta con servicios de drenaje" />
			</label>
		</div>
		<div class="span2">
			<label for="lmdfInputP13" class="checkbox lmdfInputP13" style="display: none;">Alumbrado
			<input type="checkbox" name="lmdfInputP13" id="lmdfInputP13" style="display: none;" class="hasTooltip" title="Selecciona casilla en caso que predio cuenta con alumbrado" />
			</label>
		</div>
		<div class="span2">
			<label for="lmdfInputP14" class="checkbox lmdfInputP14" style="display: none;">Pavimiento
			<input type="checkbox" name="lmdfInputP14" id="lmdfInputP14" style="display: none;" class="hasTooltip" title="Selecciona casilla en caso que predio cuenta con pavimiento" />
			</label>
		</div>
		<div class="span2">
			<label for="lmdfInputP15" class="checkbox lmdfInputP15" style="display: none;">Banqueta
			<input type="checkbox" name="lmdfInputP15" id="lmdfInputP15" style="display: none;" class="hasTooltip" title="Selecciona casilla en caso que predio cuenta con banqueta" />
			</label>
		</div>
	</div>
</fieldset>



<fieldset class="lmdfInputP6" style="display: none;">
	<legend class="lmdfInputP6" style="display: none;">Especifica la detalles y superficie de la obra</legend>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputP19" class="checkbox lmdfInputP19" style="display: none;">Existe una construcción o se va a construir
			<input type="checkbox" name="lmdfInputP19" id="lmdfInputP19" style="display: none;" class="hasTooltip" title="Selecciona casilla en caso que predio cuenta con una construcción o se pretende construir una" />
			</label>
                </div>
		<div class="span8">
			<label for="lmdfInputP20" class="lmdfInputP20" style="display: none;">Descripción de la construcción y de la obra que se realizará (250 símbolos)
			<textarea type="textarea" name="lmdfInputP20" id="lmdfInputP20" class="input-xxlarge" style="display: none;" ></textarea>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<label for="lmdfInputP6" class="checkbox lmdfInputP6" style="display: none;">Superficie de la obra mayor que 50 m<sup>2</sup>
			<input type="checkbox" name="lmdfInputP6" id="lmdfInputP6" style="display: none;" class="hasTooltip" title="Selecciona casilla en caso que predio es mayór que 50 m" />
			</label>
                </div>
		<div class="span8">
			<label for="lmdfInputP7" class="lmdfInputP7" style="display: none;">Introduce la superficie de la obra en m<sup>2</sup></label>
			<input type="text" name="lmdfInputP7" id="lmdfInputP7" class="input-mini hasTooltip" data-placement="right" style="display: none;" title="Superficie para los predios mayores que 50 m" />
		</div>
	</div>
</fieldset>





<!-- Datos sobre solicitante -->
<fieldset class="lmdfInputS0" style="display: none;">
	<legend class="lmdfInputS0" style="display: none;">Introduce los datos adicionales sobre solicitante</legend>

	<div class="row-fluid">
		<div class="span2">
			<label for="lmdfInputS0" class="checkbox lmdfInputS0" style="display: none;">Giro comercial</sup>
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
			<label for="lmdfInputPR0" class="lmdfInputPR0 checkbox" style="display: none;">Propietario es distinto del solicitante</sup>
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