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

$js = <<<JS
(function ($) {
	$(document).on('click', 'input[name^=ajaxFileSubmit]', function () {
		var submitName = this.getAttribute("name");
		var baseName = submitName.replace("ajaxFileSubmit",""); // getting the variable part of the form elements names
		var file   = $('input[name=docRequired'+baseName+'_file]')[0].files[0];  // taking only the first file in the array of selected files
		if (typeof file == "undefined") {
			// no file
			var errormessage = '<div class="alert"><button type="button" class="close" data-dismiss="alert">' +
						'×</button><strong>Aviso!</strong> El archivo del documento no fue anexado o su tipo es incorrecto.</div>';
			$('.ajaxFileSubmitResult'+baseName).html( errormessage );	
			return false;
		}
		if (file.size > 4194304) { // checking if the size is OK (less than 4 Mb)
			// too large file
			var errormessage = '<div class="alert"><button type="button" class="close" data-dismiss="alert">' +
						'×</button><strong>Aviso!</strong> Archivo del documento no puede exceder 4 Mb. Documento no fue anexado.</div>';
			$('.ajaxFileSubmitResult'+baseName).html( errormessage );	
			return false;
		}
		var variable_doctype = 'docRequired' + baseName;                                    // setting the reference doctype as in LMDF tree
		var variable_doc_description = $('input[name=docRequired'+baseName+'_text]').val(); // taking the description
		var parcel_case_id = $('input[name=docRequired'+baseName+'_parcel_case_id]').val(); // taking the case id
		var request = new FormData();     // the request should be an object to be correctly transfered through JSON Ajax
			if (typeof file != "undefined") {
				request.append('variable_file',file);
			}
			request.append('variable_doctype',variable_doctype);
			request.append('variable_doc_description',variable_doc_description);
			request.append('parcel_case_id',parcel_case_id);
			request.append('option','com_ajax');
			request.append('module','lmu1');
			request.append('ajax_mode','file_submit');
			request.append('format','json');

		$.ajax({
			type   : 	'POST',
			dataType   : 	'json',
			processData: 	false,
			contentType: 	false,
			scriptCharset: 'utf-8',
			data   : 	request,
			xhr : function()
			  {
			    var jqXHR = null;
               			if ( window.ActiveXObject ) {
	        	                jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
		                    } else {
		                        jqXHR = new window.XMLHttpRequest();
		                    }			    //Upload progress
			    	jqXHR.upload.addEventListener("progress", function(evt){
			      	if (evt.lengthComputable) {
			        	var percentComplete = Math.round( (evt.loaded * 100) / evt.total) + '%';
			        	// Do something with upload progress
			        	var progressbar = '<div class="progress progress-striped">' +
						'<div class="bar" style="width:' + percentComplete +
						';">' + '</div><span align="center">' +   			// seems that align attribute for span is depreciated
						percentComplete +'</span></div></div>';
					$('.ajaxFileSubmitResult'+baseName).html( progressbar );
			      	}
			    	}, false);
			    	return jqXHR;
			},
			success: 	function (response) {
				// var s = JSON.stringify(response.data); // debugging
				// $('.ajaxFileSubmitResult'+baseName).html( s );
				var r = JSON.parse(response.data);
				if (response.type == 'error' || r['errorlog']) {
					// we got an error in some part of the process
					var errormessage = '<div class="alert"><button type="button" class="close" data-dismiss="alert">' +
							'×</button><strong>Error!</strong>' + r['errorlog'] + '</div>';
					$('.ajaxFileSubmitResult'+baseName).html( errormessage );	
				} else {
					// no error
					$('.ajaxFileSubmitResult'+baseName).html( '<i class="icon-ok"></i><!-- Messages: ' + r['string'] + 'InsertID:' + r['insertId'] + '-->');   
					document.getElementById('ajaxFileSubmit'+baseName).disabled = true; // disabling submit button on success
					document.getElementById('ajaxFileDelete'+baseName).style.display = "inline";
					document.getElementById('docRequired'+baseName+'_file').disabled = true;
					document.getElementById('docRequired'+baseName+'_text').disabled = true;
					document.getElementById('docRequired'+baseName+'_id').value = r['insertId']; 
				}
			},
			error: 	function () {
				// we got an Ajax execution error
				var errormessage = '<div class="alert"><button type="button" class="close" data-dismiss="alert">' +
							'×</button><strong>Error!</strong>Archivo no fue anexado.</div>';
				$('.ajaxFileSubmitResult'+baseName).html( errormessage );	
			}

		});
		return false;
	});
})(jQuery);
JS;

$doc->addScriptDeclaration($js);

$style = <<<CSS
/**
 * Progress bars with centered text
 */
