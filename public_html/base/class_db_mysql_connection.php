<?php
namespace olx\base;

class MysqlDatabaseConnector 
{
    public static $database;
    public static $username;
    public static $password;
    public static $hostname;
    public static $port;
    public static $connectionHandle;
    
    protected function __construct() {
    }
    
    public static function databaseConnect()
    {
        $databaseConfig = \olx\base\ConfigVariables::getDatabaseConfiguration();
        
        self::$database = $databaseConfig['databaseName'];
        self::$username = $databaseConfig['databaseUsername'];
        self::$password = $databaseConfig['databasePassword'];
        self::$hostname = $databaseConfig['databaseHostname'];
        self::$port     = $databaseConfig['databasePort'];
        
        self::$connectionHandle = new \mysqli(
            self::$hostname, 
            self::$username, 
            self::$password, 
            self::$database, 
            self::$port
        );

        if (self::$connectionHandle->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->connectionHandle->connect_errno . ") " . $this->connectionHandle->connect_error;
            return false;
        }else{
            return self::$connectionHandle;
        }
    }
}