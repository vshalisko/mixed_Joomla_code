<?php
/**
 * Template for LMU module
 * @package		mod_lmu1
 * @copyright		Copyright (C) 2015 Viacheslav Shalisko. All rights reserved.
 * @author 		Viacheslav Shalisko vshalisko@gmail.com
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// No direct access
defined('_JEXEC') or die('Restricted access'); ?>

<div class="span10 offset1">

<h3 class="text-warning">Para acceso al sistema de tramite se requiere ingresar al sistema</h3>

<div>Ingresa con su nombre de usuario y contraseña:</div>
<!--
<i class="icon-warning-sign"></i>
<button class="btn btn-large btn-block btn-primary" type="button">Entrar</button>
-->

<?php
// The following code render standard login module
$mod_login_param = array('greeting' => 0);  // param_name = value
$mod_login_params = array('params' => json_encode($mod_login_param)); 
$mod_login = JModuleHelper::getModule("mod_login", "login");
$mod_login_render = JModuleHelper::renderModule($mod_login, $mod_login_params);
print($mod_login_render);
?>
</div>


<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
	$("#user4w").css("display", "none");
});

</script>


