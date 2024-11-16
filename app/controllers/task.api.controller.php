<?php

    require_once 'app/models/model.php';
    require_once 'app/view/php';
    require_once 'libs/router.php';

    class taskapicontroller {
     private $model;
    private $view;

     public function __construct() {
         $this->model = new Model();
         $this->view = new Apiview();
     }   
     function getAll() {
         $equipos = $this->model->getEquipos();
         $this->view->response($equipos, 200);
     }
    } 