.progress {
    position: relative;
}

.bar {
    z-index: 1;
    position: absolute;
}

.progress span {
    position: absolute;
    top: 0;
    z-index: 2;
    color: black; // You might need to change it
    text-align: center;
    width: 100%;
}
CSS;

$doc->addStyleDeclaration( $style );

?>

<div id="hidden_docs">

<form class="docRequired1" name="docRequired1" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired1" class="docRequired1" style="display: none;">Documento: identificación oficial de solicitante</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired1_file" id="docRequired1_file" />
	<input type="hidden" name="docRequired1_parcel_case_id" id="docRequired1_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired1_text" id="docRequired1_text" value="identificación oficial del solicitante" />
	<input type="hidden" name="docRequired1_id" id="docRequired1_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit1" id="ajaxFileSubmit1" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete1" id="ajaxFileDelete1" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult1"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequired1A" name="docRequired1A" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired1A" class="docRequired1A" style="display: none;">Documento: identificación oficial del propietario</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired1A_file" id="docRequired1A_file" />
	<input type="hidden" name="docRequired1A_parcel_case_id" id="docRequired1A_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired1A_text" id="docRequired1A_text" value="identificación oficial del propietario" />
	<input type="hidden" name="docRequired1A_id" id="docRequired1A_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit1A" id="ajaxFileSubmit1A" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete1A" id="ajaxFileDelete1A" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult1A"></div><div class="span3">&nbsp;</div>
	</div>
</form>


<form class="docRequired2" name="docRequired2" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired2" class="docRequired2">Documento: escrituras</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired2_file" id="docRequired2_file" />
	<input type="hidden" name="docRequired2_parcel_case_id" id="docRequired2_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired2_text" id="docRequired2_text" value="escrituras del predio" />
	<input type="hidden" name="docRequired2_id" id="docRequired2_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit2" id="ajaxFileSubmit2" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete2" id="ajaxFileDelete2" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult2"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequired3" name="docRequired3" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired3" class="docRequired3">Documento: contrato de compra-venta</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired3_file" id="docRequired3_file" />
	<input type="hidden" name="docRequired3_parcel_case_id" id="docRequired3_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired3_text" id="docRequired3_text" value="contrato de compra-venta" />
	<input type="hidden" name="docRequired3_id" id="docRequired3_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit3" id="ajaxFileSubmit3" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete3" id="ajaxFileDelete3" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult3"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequired4" name="docRequired4" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired4" class="docRequired4">Documento: comprobante de domicilio</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired4_file" id="docRequired4_file" />
	<input type="hidden" name="docRequired4_parcel_case_id" id="docRequired4_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired4_text" id="docRequired4_text" value="comprobante de domicilio" />
	<input type="hidden" name="docRequired4_id" id="docRequired4_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit4" id="ajaxFileSubmit4" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete4" id="ajaxFileDelete4" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult4"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequired5" name="docRequired5" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired5" class="docRequired5">Documento: registro público de la propiedad</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired5_file" id="docRequired5_file" />
	<input type="hidden" name="docRequired5_parcel_case_id" id="docRequired5_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired5_text" id="docRequired5_text" value="registro público de la propiedad" />
	<input type="hidden" name="docRequired5_id" id="docRequired5_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit5" id="ajaxFileSubmit5" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete5" id="ajaxFileDelete5" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult5"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequired6" name="docRequired6" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired6" class="docRequired6">Documento: pago de predial actualizado</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired6_file" id="docRequired6_file" />
	<input type="hidden" name="docRequired6_parcel_case_id" id="docRequired6_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired6_text" id="docRequired6_text" value="pago de predial" />
	<input type="hidden" name="docRequired6_id" id="docRequired6_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit6" id="ajaxFileSubmit6" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete6" id="ajaxFileDelete6" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult6"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequired7" name="docRequired7" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired7" class="docRequired7">Documiento: croquis de construcción</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired7_file" id="docRequired7_file" />
	<input type="hidden" name="docRequired7_parcel_case_id" id="docRequired7_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired7_text" id="docRequired7_text" value="croquis de construcción" />
	<input type="hidden" name="docRequired7_id" id="docRequired7_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit7" id="ajaxFileSubmit7" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete7" id="ajaxFileDelete7" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult7"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequired8" name="docRequired8" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired8" class="docRequired8">Documiento: Proyecto y planos ejecutivos firmados por director responsable de obra (DRO)</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired8_file" id="docRequired8_file" />
	<input type="hidden" name="docRequired8_parcel_case_id" id="docRequired8_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired8_text" id="docRequired8_text" value="proyecto y planos ejecutivos" />
	<input type="hidden" name="docRequired8_id" id="docRequired8_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit8" id="ajaxFileSubmit8" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete8" id="ajaxFileDelete8" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult8"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequired9" name="docRequired9" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired9" class="docRequired9">Fotos de fachada e interior (anexar en un solo archivo PDF)</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired9_file" id="docRequired9_file" />
	<input type="hidden" name="docRequired9_parcel_case_id" id="docRequired9_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired9_text" id="docRequired9_text" value="fotos de fachada e interior" />
	<input type="hidden" name="docRequired9_id" id="docRequired9_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit9" id="ajaxFileSubmit9" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete9" id="ajaxFileDelete9" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult9"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequiredA" name="docRequiredA" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequiredA" class="docRequiredA">Documiento: comprobante de alineamiento</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequiredA_file" id="docRequiredA_file" />
	<input type="hidden" name="docRequiredA_parcel_case_id" id="docRequiredA_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequiredA_text" id="docRequiredA_text" value="comprobante de alineamiento" />
	<input type="hidden" name="docRequiredA_id" id="docRequiredA_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmitA" id="ajaxFileSubmitA" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDeleteA" id="ajaxFileDeleteA" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResultA"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequiredN" name="docRequiredN" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequiredN" class="docRequiredN">Documiento: comprobante de asignación del número oficial</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequiredN_file" id="docRequiredN_file" />
	<input type="hidden" name="docRequiredN_parcel_case_id" id="docRequiredN_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequiredN_text" id="docRequiredN_text" value="comprobante de asignación del número oficial" />
	<input type="hidden" name="docRequiredN_id" id="docRequiredN_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmitN" id="ajaxFileSubmitN" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDeleteN" id="ajaxFileDeleteN" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResultN"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequired10" name="docRequired10" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired10" class="docRequired10">Documiento: dictamen de la dirección de obras públicas y desarrollo urbano sobre movimientos de la tierra</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired10_file" id="docRequired10_file" />
	<input type="hidden" name="docRequired10_parcel_case_id" id="docRequired10_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired10_text" id="docRequired10_text" value="dictamen de la dirección de obras públicas y desarrollo urbano sobre movimientos de la tierra" />
	<input type="hidden" name="docRequired10_id" id="docRequired10_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit10" id="ajaxFileSubmit10" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete10" id="ajaxFileDelete10" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult10"></div><div class="span3">&nbsp;</div>
	</div>
