<?php
include 'config/config_app.php';
$template = new olx\base\View('view/success.phtml');
echo $template->render();