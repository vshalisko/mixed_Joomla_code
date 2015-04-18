<?php
/**
 * @package		mod_qlform
 * @copyright	Copyright (C) 2014 ql.de All rights reserved.
 * @author 		Mareike Riegel mareike.riegel@ql.de
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;
JHtml::_('jquery.framework');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
require JModuleHelper::getLayoutPath('mod_qlform', 'prefilled_javascriptmodules');
require JModuleHelper::getLayoutPath('mod_qlform', 'prefilled_lmdf');
?>

<style type="text/css">fieldset.additionalFields {display:none;}</style>
<div class="qlform<?php echo $moduleclass_sfx; ?>">
<?php
if (1==$params->get('stylesActive',0))require JModuleHelper::getLayoutPath('mod_qlform', 'prefilled_styles');
if (1==$emailcloak) echo '{emailcloak=off}'; /*very important; disables email cloaking in email inputs!!!!*/
require JModuleHelper::getLayoutPath('mod_qlform', 'prefilled_copyright');

if ((1==$messageType OR 3==$messageType) AND isset($messages)) require JModuleHelper::getLayoutPath('mod_qlform', 'prefilled_message');
if (0==$params->get('hideform') OR (1==$params->get('hideform') AND  (!isset($validated) OR (isset($validated) AND 0==$validated)))) 
{
	if (1==$showpretext) require JModuleHelper::getLayoutPath('mod_qlform', 'prefilled_pretext');
	if (is_object($form)) require JModuleHelper::getLayoutPath('mod_qlform', 'prefilled_form'.ucwords($params->get('stylesHtmltemplate','htmlpure')));
}
if (1==$params->get('backbool') AND isset($validated)) require JModuleHelper::getLayoutPath('mod_qlform', 'prefilled_back');
if (1==$params->get('authorbool')) require JModuleHelper::getLayoutPath('mod_qlform', 'prefilled_author');
?>

<div id="lmdfDataTest"></div>
<input type="hidden" id="lmdfJSONoutside" value="">
</br>

<pre><div id="lmdfXMLout1">[cadena xml formada]</div></pre>


</div>
