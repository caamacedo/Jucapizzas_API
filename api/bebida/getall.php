<?php
// Headers obrigatórios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Incluir arquivos
include_once '../../config/Database.php';
include_once '../../models/bebida.php';

// Conexão com o banco
$database = new Database();
$db = $database->getConnection();

// Instanciar a classe correta
$bebidas = new Bebida($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $stmt = $bebidas->getall();
    $num = $stmt->rowCount();

    if ($num > 0) {

        $bebidas_arr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $bebidas_item = array(
                "id" => $idBebida,
                "nome" => $nome,
                "tamanho" => $tamanho,
                "valor" => $valor,
                "categoria" => $categoria
            );

            array_push($bebidas_arr, $bebida_item);
        }

        http_response_code(200);
        echo json_encode($bebidas_arr);

    } else {

        http_response_code(404);
        echo json_encode(array("mensagem" => "Nenhuma bebida encontrada."));
    }

} else {

    http_response_code(405);
    echo json_encode(array("mensagem" => "Método não permitido."));
}