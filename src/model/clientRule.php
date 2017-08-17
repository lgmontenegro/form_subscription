<?php
namespace helper;
class ClientRule
{
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
    
    public static function verifyRules($postData)
    {
        foreach($postData as $field => $data){
            $data = trim($data);
            if(empty($data)){
                $erro[] = trim($field);
            }
        }
            
        extract($postData);

        if($email!=$confEmail){
            $erro[] = 'email';
        }
        if($password!=$conPass){
            $erro[]='password';
        }
        $nif = (int)str_replace(' ', '', $nif);
        if(!is_int($nif) || sizeof($nif)==0){
            $erro[] = 'nif';
        }
        if($pais == 'Portugal'){
            $tel = explode(' ', $telefone);
            if(count($tel) != 3){
                $erro[] = 'telefone';
            }
        }
        
        return $erro;
        
    }
    
    
}