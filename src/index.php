<?php
include 'base/config_app.php';

$template = new \base\View('view/index.phtml');
echo $template->render();