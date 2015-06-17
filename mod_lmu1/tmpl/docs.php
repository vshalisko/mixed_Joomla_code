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
		if (file.size > 3145728) { // checking if the size is OK (less than 3 Mb)
			// too large file
			var errormessage = '<div class="alert"><button type="button" class="close" data-dismiss="alert">' +
						'×</button><strong>Aviso!</strong> Archivo del documento no puede exceder 3 Mb. Documento no fue anexado.</div>';
			$('.ajaxFileSubmitResult'+baseName).html( errormessage );	
			return false;
		}
		var file_doctype   = $('input[name=docRequired'+baseName+'_text]').val(); // taking the comment value
		var parcel_case_id = $('input[name=docRequired'+baseName+'_parcel_case_id]').val(); // taking the comment value
		var request = new FormData();     // the request should be an object to be correctly transfered through JSON Ajax
			if (typeof file != "undefined") {
				request.append('variable_file',file);
			}
			request.append('variable_doctype',file_doctype);
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
						';">' + percentComplete + '</div></div>';
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
					$('.ajaxFileSubmitResult'+baseName).html( '<i class="icon-ok"></i><br />' + r['string'] + '<br />' + r['insertId'] );   
					document.getElementById('ajaxFileSubmit'+baseName).disabled = true; // disabling submit button on success
					document.getElementById('docRequired'+baseName+'_file').disabled = true;
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

?>

<div id="hidden_docs">

<form class="docRequired1" name="docRequired1" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired1" class="docRequired1" style="display: none;">Documento requerido: identificación oficial de solicitante</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired1_file" id="docRequired1_file" />
	<input type="hidden" name="docRequired1_parcel_case_id" id="docRequired1_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired1_text" id="docRequired1_text" value="identificación oficial de solicitante" />
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit1" id="ajaxFileSubmit1" value="Subir archivo" />
	</div>
	<div class="ajaxFileSubmitResult1"></div>
</form>


<form class="docRequired2" name="docRequired2" enctype="multipart/form-data" style="display: none;" /> 
	<div class="row-fluid">
	<label for="docRequired2" class="docRequired2">Documento requerido: escrituras del predio</label>
	<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired2_file" id="docRequired2_file" />
	<input type="hidden" name="docRequired2_parcel_case_id" id="docRequired1_parcel_case_id" 
				value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="hidden" name="docRequired2_text" id="docRequired2_text" value="escrituras del predio"/>
	<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit2" id="ajaxFileSubmit2" value="Subir archivo" />
	</div>
	<div class="ajaxFileSubmitResult2"></div>
</form>

</div>



