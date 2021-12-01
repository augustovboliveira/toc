<?php

require '../../model/EstudanteModel.php';
require '../ParametrosController.php';

$response = array();

if (isset($_GET['apicall'])) {
    switch ($_GET['apicall']) {
        case 'post_estudante':
            isTheseParametersAvailable(array('nome','escola','email', 'senha'));
            
            $model = new EstudanteModel();
            $result = $model->post_estudante(
                $_POST['nome'],
                $_POST['escola'],
                $_POST['email'],
                $_POST['senha']
            );
            
            if ($result) {
                $response['error'] = false; 
                $response['message'] = 'Cadastro realizado com sucesso';
                $response['estudante'] = $model->get_all_estudante();
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
    } 
} else {
    $response['error'] = true; 
    $response['message'] = 'Chamada de API inválida';
}

echo json_encode($response);