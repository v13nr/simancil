<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('identitas_m');
    $identitasx = new Identitas;

    switch ($action){
        case 'read':
            echo $identitasx->read($_POST);
            break;
        case 'create':
            echo $identitasx->create($_POST['data']);
            break;
        case 'update':
            echo $identitasx->update($_POST['data']);
            break;
        case 'destroy':
            echo $identitasx->destroy($_POST['data']);
            break;            
    }
?>