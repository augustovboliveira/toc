<?php
 
class MensagemModel
{
	private $con;
	
    function __construct()
    {
		require 'DbConnect.php';
		$db = new DbConnect();
		$this->con = $db->connect();
    }	

	function post_mensagem($id_remetente, $id_sala, $conteudo) {
		$id_remetente *= 1;
		$id_sala *= 1;
		$stmt = $this->con->prepare("INSERT INTO mensagem (id_remetente, id_sala, conteudo, data_criacao, hora_envio) VALUES ( ?, ?, ?, DATE(NOW()), TIME(NOW()) );");
		$stmt->bind_param("iis", $id_remetente, $id_sala, $conteudo);
		if ($stmt->execute())
			return true; 			
		return false;
	}

	function get_mensagem_multiarray() {
		$stmt = $this->con->prepare("SELECT id, id_remetente, id_sala, conteudo, data_criacao, hora_envio FROM mensagem;");
		$stmt->execute();
		$stmt->bind_result($id, $id_remetente, $id_sala, $conteudo, $data_criacao, $hora_envio);
		
		$mensagens = array(); 
		
		while ($stmt->fetch()) {
			$mensagem  = array();
			$mensagem['id'] = $id; 
			$mensagem['id_remetente'] = $id_remetente; 
			$mensagem['id_sala'] = $id_sala; 
			$mensagem['conteudo'] = $conteudo; 
            $mensagem['data_criacao'] = $data_criacao; 
			$mensagem['hora_envio'] = $hora_envio;
			
			array_push($mensagens, $mensagem); 
		}
		
		return $mensagens; 
	}

	function get_mensagem_array() {
		$stmt = $this->con->prepare("SELECT estudante.nome, 
										mensagem.conteudo,
										mensagem.data_criacao,
										mensagem.hora_envio
											FROM mensagem
											INNER JOIN estudante
											ON estudante.id = mensagem.id_remetente;");
		
		$stmt->execute();
		$stmt->bind_result($remetente, $mensagem, $data_criacao, $hora_envio);
		
		$mensagens = array(); 
		
		while($stmt->fetch()){
			$mensagem  = array();
			$mensagem['remetente'] = $remetente; 
			$mensagem['conteudo'] = $mensagem; 
            $mensagem['data_criacao'] = $data_criacao; 
			$mensagem['hora_envio'] = $hora_envio;
			
			array_push($mensagens, $mensagem); 
		}
		return $mensagens; 
	}
}
