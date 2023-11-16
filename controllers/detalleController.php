<?php 
$chipId = explode('=', $_SERVER['REQUEST_URI']);
$tpl = file_get_contents('views/detalle.html');
$tpl = str_replace("{{CHIP}}", $chipId[1], $tpl);
echo($tpl);
 ?>