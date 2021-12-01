<?php 
	require '../model/EstudanteModel.php';
	require '../model/MensagemModel.php';
	require 'ParametrosController.php';

	$response = array();
	
	if (isset($_GET['apicall'])) {
		switch ($_GET['apicall']) {
			case 'post_estudante':
				isTheseParametersAvailable(array('nome','escola','email', 'senha'));
				
				$db = new EstudanteModel();
				$result = $db->post_estudante(
					$_POST['nome'],
					$_POST['escola'],
					$_POST['email'],
					$_POST['senha']
				);
				
				if ($result) {
					$response['error'] = false; 
					$response['message'] = 'Cadastro realizado com sucesso';
					$response['estudante'] = $db->get_all_estudante();
				} else {
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break;
            
            case 'get_all_estudante':
				$model = new EstudanteModel();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['estudantes'] = $model->get_all_estudante();
			break;  

			case 'get_estudante_id':
				isTheseParametersAvailable(array('nome'));
				$model = new EstudanteModel();
				$result = $model->get_estudante_id($_GET['nome']);

				if ($result) {
					$response['error'] = false; 
					$response['message'] = 'Pedido concluído com sucesso';
					$response['estudantes'] = $model->get_all_estudante();
				} else {
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break;  

			case 'put_estudante':
				isTheseParametersAvailable(array('id','nome','email','escola','senha'));
				$db = new EstudanteModel();
				$result = $db->put_estudante(
					$_POST['id'],
					$_POST['nome'],
					$_POST['email'],
					$_POST['escola'],
					$_POST['senha']
				);
				
				if ($result) {
					$response['error'] = false; 
					$response['message'] = 'Estudante atualizado com sucesso';
					$response['estudantes'] = $db->get_all_estudante();
				} else {
					$response['error'] = true; 
					$response['message'] = 'Algum erro ocorreu por favor tente novamente';
				}
			break; 
			
			case 'delete_estudante':
				if (isset($_GET['id'])) {
					$db = new DbOperation();

					if ($db->deleteStudent($_GET['id'])) {
						$response['error'] = false; 
						$response['message'] = 'Estudante excluído com sucesso';
						$response['heroes'] = $db->get_all_estudante();
					} else {
						$response['error'] = true; 
						$response['message'] = 'Algum erro ocorreu por favor tente novamente';
					}
				} else {
					$response['error'] = true; 
					$response['message'] = 'Não foi possível deletar, forneça um id por favor';
				}
			break;

			case 'post_mensagem':
				isTheseParametersAvailable(array('id_remetente','id_sala','conteudo'));
				$db = new DbOperation();
				$result = $db->post_mensagem(
					$_POST['id_remetente'],
					$_POST['id_sala'],
					$_POST['conteudo']
				);

				if ($result) {
					$response['error'] = false;
					$response['message'] = 'Pedido concluído com sucesso';
					$response['mensagens'] = $db->get_all_mensagem();
				} else {
					
					$response['error'] = true;
					$response['message'] = 'Algo deu errado com a requisição POST';
				}
			break;

			case 'get_mensagem_multiarray':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['mensagens'] = $db->get_mensagem_multiarray();
			break;  

			case 'get_mensagem_array':
				$db = new DbOperation();
				$response['error'] = false; 
				$response['message'] = 'Pedido concluído com sucesso';
				$response['mensagens'] = $db->get_mensagem_array();
			break;  
        }
    } else {
		$response['error'] = true; 
		$response['message'] = 'Chamada de API inválida';
	}
	echo json_encode($response);