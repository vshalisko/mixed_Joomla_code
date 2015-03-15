<?php
// No direct access
defined('_JEXEC') or die('Restricted access'); ?>
<div id="divmodslava1" name="divmodslava1">
<h4>
<?php echo $hello;?>
</h4>
<h3>Contenido actual de tabla de tramites</h3>
<pre>
<?php print_r($sql_query_result);?>
</pre>

</br>
<h3>Consulta de resoluciones y dictamenes oara un tramite especifico (introduce código Case ID de la lista)</h3>
<form>
	<input type="text" name="slavadata" />
	<input type="button" name="slavabutton" id="slavabutton" value="Consultar"/>
</form>
<H3><div class="slavastatus">[los resultados de subconsulta deben aparecer aquí]</div></H3>
</div>