<?php

require '../../model/MensagemModel.php';
require '../ParametrosController.php';

$response = array();

if (isset($_GET['apicall'])) {
    switch ($_GET['apicall']) {
        case 'post_mensagem':
            isTheseParametersAvailable(array('id_remetente','id_sala','conteudo'));
            $model = new MensagemModel();
            $result = $model->post_mensagem(
                $_POST['id_remetente'],
                $_POST['id_sala'],
                $_POST['conteudo']
            );

            if ($result) {
                $response['error'] = false;
                $response['message'] = 'Pedido concluído com sucesso';
                $response['mensagens'] = $model->get_all_mensagem();
            } else {
                
                $response['error'] = true;
                $response['message'] = 'Algo deu errado com a requisição POST';
            }
        break;

        case 'get_mensagem_multiarray':
            $model = new MensagemModel();
            $response['error'] = false; 
            $response['message'] = 'Pedido concluído com sucesso';
            $response['mensagens'] = $model->get_mensagem_multiarray();
        break;  

        case 'get_mensagem_array':
            $model = new MensagemModel();
            $response['error'] = false; 
            $response['message'] = 'Pedido concluído com sucesso';
            $response['mensagens'] = $model->get_mensagem_array();
        break; 
    } 
} else {
    $response['error'] = true; 
    $response['message'] = 'Chamada de API inválida';
}

echo json_encode($response);