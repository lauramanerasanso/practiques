<?php

class Noticia{

    protected $conn;

    private $titol;
    private $descripcio;
    private $data_alta;
    private $publicat;

    public function __construct($database){
        $this->conn = $database;
    }

    public function getTitol(){
        return $this->titol;
    }

    public function setTitol($titol){
        $this->titol = $titol;
    }

    public function getDescripcio(){
        return $this->descripcio;
    }

    public function setDescripcio($descripcio){
        $this->descripcio = $descripcio;
    }

    public function getDataAlta(){
        return $this->data_alta;
    }

    public function setDataAlta($data_alta){
        $this->data_alta = $data_alta;
    }

    public function getPublicat(){
        return $this->publicat;
    }

    public function setPublicat($publicat){
        $this->publicat = $publicat;
    }

    public function select($cols){
        
        $select = "";

        if( !empty($cols) ){
            $select = implode(",", $cols);
        }else{
            $select = "*";
        }

        $query = "SELECT $select FROM noticia";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result;

    }

    public function create($titol, $descripcio, $data_alta, $publicat){
        
        $query = "INSERT INTO noticia VALUES (?,?,?,?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $titol, $descripcio, $data_alta, $publicat);
        $stmt->execute();

        return $stmt;

    }

    public function update($titol, $descripcio, $data_alta, $publicat){
        
        $query = "UPDATE noticia SET titol = ?, descripcio = ?, data_alta = ?, publicat = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $titol, $descripcio, $data_alta, $publicat);
        $stmt->execute();

        return $stmt;

    }
}