<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class Options extends ResourceController {
    use ResponseTrait;

    public function index() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, OPTIONS, POST, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
         if ($method == "OPTIONS") {
            header("HTTP/1.1 200 OK");
            die();
        }
    }

}