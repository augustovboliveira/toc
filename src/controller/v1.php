<?php 
	require_once dirname(__FILE__) . '/../db/DbOperation.php';

	function isTheseParametersAvailable($params) {
		$available = true; 
		$missingparams = ""; 
		
		foreach ($params as $param) {
			if (!isset($_POST[$param]) || strlen($_POST[$param]) <= 0) {
				$available = false; 
				$missingparams = $missingparams . ", " . $param; 
			}
		}
		
		if(!$available){
			$response = array(); 
			$response['error'] = true; 
			$response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
		
			echo json_encode($response);
			die();
		}
	}
	$response = array();
	
	if (isset($_GET['apicall'])) {
		switch ($_GET['apicall']) {
			case 'poststudent':
				isTheseParametersAvailable(array('nome','escola','email', 'senha'));
				
				$db = new DbOperation();
				$result = $db->postStudent(
					$_POST['nome'],
					$_POST['escola'],
					$_POST['email'],
					$_POST['senha']
				);
				
				if ($result) {
					$response['error'] = false; 
					$response['message'] = 'Cadastro realizado com sucesso';
					$response['estudante'] = $db->getStudent();
				} else {
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break;
            
            case 'getstudent':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['estudante'] = $db->getStudent();
			break;  

			case 'putstudent':
				isTheseParametersAvailable(array('id','nome','email','escola','senha'));
				$db = new DbOperation();
				$result = $db->putStudent(
					$_POST['id'],
					$_POST['nome'],
					$_POST['email'],
					$_POST['escola'],
					$_POST['senha']
				);
				
				if ($result) {
					$response['error'] = false; 
					$response['message'] = 'Estudante atualizado com sucesso';
					$response['estudantes'] = $db->getEstudante();
				} else {
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			case 'deletestudent':
				if (isset($_GET['id'])) {
					$db = new DbOperation();

					if ($db->deleteStudent($_GET['id'])) {
						$response['error'] = false; 
						$response['message'] = 'Estudante excluído com sucesso';
						$response['heroes'] = $db->getStudent();
					} else {
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				} else {
					$response['error'] = true; 
					$response['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break;

			case 'postmessage':
				isTheseParametersAvailable(array('id_remetente','id_sala','conteudo'));
				$db = new DbOperation();
				$result = $db->postMessage(
					$_POST['id_remetente'],
					$_POST['id_sala'],
					$_POST['conteudo']
				);

				if ($result) {
					$response['error'] = false;
					$response['message'] = 'Pedido concluído com sucesso';
					$response['mensagens'] = $db->getMessage();
				} else {
					
					$response['error'] = true;
					$response['message'] = 'Algo deu errado com a requisição POST';
				}
			break;

			case 'getmessagejsonresponse':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['mensagens'] = $db->getMessageJSONResponse();
			break;  

			case 'getarraymessage':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['mensagens'] = $db->getArrayMessage();
			break;  
        }
    } else {
		$response['error'] = true; 
		$response['message'] = 'Chamada de API inválida';
	}
	echo json_encode($response);