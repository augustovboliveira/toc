<?php
 
class DbOperation
{
	private $con;
	
    function __construct()
    {
		require_once dirname(__FILE__) . '/DbConnect.php';
		$db = new DbConnect();
		$this->con = $db->connect();
    }

    function postStudent($nome, $escola, $email, $senha) {
		$stmt = $this->con->prepare("INSERT INTO estudante (nome, escola, email, senha) VALUES ( ?, ?, ?, ?)");
		$stmt->bind_param("ssss", $nome, $escola, $email, $senha);
		if ($stmt->execute())
			return true; 			
		return false;
	}

    function getStudent() {
		$stmt = $this->con->prepare("SELECT id, nome, escola, email, senha FROM estudante");
		$stmt->execute();
		$stmt->bind_result($id, $nome, $escola, $email, $senha);
		$estudantes = array(); 
		
		while($stmt->fetch()){
			$aluno  = array();
			$aluno['id'] = $id; 
			$aluno['nome'] = $nome; 
			$aluno['escola'] = $escola; 
			$aluno['email'] = $email; 
            $aluno['senha'] = $senha; 
			
			array_push($estudantes, $aluno); 
		}
		return $estudantes; 
	}

	function putUser($id, $nome, $escola, $email, $senha){
		$stmt = $this->con->prepare("UPDATE estudante SET nome = ?, email = ?, instituicao = ?, senha_hash = ? WHERE id = ?");
		$stmt->bind_param("ssssi", $nome, $email, $escola, $senha, $id);
		if ($stmt->execute())
			return true; 
		return false; 
	}
	
	
	function deleteStudent($id) {
		$stmt = $this->con->prepare("DELETE FROM estudante WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if ($stmt->execute())
			return true; 
		return false; 
	}

	function getUserID($email) {
		$stmt = $this->con->prepare("SELECT id FROM estudante WHERE email = '?' LIMIT 1");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->bind_result($id);
		$estudantes = array(); 
	}

	function postMessage($id_remetente, $id_sala, $conteudo) {
		$id_remetente *= 1;
		$id_sala *= 1;
		$stmt = $this->con->prepare("INSERT INTO mensagem (id_remetente, id_sala, conteudo, data_criacao, hora_envio) VALUES ( ?, ?, ?, DATE(NOW()), TIME(NOW()) );");
		$stmt->bind_param("iis", $id_remetente, $id_sala, $conteudo);
		if ($stmt->execute())
			return true; 			
		return false;
	}

	function getMessageJSONResponse() {
		$stmt = $this->con->prepare("SELECT * FROM mensagem");
		$stmt->execute();
		$stmt->bind_result($id, $id_remetente, $id_sala, $mensagem, $data_criacao, $hora_envio);
		
		$mensagens = array(); 
		
		while ($stmt->fetch()) {
			$body_mensagem  = array();
			$body_mensagem['id'] = $id; 
			$body_mensagem['id_remetente'] = $id_remetente; 
			$body_mensagem['id_sala'] = $id_sala; 
			$body_mensagem['conteudo'] = $mensagem; 
            $body_mensagem['data_criacao'] = $data_criacao; 
			$body_mensagem['hora_envio'] = $hora_envio;
			
			array_push($mensagens, $body_mensagem); 
		}
		
		return $mensagens; 
	}

	function getArrayMessage() {
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
			$body_mensagem  = array();
			$body_mensagem['remetente'] = $remetente; 
			$body_mensagem['conteudo'] = $mensagem; 
            $body_mensagem['data_criacao'] = $data_criacao; 
			$body_mensagem['hora_envio'] = $hora_envio;
			
			array_push($mensagens, $body_mensagem); 
		}
		return $mensagens; 
	}
}
