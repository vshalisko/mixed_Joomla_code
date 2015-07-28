<?php 
/*
 * File uploader JavaScript
 * Created By: Viacheslav Shalisko & Pedro Ivan Tello Flores
 * Date: 29.06.2015
 */
?>

<script>
(function ($) {
	$(document).on('click', 'input[name^=ajaxFileDelete]', function () {
		// funcion to delete documents client side
	
		var submitName = this.getAttribute("name");
		var baseName = submitName.replace("ajaxFileDelete",""); // getting the variable part of the form elements names
		var docId = $('input[name=docRequired'+baseName+'_id]').val(); // taking the document ID
		var parcelId = $('input[name=docRequired'+baseName+'_parcel_case_id]').val(); // taking the parcel ID
                var request = new FormData();
			request.append('case_document_id',docId);
			request.append('parcel_case_id',parcelId);
			request.append('option','com_ajax');
			request.append('module','lmu1');
			request.append('ajax_mode','file_delete');
			request.append('format','json');
		$.ajax({
			url: 		'helper.php',
			type   : 	'POST',
			dataType   : 	'json',
			processData: 	false,
			contentType: 	false,
			cache: 		false,
			scriptCharset: 'utf-8',
			data   : 	request,
			success: 	function (response) {
				var s = JSON.stringify(response);
				var r = JSON.parse(s);
				if (response.type == 'error' || r['errorlog']) {
					// we got an error in some part of the process
					var errormessage = '<div class="alert"><button type="button" class="close" data-dismiss="alert">' +
							'×</button><strong>Error!</strong> Documento no fue eliminado.</div>';
					$('.ajaxFileSubmitResult'+baseName).html( errormessage );	
				} else {
					// no error
					$('.ajaxFileSubmitResult'+baseName).html( '<!-- Messages: ' + r['string'] + 'InsertID:' + r['insertId'] + '-->');   
					document.getElementById('ajaxFileSubmit'+baseName).disabled = false;
					document.getElementById('ajaxFileDelete'+baseName).style.display = "none";
					document.getElementById('docRequired'+baseName+'_file').disabled = false;
					document.getElementById('docRequired'+baseName+'_file').value = '';
					document.getElementById('docRequired'+baseName+'_text').disabled = false;
					document.getElementById('docRequired'+baseName+'_id').value = '';
				}
			},
			error: 	function () {
				// we got an Ajax execution error
				var errormessage = '<div class="alert"><button type="button" class="close" data-dismiss="alert">' +
							'×</button><strong>Error!</strong> Documento no fue eliminado.</div>';
				$('.ajaxFileSubmitResult'+baseName).html( errormessage );	
			}
		});
		return false;
	});

	$(document).on('click', 'input[name^=ajaxFileSubmit]', function () {
        // funcion to upload documents client side
		var submitName = this.getAttribute("name");
		var baseName = submitName.replace("ajaxFileSubmit",""); // getting the variable part of the form elements names
		var file   = $('input[name=docRequired'+baseName+'_file]')[0].files[0];  // taking only the first file in the array of selected files
		if (typeof file == "undefined") {
			// no file
			var errormessage = '<div class="alert"><button type="button" class="close" data-dismiss="alert">' +
						'×</button><strong>Aviso!</strong> Archivo del documento no fue anexado o su tipo es incorrecto.</div>';
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
			url: 		'helper.php',
			type   : 	'POST',
			dataType   : 	'json',
			processData: 	false,
			contentType: 	false,
			cache: 		false,
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
				var s = JSON.stringify(response); // debugging
				// $('.ajaxFileSubmitResult'+baseName).html( s );
				// var r = JSON.parse(response.data);
				// alert(s);
                                var r = JSON.parse(s);
				if (response.type == 'error' || r['errorlog']) {
					// we got an error in some part of the process
					var errormessage = '<div class="alert"><button type="button" class="close" data-dismiss="alert">' +
							'×</button><strong>Error!</strong> ' + r['errorlog'] + '</div>';
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
							'×</button><strong>Error!</strong> Documento no fue anexado.</div>';
				$('.ajaxFileSubmitResult'+baseName).html( errormessage );	
			}

		});
		return false;
	});
})(jQuery);
</script>

<link href="bootstrap.min.css" rel="stylesheet" type="text/css">
<style type="text/css">

.upload-elements {
	background-color:#FFF;
        vertical-align: baseline;
	font: normal 13px/1.8em Arial, Helvetica, sans-serif;
	color: #111;
	text-align: left;

}
.upload-elements input {
	text-transform: none;
}
.upload-elements .btn-primary {
	font-family: Helvetica,Arial,sans-serif;
	font: normal 13px/1.8em Arial, Helvetica, sans-serif;
}


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
    color: black;
    text-align: center;
    width: 100%;
}

.error_red {
	color: red;
}

</style>
