<?php

namespace App\Http\Controllers\Api;

use App\Support\Response\Api\Response;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $response = null;

    public function __construct()
    {
        $this->response = new Response();
    }
}
