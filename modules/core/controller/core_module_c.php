<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('coreModule_m');
    $modules = new CoreModule;

    switch ($action){
        case 'read':
            echo $modules->read($_POST);
            break;
        case 'create':
            echo $modules->create($_POST['data']);
            break;
        case 'update':
            echo $modules->update($_POST['data']);
            break;
        case 'destroy':
            echo $modules->destroy($_POST['data']);
            break;            
    }
?>