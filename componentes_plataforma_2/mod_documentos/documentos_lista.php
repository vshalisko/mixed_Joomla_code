<?php
// modo del modulo: 1 - generador de formas, 0 - generador de lista
$mod_documentos_mode = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<?php include 'file_uploader_init.php'; ?>

<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<title>Tr&aacute;mites Lagos de Moreno - Revisar documentos anexados</title>    
<link rel="stylesheet" href="../css/style.css" type="text/css">
<link rel="stylesheet" href="../script/jquery-ui/jquery-ui.css">
<!SCRIPT INCLUDE>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<div class="container span8">
<!-- file uploader scripts -->
<?php include 'file_uploader_scripts.php'; ?>
</div>

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

<?php 
	echo "Documentación para el trámite: "; 
	echo (isset($_SESSION["tipo_tramite"])) ? $_SESSION["tipo_tramite"] : '';
?>

</div>
<div id="menu" style="background-color: rgb(238, 238, 238); height: 100%; width: 100%;">
    <form action="documentos_lista.php" method="get">    
<table style="width:100%;">
    <tbody>
        <tr>
<td style="color:brown; vertical-align: top; text-align: left; width:20%; font-weight: bold; font-family:Arial;"><?php echo "<br>Usuario Conectado:<br><br>".$_SESSION["usuario"];?></td>
            <td style="vertical-align: middle; text-align: center; width:60%;">
            <div class="upload-elements">


<!-- file uploader elements -->
<?php include 'file_uploader.php'; ?>



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
                                    <?php include ("../ui_elements/menu/menu_v.php");?>
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
    </form>
</div>
<div id="footer" style="background-color: rgb(109, 143, 49); clear: both; text-align: center; color: white; font-family: Arial;">Copyright &copy; Lagos de Moreno @ Jalisco.gob.mx</div>
</div>  
</body></html>
