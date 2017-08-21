<?php
namespace olx\base;

class ConfigVariables
{
    public static $databaseConfiguration;
    
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
    
    private static function setDatabaseConfig()
    {
        $arrayDatabaseConfiguration = [];
        $arrayDatabaseConfiguration["databaseType"] = "Mysql";
        $arrayDatabaseConfiguration["databasePassword"] = "password";
        $arrayDatabaseConfiguration["databasePort"] = "3306";
        $arrayDatabaseConfiguration["databaseName"] = "olx_challenge";
        $arrayDatabaseConfiguration["databaseHostname"] = "database";
        $arrayDatabaseConfiguration["databaseUsername"] = "root";
        $arrayDatabaseConfiguration['phpDataBindTypes'] = ["integer"=>"i", "double" => "d", "string" =>"s", "blob" => "b"];
        self::$databaseConfiguration = $arrayDatabaseConfiguration;
    }


    public static function getDatabaseConfiguration()
    {
        self::setDatabaseConfig();
        return self::$databaseConfiguration;
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    
    }
}
