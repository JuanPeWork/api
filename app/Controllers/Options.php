<?php

namespace App\Controllers;

class Options extends BaseController
{
    public function index()
    {
        $this->response->setStatusCode(200);
        return $this->response;
    }
}
