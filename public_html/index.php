<?php
include 'base/config_app.php';

$view = filter_input(INPUT_GET, 'view');
$viewFile = "";
if($view){
    $viewFile = 'view/'.trim($view).".phtml";
    if(file_exists($viewFile)){
        $template = new \base\View($viewFile);
    }
}else{
    $template = new \base\View('view/index.phtml');
}


echo $template->render();