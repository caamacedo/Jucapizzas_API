<?php
if (!function_exists('http_response_code')) {
    function http_response_code($code = null) {
        static $current = 200;
        if ($code === null) {
            return $current;
        }
        $current = (int) $code;
        $protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';
        $messages = array(
            200 => 'OK',
            201 => 'Created',
            400 => 'Bad Request',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        $msg = isset($messages[$current]) ? $messages[$current] : 'Unknown';
        header($protocol . ' ' . $current . ' ' . $msg, true, $current);
        return $current;
    }
}

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
    }catch(Throwable $e) {
        echo "Erro genérico: " . $e->getMessage();
    }      
      return $this->conn;
}
}