</form>

<form class="docRequired11" name="docRequired11" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired11" class="docRequired11">Documiento: carta de poder</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired11_file" id="docRequired11_file" />
	<input type="hidden" name="docRequired11_parcel_case_id" id="docRequired11_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired11_text" id="docRequired11_text" value="carta de poder" />
	<input type="hidden" name="docRequired11_id" id="docRequired11_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit11" id="ajaxFileSubmit11" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete11" id="ajaxFileDelete11" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResult11"></div><div class="span3">&nbsp;</div>
	</div>
</form>


<form class="docRequiredD" name="docRequiredD" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequiredD" class="docRequiredD">Documento: dictamen de usos y destinos</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequiredD_file" id="docRequiredD_file" />
	<input type="hidden" name="docRequiredD_parcel_case_id" id="docRequiredD_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequiredD_text" id="docRequiredD_text" value="dictamen usos y destinos" />
	<input type="hidden" name="docRequiredD_id" id="docRequiredD_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmitD" id="ajaxFileSubmitD" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDeleteD" id="ajaxFileDeleteD" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResultD"></div><div class="span3">&nbsp;</div>
	</div>
</form>


<form class="docRequiredOpt1" name="docRequiredOpt1" enctype="multipart/form-data" style="display: block;" /> 
	<div class="row-fluid">
	<label for="docRequiredOpt1" class="docRequiredOpt1">Documento opcional considerado por el solicitante</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequiredOpt1_file" id="docRequiredOpt1_file" />
	<input type="hidden" name="docRequiredOpt1_parcel_case_id" id="docRequiredOpt1_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequiredOpt1_id" id="docRequiredOpt1_id" value="" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmitOpt1" id="ajaxFileSubmitOpt1" value="Subir documento" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDeleteOpt1" id="ajaxFileDeleteOpt1" value="Eliminar documento" style="display: none;" />
	</div>
	<div class="row-fluid">
	<input class="span5" type="text" name="docRequiredOpt1_text" id="docRequiredOpt1_text" placeholder="describe el documento aquí" />
	</div>
	<div class="row-fluid">
	<div class="span6 ajaxFileSubmitResultOpt1"></div><div class="span3">&nbsp;</div>
	</div>
</form>


</div>



