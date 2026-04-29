<?php
class Database {
    private $host = "localhost";
    private $db_name = "jucapizzasdb";
    private $username = "root";
    private $password = "usbw";
    private $port ="3307";
 
 
    public $conn;
 
    public function getConnection() {
 
    $this -> conn = null;
    try {
     // tenta executar um código potencialmente periogoso
     //DNS (Data Source Name) - String de conexão
     $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ';charset=utf8mb4';
 
        // Instancia o objeto PDO (PHP Data Objects) para estabelecer a conexão com o banco de dados - Usuario e Senha
        $this->conn = new PDO($dsn, $this->username, $this->password);
       
        //Define o modo de erro do PDO para exceção
        //Isso faz com que o PDO lance exceções em caso de erros, facilitando o tratamento
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 
         } catch(PDOException $e) {
 
        //Php Data Obj= PDO
        // código a ser executado se ocorrer um erro
        //Em caso de erro na conxeão, a mensagem de erro é exibida
        echo "Connection error: " . $e->getMessage();
    }catch(Exception $e) {
        echo "Erro: " . $e->getMessage();
    }      
      return $this->conn;
}
}