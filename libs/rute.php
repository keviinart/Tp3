<?php
require_once 'router.php';
require_once 'app/controllers/taskapicontroller.php';

$router = new Router();
                // endpoint verbo   controller         metodo
$router->addRoute('tareas', 'GET', 'taskapicontroller', 'getAll');

$router->route($_GET['resource'], $_SERVER  ['REQUEST_METHOD']);
