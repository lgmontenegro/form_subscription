<?php
namespace olx\test;

class Make
{
    private $name;
    private $args;
    private $repositoryPath;
    private $testResult;
    
    public function __construct($name, array $args) {
        $this->name = $name;
        $this->args = $args;
        $this->repositoryPath = __DIR__."/testRepository/";
    }
    
    public function getTest(){
        $jsonTestPath = $this->repositoryPath . $this->name . ".json";
        echo $jsonTestPath . "<br>";
        if(file_exists($jsonTestPath)){
            $json = file_get_contents($jsonTestPath);
        }else{
            return false;
        }
        return $json;
    }
}
