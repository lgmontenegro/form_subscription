<?php
namespace olx\model;

class Client
{
    protected $password, $conPassword, $email, $conEmail, $nome, $apelido, $rua, 
            $codigoPostal, $localidade, $pais, $nif, $telefone;
    private $tableName;
    private $attributesDataTypes;
    private $databaseType;
    private $connClass;
    
    public function __construct() {
        $this->setTableName();
        $this->setAttributesDataTypes();
        $this->databaseType = \olx\base\ConfigVariables::getDatabaseConfiguration()['databaseType'];
        $classname = "\\olx\\base\\{$this->databaseType}DatabaseConnector";
        $this->connClass = $classname::databaseConnect();
    }
    
    private function setTableName(){
        $this->tableName = "user";
    }
    
    private function setAttributesDataTypes()
    {
        $this->attributesDataTypes = [
            "password"=>"string", 
            "email"=>"string", 
            "nome"=>"string", 
            "apelido"=>"string", 
            "rua"=>"string",
            "codigo_postal"=>"string", 
            "localidade"=>"string",
            "pais"=>"string", 
            "nif"=>"integer", 
            "telefone"=>"integer"
        ];
    }


    public function load($sentFields)
    {
        $ret = extract($sentFields);
        
        $this->email = $email;
        $this->nome = $nome;
        $this->apelido = $apelido;
        $this->rua = $rua;
        $this->codigoPostal = $codigoPostal;
        $this->localidade = $localidade;
        $this->pais = $pais;
        $this->nif = $nif;
        $this->telefone = str_replace(" ", "", $telefone);
        
        $options = [
            'salt' => md5(rand())
        ];
        
        $this->password = password_hash($password, PASSWORD_DEFAULT, $options);
        
        return $ret;
    }
    
    public function save(){
        
        $phpDataBindTypes = \olx\base\ConfigVariables::getDatabaseConfiguration()['phpDataBindTypes'];
        
        $connection = $this->connClass;
        $this->executeInsert($this->valuesToArray(), $this->attributesDataTypes, $this->tableName, $phpDataBindTypes, $connection);
        $connection->close();
    }
    
    private function valuesToArray()
    {
        return [
            'password' => $this->password,
            'email' => $this->email,
            'nome' => $this->nome,
            'apelido' => $this->apelido,
            'rua' => $this->rua,
            'codigo_postal'=> $this->codigoPostal,
            'localidade' => $this->localidade,
            'pais' => $this->pais,
            'nif' => $this->nif,
            'telefone' => $this->telefone
        ];
        
    }
    
    private function executeInsert($valuesToBind, $valuesDataType, $table, $phpDataBindTypes,$connection)
    {
        $insertStatement = $this->prepareInsertStatement($valuesToBind, $table);
        $bindDataType = $this->getBindTypes($valuesDataType, $valuesToBind, $phpDataBindTypes, $connection);
        if (!($statement = $connection->prepare($insertStatement))) {
            echo "Statement: $insertStatement";
            echo "Prepare failed: (" . $connection->errno . ") " . $connection->error;
            return FALSE;
        }
        
        if (!$statement->bind_param($bindDataType, 
                $this->password,
                $this->email,
                $this->nome,
                $this->apelido,
                $this->rua,
                $this->codigoPostal,
                $this->localidade,
                $this->pais,
                $this->nif,
                $this->telefone)
        ) {
            echo "Binding parameters failed: (" . $statement->errno . ") " . $statement->error;
            return FALSE;
        }
  
        if (!$statement->execute()) {
            echo "Execute failed: (" . $statement->errno . ") " . $statement->error;
            return FALSE;
        }

    }
    
    private function prepareInsertStatement($valuesToBind, $table){
        $insertQuery = "insert into $table (";
        $insertQueryBind = "(";
        foreach($valuesToBind as $column => $data){
            $insertQuery .= trim($column).", ";
            $insertQueryBind .= "?, ";
        }
        $insertQuery = rtrim($insertQuery, ", ");
        $insertQueryBind = rtrim($insertQueryBind, ", ");
        $insertQuery .= " ) values $insertQueryBind);";
        return $insertQuery;
    }
    
    private function getBindTypes($valuesDataType, $valuesToBind, $phpDataBindTypes, $connection)
    {
        $bindStringDataTypes = "";
        foreach($valuesToBind as $column => $value){
            if(array_key_exists($column, $valuesDataType)){
                $bindStringDataTypes .= $phpDataBindTypes[$valuesDataType[$column]];
            }
        }
        return $bindStringDataTypes;
    }
    
    private function toBindOnlyValues($valuesToBind){
        $onlyValues = [];
        foreach($valuesToBind as $k=>$v){
            $onlyValues[] = $v;
        }
        return $onlyValues;
    }
    
    public function checkUnique()
    {
        $email = $this->checkEmailUnique();
        $nif = $this->checkNifUnique();
        return ["email"=>$email, "nif"=>$nif];
    }
    
    private function checkEmailUnique()
    {
        $statementQuery = "select count(*) as total from user where email = ?";
        $email = $this->email;
        if($stmt = $this->connClass->prepare($statementQuery)){
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($total);
            $stmt->fetch();
            $stmt->close();
        }
        if($total == 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    private function checkNifUnique()
    {
        $statementQuery = "select count(*) as total from user where nif = ?";
        $nif = $this->nif;
        if($stmt = $this->connClass->prepare($statementQuery)){
            $stmt->bind_param('s', $nif);
            $stmt->execute();
            $stmt->bind_result($total);
            $stmt->fetch();
            $stmt->close();
        }
        if($total == 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}