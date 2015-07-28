<?php
/*
 * Initializing and initial configuration of file uploader
 * Created By: Viacheslav Shalisko & Pedro Ivan Tello Flores
 * Date: 29.06.2015
 */

include '../connection/db_mysql_connection.php';
include '../functions/query_functions.php';
include '../functions/generic_functions.php';

/******MYSQL DATABASE CONNECTION*****/
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
date_default_timezone_set("Mexico/General");

    
/*********SESSION************/
session_start();

// variable $_SESSION["tipo_tramite"] tiene que quedar definida para que funciona correctamente la lógica
if (!isset($_SESSION["tipo_tramite"])) {
	$_SESSION["tipo_tramite"] = "TRAMITE EN GENERAL";    // Nombre generico para caso cuando no esta definido el tipo de tramite en la variable
}

// 'parcel_case_id' is the main identifier of case (tramite), should be case opened by the same user as current session user
if (isset($_SESSION["id_tramite"])) {
	$parcel_case_id = $_SESSION["id_tramite"];    // Primary key for "case"
} else {
	$parcel_case_id = '';
}

//echo $_SESSION["id_usuario"];
//echo $_SESSION["nombre"];
//echo $_SESSION["usuario"];
//echo $_SESSION["nivel"]; //Nivel de acceso
//echo $_SESSION["tipo_tramite"]; //Tipo de tramite
//echo $_SESSION["id_tramite"];

// $_SESSION["nivel"] = 1;
// $_SESSION["tramite_estado"] = 3;
// $_SESSION["tipo_tramite"] = "DICTAMEN DE TRAZO, USOS Y DESTINOS ESPECIFICOS";

// Asignación de los variables transmitidos por GET
$finalizar=isset($_GET["finalizar"]) ? (string)str_replace("'","", $_GET["finalizar"]) : "";
// $doc_req1=isset($_GET["docRequiredD5_id"]) ? (int)str_replace("'","", $_GET["docRequiredD5_id"]) : "";
$id_promotor=isset($_GET["id_promotor"]) ? (int)str_replace("'","", $_GET["id_promotor"]) : "";
$id_tramite=isset($_GET["id_tramite"]) ? (int)str_replace("'","", $_GET["id_tramite"]) : "";
$tipo_tramite=isset($_GET["tipo_tramite"]) ? (string)str_replace("'","", $_GET["tipo_tramite"]) : "";
$tramite_estado=isset($_GET["tramite_estado"]) ? (int)str_replace("'","", $_GET["tramite_estado"]) : "";
// sustituir los valores de $_SESSION por los variables obtendas por $_GET en caso que estas quedaron definidas
$_SESSION["id_promotor"] = ( $id_promotor ) ? $id_promotor : $_SESSION["id_promotor"];
$_SESSION["id_tramite"] = ( $id_tramite ) ? $id_tramite : $_SESSION["id_tramite"]; 
$_SESSION["tipo_tramite"] = ( $tipo_tramite ) ? $tipo_tramite : $_SESSION["tipo_tramite"];
$_SESSION["tramite_estado"] = ( $tramite_estado ) ? $tramite_estado : $_SESSION["tramite_estado"];
$_REQUEST["cancelar"] = (isset($_REQUEST["cancelar"])) ? $_REQUEST["cancelar"] : "";

