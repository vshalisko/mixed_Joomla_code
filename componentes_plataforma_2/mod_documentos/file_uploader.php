<?php

/*
 * File uploader main code
 * Created By: Viacheslav Shalisko & Pedro Ivan Tello Flores
 * Date: 29.06.2015
 */


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

	if ( $p->required ) {
		$required = "required";
		$required_flag = "*";
	} else {
		$required = "";
		$required_flag = "&nbsp;";
	}

	if ( $p->user_description ) {
		$user_description_field =  '<div class="row-fluid"><input class="offset1 span5" type="text" name="docRequired'.$u_text.'" id="docRequired'.$u_text.'" placeholder="describe el documento" '.$disabled.' /></div>';
	} else {
		$user_description_field =  '<div class="row-fluid" style="display: none;"><input class="offset1 span5" type="text" name="docRequired'.$u_text.'" id="docRequired'.$u_text.'" placeholder="describe el documento" '.$disabled.' /></div>';
	}

$update_form = <<<HTML

<form class="docRequired$u" name="docRequired$u" enctype="multipart/form-data" style="display: block;" /> 
<div class="row-fluid">
<label for="docRequired$u" class="offset1 docRequired$u">$document_description $required_flag</label>
<div class="span1">&nbsp;</div>
<input class="span5 btn $required" type="file" accept="image/*, application/pdf" name="docRequired$u_file" id="docRequired$u_file" $disabled />
<input type="hidden" name="docRequired$u_parcel_case_id" id="docRequired$u_parcel_case_id" value="$parcel_case_id" />
<input type="hidden" name="docRequired$u_id" id="docRequired$u_id" value="$document_id" />
<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileSubmit$u" id="ajaxFileSubmit$u" value="Subir documento" $disabled />
<input type="button" class="span2 btn btn-small btn-primary" name="ajaxFileDelete$u" id="ajaxFileDelete$u" value="Eliminar" $hidden />
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

    public static function getFileList ( $param )
    {
	$p=new stdClass;
	foreach($param as $k => $v) { 
		$p->$k = $v;
	}

	$parcel_case_id = $p->parcel_case_id;
	$document_description = $p->document_description;
	$document_id = $p->document_id;
	$document_url = $p->document_url;
	$document_date = $p->document_date;

	if ($document_url) {
		$site_path = $_SERVER['DOCUMENT_ROOT'];
		$document_url_only = "../" . str_replace($site_path, '', $document_url);
		$onclick_script = "window.open(this.href, 'documento','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;";
		$list_element = '<li><a href="'.$document_url_only.'" onclick="'.$onclick_script.'">'.$document_description.' (anexado '.$document_date.')</a>';
	} else {
		if ( $p->required )  {
			$list_element = '<li>'. $document_description . " (documento requerido sin anexar)";
		} else {
			$list_element = '';
		}
	}

	return $list_element;
    }
}

?>    

<!-- file uploader elements rendering -->
<?php
$visible_array = explode(",", $visible_list);
$required_array = explode(",", $required_list);
$optional_prearray = explode(",", $optional_list);
$optional_array = array();
foreach ( $optional_prearray as $optional_element ) {
	$required_flag = 0;
	foreach ( $required_array as $required_element ) {
		if ( $optional_element == $required_element ) {
			// this element should be removed from optional array
			$required_flag = 1;
		}
	}
	if (!$required_flag) {
		array_push($optional_array,$optional_element);
	}
}

for ($i = 0; $i < count($documents); $i++) {
	$documents[$i]["parcel_case_id"] = $parcel_case_id; 
        $document_id = $document_url = $document_date = ''; // default value
	        try {
			// Get the document_id if it is set in database for the given document type
			$table_name = "case_documents";
			$doctype_sting = 'docRequired' . $documents[$i]["update_form_id"];
			$statement = 'parcel_case_id = "'.mysql_real_escape_string($parcel_case_id).'" AND document_type = "'.mysql_real_escape_string($doctype_sting).'"';
			$selection = $querys->select_elements_return_all_elements($db_mysql_connection->getConnection(),$db_mysql_connection->getDBname(),
				$table_name,$statement);
			if( $selection ) {
				$line = mysql_fetch_assoc($selection);
				($line['case_document_id']) ? $document_id = $line['case_document_id'] : $document_id = '';  // we are interested only in one line, so no problem without loop
				($line['document_url']) ? $document_url = $line['document_url'] : $document_url = '';
				($line['document_date_time']) ? $document_date = $line['document_date_time'] : $document_date = '';
				mysql_free_result($selection);
			}
		} catch (DatabaseException $ex) {
		}

	$documents[$i]["document_id"] = $document_id;
	$documents[$i]["document_url"] = $document_url;
	$documents[$i]["document_date"] = $document_date;

	if ($mod_documentos_mode) {
		// form mode
		foreach ( $required_array as $required_element ) {
			if ( $documents[$i]["update_form_id"] == $required_element ) {
				$documents[$i]["required"] = TRUE;
				$upload_form_html = modForm::getUploadForm( $documents[$i] );
				echo $upload_form_html; 
			}
		}
		foreach ( $optional_array as $optional_element ) {
			if ( $documents[$i]["update_form_id"] == $optional_element ) {
				$documents[$i]["required"] = FALSE;
				$upload_form_html = modForm::getUploadForm( $documents[$i] );
				echo $upload_form_html; 
			}
		}
	} else {
		// list mode
		$documents[$i]["required"] = FALSE;
		foreach ( $required_array as $required_element ) {
			if ( $documents[$i]["update_form_id"] == $required_element ) {
				$documents[$i]["required"] = TRUE;
			}
		}
		foreach ( $visible_array as $visible_element ) {
			if ( $documents[$i]["update_form_id"] == $visible_element ) {
				$list_html = modForm::getFileList( $documents[$i] );
				echo $list_html; 
			}
		}
	}
}

?>            
