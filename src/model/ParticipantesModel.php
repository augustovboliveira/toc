<?php

class ParticipantesModel
{
    function __construct()
    {
        require '/DbConnect.php';
		$db = new DbConnect();
		$this->con = $db->connect();
    }

    function get_sala_id($id_estudante) {
        $stmt = $this->con->prepare("SELECT id_sala FROM participantes INNER JOIN sala ON sala.id = participantes.id_sala WHERE participantes.id_estudante = ?;");
        $stmt->execute();
        $stmt->bind_result($id_sala);

        $item_id = array();

        while ($stmt->fetch()) {
            $item = array();
            $item['id'] = $id;

            array_push($item_id, $item);
        }

        return $item_id;
    } 

    function get_all_estudante_id($sala) {

    }

    function post_id_estudante() {

    }

    function post_id_sala() {

    }
}