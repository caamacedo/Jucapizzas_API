<?php
class Pizza 
{
    private $conn;
    private $table_ = "pizzas";

    private $idPizza;
    private $name;
    private $ingredientes;
    private $valor;

    public function __construct($db) {
        $this->conn = $db;
    }

    


    