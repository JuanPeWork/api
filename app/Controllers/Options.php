<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class Options extends ResourceController
{
    use ResponseTrait;
    public function index() {
        echo 'Success';
    }
}
