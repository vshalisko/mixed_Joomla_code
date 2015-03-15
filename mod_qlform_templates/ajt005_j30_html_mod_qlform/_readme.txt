The modification of layout for mod_qlform template is according ot documentotion in author's site.
The modified layout (prefilled) was tested with ajt005_030 template


This is documentation page taken form 
http://www.ql.de/index.php/joomla/joomla-downloads/mod-qlform/doc/158-prefilled-data-in-form


mod_qlform - Documentation
Prefilled data in form
mod_qlform can do this, if you use an override or - even better - an alternative layout.
Do as follows:

Create alternative layout:
go to modules/mod_qlform/tmpl/
copy all the files in this folder to templates/yourTemplateName/tmpl/mod_qlform/
rename the files from "default" to "prefilled"
go to "prefilled.php" and replace "default" by "prefilled"
Activate alternative layout for 2nd form (with the prefilled data)
J! backend: modules>prefilled module>advanced settings>
choose here layout "prefilled"
Get data 
go to templates/yourTemplateName/html/mod_qlform/prefilled_form.php
add the following 3 bold lines after the "defined('_JEXEC') or die;" line, about line 10:
either hardcoded data
$dataToBind=new stdClass;
$dataToBind->name='Hungry Hamster';
$dataToBind->street='Grain Street 14';
$dataToBind->city='Corn field';
or post data 
$dataToBind=new stdClass;
if (isset($_POST['jform'])) foreach ($_POST['jform'] as $k=>$v) $dataToBind->$k=$v;
Bind data to form
go to templates/yourTemplateName/html/mod_qlform/prefilled_form.php
add following line behind your data generation
$form->bind($dataToBind);
That's it, three lines!