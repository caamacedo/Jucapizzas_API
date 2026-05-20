<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, DELETE, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Pizza.php';

// Instanciar o banco de dados e conectar
$database = new Database();
$db = $database->getConnection();

// Instanciar o objeto Pizza
$pizza = new Pizza($db);

$method = $_SERVER['REQUEST_METHOD'];

if (in_array($method, array('GET', 'DELETE', 'POST'), true)) {
    try {
        $id = null;

        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        } elseif (!empty($_POST['id'])) {
            $id = $_POST['id'];
        } else {
            $raw = file_get_contents('php://input');
            if (!empty($raw)) {
                $data = json_decode($raw);
                if ($data && !empty($data->id)) {
                    $id = $data->id;
                } elseif ($data && !empty($data->idPizza)) {
                    $id = $data->idPizza;
                } else {
                    parse_str($raw, $parsed);
                    if (!empty($parsed['id'])) {
                        $id = $parsed['id'];
                    }
                }
            }
        }

        if ($id !== null && $id !== '') {
            $pizza->idPizza = $id;

            if ($pizza->delete()) {
                header('HTTP/1.1 200 OK');
                echo json_encode(
                    array('Mensagem' => 'Pizza Excluida com Sucesso')
                );
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(
                    array('Mensagem' => 'Nao foi possivel excluir a Pizza')
                );
            }
        } else {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(
                array('Mensagem' => 'Id nao informado. Nao foi possivel excluir a Pizza.')
            );
        }
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(array('erro' => $e->getMessage()));
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(array('erro' => 'Metodo nao suportado!'));
}
