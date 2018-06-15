<?php

namespace App\HttpController;


use App\Com\Traits\ValidatorTrait;
use EasySwoole\Core\Http\AbstractInterface\Controller;

class IndexController extends Controller
{
    use ValidatorTrait;

    function index()
    {
        // TODO: Implement index() method.
    }

    public function requestData()
    {
        $data = $this->request()->getRequestParam();
        return $data;
    }

    public function success($data)
    {
        $this->writeJson(200, $data, 'success');
    }

    public function warn($data)
    {
        $this->writeJson($data);
    }
}