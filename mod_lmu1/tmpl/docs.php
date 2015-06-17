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

// Ajax related JavaScript code, note the module name in request options
$js = <<<JS
(function ($) {
	$(document).on('click', 'input[name=ajaxFileSubmit1]', function () {
		var file   = $('input[name=docRequired1_file]')[0].files[0];  // taking only the first file in the array of selected files
		var file_doctype   = $('input[name=docRequired1_text]').val(); // taking the comment value
		var parcel_case_id = $('input[name=docRequired1_parcel_case_id]').val(); // taking the comment value
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
			success: 	function (response) {
				// var s = JSON.stringify(response.data); // debugging
				// $('.ajaxFileSubmitResult1').html( s );
				var r = JSON.parse(response.data);
				if (response.type == 'error' || r['errorlog']) {
					// we got an error in some part of the process
					$('.ajaxFileSubmitResult1').html( '<div class="alert"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error!</strong>' + r['errorlog'] + '</div>');	
				} else {
					// no error
					$('.ajaxFileSubmitResult1').html( r['string'] + '<br />' + r['insertId'] );   
				}

			}
		});
		return false;
	});
})(jQuery);
JS;

$doc->addScriptDeclaration($js);

?>

<div id="hidden_docs">
<div>
<form class="docRequired1" name="docRequired1" enctype="multipart/form-data" style="display: none;" /> 
	<label for="docRequired1" class="docRequired1" style="display: none;">Documento requerido: identificación oficial de solicitante</label>
	<input type="file" accept="image/*, application/pdf" name="docRequired1_file" id="docRequired1_file" />
	<input type="hidden" name="docRequired1_parcel_case_id" id="docRequired1_parcel_case_id" value="<?php echo $dataGeneral->case_new_id->rows[0]->parcel_case_id ?>" />
	<input type="text" name="docRequired1_text" id="docRequired1_text" />
	<input type="button" class="input-mini" name="ajaxFileSubmit1" id="ajaxFileSubmit1" value="Subir archivo" />
	<div class="ajaxFileSubmitResult1"></div>
</form>
</div>


<div>
<form class="docRequired2" enctype="multipart/form-data" style="display: none;" /> 
	<label for="docRequired2" class="docRequired2">Documento requerido: escrituras del predio</label>
	<input type="file" name="docRequired2" id="docRequired2" />
	<input type="text" name="docRequired2_text" id="docRequired2_text" />
	<input type="button" class="input-mini" name="ajaxFileSubmit2" id="ajaxFileSubmit2" value="Subir archivo" />
	<div class="ajaxFileSubmitResult2"></div>
</form>
</div>

</div>



