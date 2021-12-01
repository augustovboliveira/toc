<?php

class SalaModel
{
    function __construct()
    {
        require '/DbConnect.php';
		$db = new DbConnect();
		$this->con = $db->connect();
    }

    function get_sala_items() {
        $stmt = $this->con->prepare("SELECT id, titulo, data_criacao FROM sala;");
        $stmt->execute();
        $stmt->bind_result($id, $titulo, $data_criacao);

        $sala_itens = array();

        while ($stmt->fetch()) {
            $itens = array();
            $itens['id'] = $id;
            $itens['titulo'] = $titulo;
            $itens['data_criacao'] = $data_criacao;

            array_push($sala_itens, $itens);
        }
        return $sala_itens;
    }

    function post_sala() {

    }

    function put_sala() {

    }

       
}