// declaración del entorno (location) con JavaScript
echo '<script type="text/javascript">';
if (isset($mod_documentos_mode) && $mod_documentos_mode == 1) {
	// modo generador de formas
	if ($finalizar=="finalizar") {
//		if ($doc_req1!=0) {
			if ($_SESSION["tipo_tramite"] == "DICTAMEN DE TRAZO, USOS Y DESTINOS ESPECIFICOS" || $_SESSION["tipo_tramite"] == "DICTAMEN DE USOS Y DESTINOS") {
				echo "window.location.assign('../mod_tramites/tabla_dictamenes.php');";
			} elseif ($_SESSION["tipo_tramite"] == "LICENCIA DE CONSTRUCCION") {
				echo "window.location.assign('../mod_tramites/tabla_licencias.php');";
			} elseif ($_SESSION["tipo_tramite"] == "ALINEAMIENTO Y NUMERO OFICIAL") {
				echo "window.location.assign('../mod_tramites/tabla_alineamiento_numero.php');";
			} else {
				echo "window.location.assign('../mod_inicio/inicio.php');";
			}
//		} else {
//			echo 'alert("Debe agregar la información requerida (Marcada con un *) para continuar el trámite");';
//		}
	} elseif ($_REQUEST["cancelar"]=="cancelar") {
    		if($_SESSION["nivel"]!=1) {
			// cualquier nivel excepto dictaminador
			if ($_SESSION["tipo_tramite"] == "DICTAMEN DE TRAZO, USOS Y DESTINOS ESPECIFICOS" || $_SESSION["tipo_tramite"] == "DICTAMEN DE USOS Y DESTINOS") {
                    		echo "window.location.assign('../mod_tramites/tabla_dictamenes.php');";
			} elseif ($_SESSION["tipo_tramite"] == "LICENCIA DE CONSTRUCCION") {
				echo "window.location.assign('../mod_tramites/tabla_licencias.php');";
			} elseif ($_SESSION["tipo_tramite"] == "ALINEAMIENTO Y NUMERO OFICIAL") {
				echo "window.location.assign('../mod_tramites/tabla_alineamiento_numero.php');";
			} else {
				echo "window.location.assign('../mod_inicio/inicio.php');";
			}        
		} else {
			// nivel de dictaminador
			if ($_SESSION["tipo_tramite"] == "DICTAMEN DE TRAZO, USOS Y DESTINOS ESPECIFICOS" || $_SESSION["tipo_tramite"] == "DICTAMEN DE USOS Y DESTINOS") {
				echo "window.location.assign('../mod_tramites/tabla_dictamenes_dictaminador.php');";
			} elseif ($_SESSION["tipo_tramite"] == "LICENCIA DE CONSTRUCCION") {
				echo "window.location.assign('../mod_tramites/tabla_licencias_dictaminador.php');";
			} elseif ($_SESSION["tipo_tramite"] == "ALINEAMIENTO Y NUMERO OFICIAL") {
				echo "window.location.assign('../mod_tramites/tabla_alineamiento_numero_dictaminador.php');";
			} else {
				echo "window.location.assign('../mod_inicio/inicio.php');";
			}        
		}
	}
} else {
	// modo generador de lista
	if( $finalizar=="finalizar" ) {
		if ($_SESSION["tipo_tramite"] == "DICTAMEN DE TRAZO, USOS Y DESTINOS ESPECIFICOS" || $_SESSION["tipo_tramite"] == "DICTAMEN DE USOS Y DESTINOS") {
			echo "window.location.assign('../mod_tramites/tabla_dictamenes_dictaminador.php');";
		} elseif ($_SESSION["tipo_tramite"] == "LICENCIA DE CONSTRUCCION") {
                    	echo "window.location.assign('../mod_tramites/tabla_licencias_dictaminador.php');";
        	} elseif ($_SESSION["tipo_tramite"] == "ALINEAMIENTO Y NUMERO OFICIAL") {
                	echo "window.location.assign('../mod_tramites/tabla_alineamiento_numero_dictaminador.php');";
		}
	} elseif ($_REQUEST["cancelar"]=="cancelar") {
	        if ($_SESSION["tipo_tramite"] == "DICTAMEN DE TRAZO, USOS Y DESTINOS ESPECIFICOS" || $_SESSION["tipo_tramite"] == "DICTAMEN DE USOS Y DESTINOS") {
            		echo "window.location.assign('../mod_tramites/tabla_dictamenes_dictaminador.php');";
        	} elseif ($_SESSION["tipo_tramite"] == "LICENCIA DE CONSTRUCCION") {
                	echo "window.location.assign('../mod_tramites/tabla_licencias_dictaminador.php');";
	        } elseif ($_SESSION["tipo_tramite"] == "ALINEAMIENTO Y NUMERO OFICIAL") {
            		echo "window.location.assign('../mod_tramites/tabla_alineamiento_numero_dictaminador.php');";
		}
	}
}
echo '</script>';



/*********DOCUMENT LISTS************/
// dafault values
$required_list = '';  // Required documents list
$optional_list = '';   // Optional documents list
$visible_list = '';    // Visible document list


