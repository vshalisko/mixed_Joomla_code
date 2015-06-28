<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php
/*
 * Created By: 
 * Date: 
 */

include '../connection/db_mysql_connection.php';
include '../functions/query_functions.php';
include '../functions/generic_functions.php';

/******MYSQL DATABASE CONECTION*****/
try {
    //DB CONNECTION FUNCTION (USER,PASS,DB_NAME,SERVERURL)
    $db_mysql_connection = new db_mysql_connection();
//    $db_mysql_connection_jpnh = new db_mysql_connection_jpnh();
    //CREATE NEW QUERY OBJECT
    $querys= new query_functions();
    $functions= new generic_functions();
} catch (DatabaseException $ex) {
    print('redirect to custom error page will go here');
}
date_default_timezone_set("Mexico/General");+

    
/*********SESSION************/
session_start();

//echo $_SESSION["id_usuario"];
//echo $_SESSION["nombre"];
//echo $_SESSION["usuario"];

class modForm
{

    public static function getUploadForm ( $param )
    {
	$p=new stdClass;
	foreach($param as $k => $v) { 
		$p->$k = $v;
	}

	$parcel_case_id = $p->parcel_case_id;
	$document_description = $p->document_description;
	$document_id = $p->document_id;
	$u = $p->update_form_id;
	$u_file = $u . "_file";
	$u_parcel_case_id = $u ."_parcel_case_id";
	$u_id = $u . "_id";
	$u_text = $u . "_text";

	if ( $document_id ) {
		$disabled = "disabled";
		$hidden = "";
	} else {
		$disabled = "";
		$hidden = 'style="display: none;"';
	}

	if ( $p->user_description ) {
		$user_description_field =  '<div class="row-fluid"><input class="offset1 span5" type="text" name="docRequired'.$u_text.'" id="docRequired'.$u_text.'" placeholder="describe el documento" '.$disabled.' /></div>';
	} else {
		$user_description_field =  '<div class="row-fluid" style="display: none;"><input class="offset1 span5" type="text" name="docRequired'.$u_text.'" id="docRequired'.$u_text.'" placeholder="describe el documento" '.$disabled.' /></div>';
	}

$update_form = <<<HTML
<br />
<form class="docRequired$u" name="docRequired$u" enctype="multipart/form-data" style="display: block;" /> 
<div class="row-fluid">
<label for="docRequired$u" class="offset1 docRequired$u">$document_description</label>
<div class="span1">&nbsp;</div>
<input class="span5 btn" type="file" accept="image/*, application/pdf" name="docRequired$u_file" id="docRequired$u_file" $disabled />
<input type="hidden" name="docRequired$u_parcel_case_id" id="docRequired$u_parcel_case_id" value="$parcel_case_id" />
<input type="hidden" name="docRequired$u_id" id="docRequired$u_id" value="$document_id" />
<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit$u" id="ajaxFileSubmit$u" value="Subir documento" $disabled />
<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete$u" id="ajaxFileDelete$u" value="Eliminar documento" $hidden />
</div>
$user_description_field
<div class="row-fluid">
<div class="offset1 span6 ajaxFileSubmitResult$u"><i class="icon-ok" $hidden></i></div>
<div class="span3">&nbsp;</div>
</div>
</form>
HTML;

	return $update_form;
    }
}

?>    
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<title>Tr&aacute;mites Lagos de Moreno - Subir Documentos</title>    
<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../script/jquery-ui/jquery-ui.css">
<!SCRIPT INCLUDE>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

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

</style>

</head>
<body>
    <div id="header">
        <table id="table-header" border="0" cellpadding="2" cellspacing="2">
          <tbody>
            <tr>
              <td><img id="header-logo" src="../imagenes/gobierno_h.png" alt="gobierno_jalisco" title="gobierno_jalisco"></td>
              <td style="width: 100%;"></td>
              <td><img id="header-logo" src="../imagenes/secretaria_h2.png" alt="lagos_de_moreno" title="lagos_de_moreno"></td>
            </tr>
          </tbody>
        </table>
    </div>
<div id="container">
<div id="top-containier">
    <?php echo "Documentación para el Trámite: ".$_SESSION["tipo_tramite"]."";?>
    
    
</div>
<div id="menu" style="background-color: rgb(238, 238, 238); height: 100%; width: 100%;">
<table style="width:100%;">
    <tbody>
        <tr>
            <td style="color:#FFFFFF; vertical-align: middle; text-align: center; width:20%; font-weight: bold;"></td>
            <td style="vertical-align: middle; text-align: center; width:60%;">
            <div class="upload-elements">
            <!-- file uploader elements -->
<?php

// 'update_form_id' is an unique identifier, rest of names of the elements in the form will derive from this
// 'parcel_case_id' is the main identifier of case (tramite), should be case opened by the same user as current session user
// 'document_id' is the document primary key in case_documents table, if defined this cause the submit control disabled and delete button enabled
// 'document_description' - the text that appear in the upper label
// 'user_description' - text input enabled for custom user description (or comment) of the document
$upload_form1_properties =  array(
	'update_form_id' => "D1",
	'parcel_case_id' => 250,
	'document_id' => "",
	'document_description' => "Identificación oficial del solicitante",
	'user_description' => FALSE
);

$upload_form2_properties =  array(
	'update_form_id' => "D2",
	'parcel_case_id' => 250,
	'document_id' => "",
	'document_description' => "Identificación oficial del propietario",
	'user_description' => FALSE
);


$upload_form3_properties =  array(
	'update_form_id' => "DOpt",
	'parcel_case_id' => 250,
	'document_id' => "",
	'document_description' => "Documento opcional considerado por el solicitante",
	'user_description' => TRUE
);


$upload_form1_html = modForm::getUploadForm( $upload_form1_properties );
echo $upload_form1_html; 
$upload_form2_html = modForm::getUploadForm( $upload_form2_properties );
echo $upload_form2_html; 
$upload_form3_html = modForm::getUploadForm( $upload_form3_properties );
echo $upload_form3_html; 



?>            
            </div>
            <hr style="width:100%; color: rgb(136, 187, 0); background-color: rgb(109, 143, 49);">
            <button id="finalizar" name="finalizar" value="finalizar" style="width:150px">Finalizar</button>
            <button id="cancelar" name="cancelar" value="cancelar" style="width:150px">Cancelar</button>
            </div>
            </td>
               <script type="text/javascript">
                $( "#finalizar" ).click(function(){
                    window.location.assign('../mod_inicio/inicio.php');
               });
        </script>                
            <td style="color:#FFFFFF; vertical-align: top; text-align: center; width:20%; font-weight: bold;">
                <div id="menudiv" style="width: 100%; z-index: 1;">
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                    <td style="width:20%;"></td>
                    <td style="width:20%;"></td>
                    <td style="width:20%;">
                                    <?php include ("../ui_elements/menu/menu.php");?>
                    </td>
<!--                    <td style="width:10%;"></td>-->
                    </tr>
                    </tbody>
                </table>
                </div
            </td>
        </tr>
</tbody>
</table>                      
</div>
<div id="footer" style="background-color: rgb(109, 143, 49); clear: both; text-align: center; color: white; font-family: Arial;">Copyright &copy; Lagos de Moreno @ Jalisco.gob.mx</div>
</div>  
</body></html>
