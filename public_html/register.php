<?php
include "config/config_app.php";

header('Content-Type: application/json');

$error = olx\model\ClientRule::verifyRules($_POST);
if($error){
    $ret = ['error'=>$error];
    $json = json_encode($ret);
    echo $json;
}else{
    $clientData = [];
    foreach($_POST as $field => $value){
        $clientData[$field] = filter_input(INPUT_POST, $field); 
    }
    $client = new olx\model\Client();
    $client->load($clientData);
    $unique = $client->checkUnique();
    
    if($unique["email"] && $unique["nif"]){
        $client->save();
        $ret = ['success'=>'success'];
        $json = json_encode($ret);
        echo $json;
    }else{
        $conflictArray = [];
        if(!$unique['email']){
            $conflictArray['email'] = 'email';
        }
        if(!$unique['nif']){
            $conflictArray['nif'] = 'nif';
        }
        $ret = ['conflict'=>$conflictArray];
        $json = json_encode($ret);
        echo $json;
    }
    exit();
}