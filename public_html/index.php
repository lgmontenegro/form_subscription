<?php
include 'config/config_app.php';
$view = filter_input(INPUT_GET, 'view');
$viewFile = "";
if($view){
    $viewFile = 'view/'.trim($view).".phtml";
}else{
    $viewFile = 'view/index.phtml';
}
$template = new olx\base\View($viewFile);
echo $template->render();