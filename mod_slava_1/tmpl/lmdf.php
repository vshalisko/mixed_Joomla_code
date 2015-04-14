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
defined('_JEXEC') or die('Restricted access'); ?>


<div>

<label for="lmdfInput0" class="lmdfInput0">Etiqueta para el campo de entrada 0 (Introduce texto aquí)</label>
<input type="text" name="lmdfInput0" id="lmdfInput0" />

<label for="lmdfSelector1" class="lmdfSelector1" style="display: none;">Etiqueta para el campo de entrada 1</label>
<select name="lmdfSelector1" id="lmdfSelector1" style="display: none;">
	<option>Elije el tramite</option>
	<option value="Tramite 1">Tramite 1</option>
	<option value="Tramite 2">Tramite 2</option>
	<option value="Tramite 3">Tramite 3</option>
	<option value="Tramite 4">Tramite 4</option>
</select>

<label for="lmdfInput2" class="lmdfInput2" style="display: none;">Etiqueta para el campo de entrada 2</label>
<input type="text" name="lmdfInput2" id="lmdfInput2" style="display: none;" />

<fieldset class="lmdfInput3" style="display: none;">
	<legend class="lmdfInput3" style="display: none;">Leyenda para el grupo de elementos 3 y 4</legend>

	<label for="lmdfInput3" class="lmdfInput3" style="display: none;">Etiqueta para el campo de entrada 3</label>
	<input type="text" name="lmdfInput3" id="lmdfInput3" style="display: none;" />

	<label for="lmdfInput4" class="lmdfInput4" style="display: none;">Etiqueta para el campo de entrada 4</label>
	<input type="text" name="lmdfInput4" id="lmdfInput4" style="display: none;" />
</fieldset>

<fieldset class="lmdfInput5" style="display: none;">
	<legend class="lmdfInput3" style="display: none;">Leyenda para el grupo de elementos 5</legend>
	<label for="lmdfInput5" class="lmdfInput5" style="display: none;">Etiqueta para el campo de entrada 5</label>
	<textarea type="textarea" name="lmdfInput5" id="lmdfInput5" style="display: none;" rows="10" cols="30"></textarea>
</fieldset>

<br />
</div>