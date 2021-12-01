<?php

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