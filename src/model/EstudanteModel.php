<?php

class EstudanteModel
{
    private $con;

    function __construct()
    {
        require 'DbConnect.php';
		$db = new DbConnect();
		$this->con = $db->connect();
    }

    function post_estudante($nome, $escola, $email, $senha) {
		$stmt = $this->con->prepare("INSERT INTO estudante (nome, escola, email, senha) VALUES ( ?, ?, ?, ?)");
		$stmt->bind_param("ssss", $nome, $escola, $email, $senha);
		if ($stmt->execute())
			return true; 			
		return false;
	}

    function get_all_estudante() {
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

    function get_estudante_id($nome) {
		$stmt = $this->con->prepare("SELECT id FROM estudante WHERE nome = '?' LIMIT 1");
		$stmt->bind_param("s", $nome);
		$stmt->execute();
		$stmt->bind_result($id);

		$result = array(); 

		while ($stmt->fetch()) {
			$item = array();

			$item['id'] = $id;

			array_push($result, $item);
		}
		return $result;
	}

	function put_estudante($id, $nome, $escola, $email, $senha){
		$stmt = $this->con->prepare("UPDATE estudante SET nome = ?, email = ?, instituicao = ?, senha_hash = ? WHERE id = ?");
		$stmt->bind_param("ssssi", $nome, $email, $escola, $senha, $id);
		if ($stmt->execute())
			return true; 
		return false; 
	}
	
	
	function delete_estudante($id) {
		$stmt = $this->con->prepare("DELETE FROM estudante WHERE id = ? ");
		$stmt->bind_param("i", $id);
		if ($stmt->execute())
			return true; 
		return false; 
	}
}