<?php
namespace model;

class Client
{
    protected $password, $conPassword, $email, $conEmail, $nome, $apelido, $rua, $codigoPostal, $localidade, 
            $pais, $nif, $telefone;
    
    public function load($sentFields)
    {
        $ret = extract($sentFields);
        
        $this->password = $password;
        $this->conPassword = $conPass;
        $this->email = $email;
        $this->conEmail = $confEmail;
        $this->nome = $nome;
        $this->apelido = $apelido;
        $this->rua = $rua;
        $this->codigoPostal = $codigoPostal;
        $this->localidade = $localidade;
        $this->pais = $pais;
        $this->nif = $nif;
        $this->telefone = $telefone;
        
        return $ret;
    }
    
    
}