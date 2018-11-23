<?php
require_once '../php52/controller/controllerRegistration.php';

$login = new Registration();
$login->login();

$reg = new Registration();
$reg->registerUser();

$templateReg = $twig->loadTemplate('templateRegistration.html');
echo $templateReg->render(array('the' => 'variables', 'go' => 'here'));

?>



