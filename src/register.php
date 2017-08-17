<?php
include 'model/client.php';
include 'model/clientRule.php';


header('Content-Type: application/json');
$error = helper\ClientRule::verifyRules($_POST);
if($error){
    $ret = ['error'=>$error];
    $json = json_encode($ret);
    echo $json;
    exit();
}else{
    $clientData = [];
    foreach($_POST as $field => $value){
        $clientData[$field] = filter_input(INPUT_POST, $field); 
    }
    $client = new model\Client();
    $client->load($clientData);
    
    $ret = ['success'=>'success'];
    $json = json_encode($ret);
    echo $json;
    exit();
}