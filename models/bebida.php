<?php
class Bebida
{
    private $conn;
    private $tabela = "bebidas";
 
    public $idBebida;
    public $nome;
    public $tamanho;
    public $valor;
    public $categoria;
 
    public function __construct($db) {
        $this->conn = $db;
    }
  public function getall(){
    //Salvando a query nem SQL em uma variável
      $query = "SELECT idBebida, nome, tamanho, valor, categoria FROM "  . $this->tabela;
 
      //Preparando a query para ser executada, ou seja, vinculando ela à conexão
      $stmt = $this->conn->prepare($query);
 
      //Executando a query
      $stmt->execute(); //Executando a query no BD
 
        return $stmt; //Retornando o resultado da query
  }
  public function get(){
    //Localhost/api/pizza/get.php?id=7
    $query = 'SELECT
    idBebida,
    nome,
    tamanho,
    valor,
    categoria
    FROM
    '. $this->tabela .'
    WHERE
    idBebida = ?
    LIMIT 1';
 
  //Preparar a query
  $stmt = $this->conn->prepare($query);
 
  //Vincula o ID
  $stmt->bindParam(1, $this->idBebida);
 
  //Executar a query
  $stmt->execute();
 
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
  // Define as propriedades
  $this->nome = $row['nome'];
  $this->tamanho = $row['tamanho'];
  $this->valor = $row['valor'];
  $this->categoria = $row['categoria'];
 
 
}
 
 
  }
  