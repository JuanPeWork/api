<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ExerciseModel;

class Options extends BaseController
{
    use ResponseTrait;
    public function index() {
        echo 'Success';
    }
}