if (isset($_SESSION["nivel"])) {
	// usuario con nivel de acceso
	if ($_SESSION["nivel"] == 1) {
		// nivel de dictaminador
		// dictaminador debe tener posibilidad de ver cualquier documento anexado
		$required_list = '';
		$optional_list = 'D17,D18'; // posibilidad de anexar los dictamenes sin firmar y firmados
		$visible_list = 'D1,D2,D3,D4,D5,D6,D7,D8,D9,D10,D10A,D11,D12,D13,D14,D15,D16,D17,D18,D19,DOpt';
	}
	if ($_SESSION["nivel"] == 2) {
		// nivel de promotor
		// variables dependen del estado actual de tramite y del tipo de tramite
		if ($_SESSION["tramite_estado"] == 1 || $_SESSION["tramite_estado"] == 4) {
			if ($_SESSION["tipo_tramite"] == "DICTAMEN DE TRAZO, USOS Y DESTINOS ESPECIFICOS") {
				$required_list = 'D1,D5,D10';
				$optional_list = 'D2,D3,D4,D6,D7,D8,D10A,D14,DOpt';
				$visible_list = 'D17,D18';
			}
			if ($_SESSION["tipo_tramite"] == "DICTAMEN DE USOS Y DESTINOS") {
				$required_list = 'D1,D5,D10';
				$optional_list = 'D2,D3,D4,D6,D7,D8,D10A,D14,DOpt';
				$visible_list = 'D17,D18';
			}
			if ($_SESSION["tipo_tramite"] == "LICENCIA DE CONSTRUCCION") {
				$required_list = 'D1,D5,D8,D10';
				$optional_list = 'D2,D3,D4,D6,D7,D9,D10A,D11,D12,D13,D14,D15,D19,DOpt';
				$visible_list = 'D17,D18';
			}
			if ($_SESSION["tipo_tramite"] == "ALINEAMIENTO Y NUMERO OFICIAL") {
				$required_list = 'D1,D5,D8,D10';
				$optional_list = 'D2,D3,D4,D6,D7,D9,D10A,D11,D12,D13,D14,D15,DOpt';
				$visible_list = 'D17,D18';
			}
			if ($_SESSION["tipo_tramite"] == "TRAMITE EN GENERAL") {
				// variables para caso cuando tipo de tramite no estaba definido
				$required_list = 'D1,D5,D10';
				$optional_list = 'D2,D3,D4,D6,D7,D8,D10A,D14,DOpt';
				$visible_list = 'D17,D18';
			}
		} else if ($_SESSION["tramite_estado"] == 3) {
			$required_list = 'D16';
			$optional_list = '';
			$visible_list = 'D17,D18';
		} else {
			$required_list = '';
			$optional_list = '';
			$visible_list = 'D17,D18';
		}
	}
	if ($_SESSION["nivel"] == 3) {
		// nivel de administrador
	}
	if ($_SESSION["nivel"] == 4) {
		// nivel de consultor
	}
	if ($_SESSION["nivel"] == 5) {
		// nivel de capturista
	}
} else {
	// usuario sin nivel de acceso
}


/*********DOCUMENT DEFINITIONS************/
// Defenitions of documen forms
// 'update_form_id' is an unique identifier, rest of names of the elements in the form will derive from this
// 'document_description' - the text that appear in the upper label
// 'user_description' - text input enabled for custom user description (or comment) of the document
$documents = array(
	array(
	'update_form_id' => "D5",
	'document_description' => "Comprobante de domicilio",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D1",
	'document_description' => "Identificación oficial del solicitante",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D2",
	'document_description' => "Identificación oficial del propietario",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D10",
	'document_description' => "Foto de fachada",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D10A",
	'document_description' => "Foto de interior",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D3",
	'document_description' => "Escrituras",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D4",
	'document_description' => "Contrato de compra-venta",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D6",
	'document_description' => "Registro público de propiedad",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D7",
	'document_description' => "Pago de predial actualizado",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D8",
	'document_description' => "Croquis",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D9",
	'document_description' => "Proyecto y planos ejecutivos firmados por director responsable de obra (DRO)",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D11",
	'document_description' => "Comprobante de alineamiento",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D12",
	'document_description' => "Comprobante de asignación del número oficial",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D13",
	'document_description' => "Dictamen de la dirección de obras públicas y desarrollo urbano sobre movimientos de la tierra",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D14",
	'document_description' => "Carta poder",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D15",
	'document_description' => "Dictamen de usos y destinos",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D19",
	'document_description' => "Documento de identificación del perito",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D16",
	'document_description' => "Formato de pago (pagado)",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D17",
	'document_description' => "Dictamen (sin firmas)",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "D18",
	'document_description' => "Dictamen (firmado)",
	'user_description' => FALSE
	),
	array(
	'update_form_id' => "DOpt",
	'document_description' => "Documento opcional considerado por el solicitante",
	'user_description' => TRUE
	)
);

?>

