<?php

namespace App\Com\Providers;


use App\Repository\User\UserRepository;
use EasySwoole\Core\Component\Di;

class ModelProvider
{
    private static $instance;
    private $di;

    function __construct()
    {
        $this->di = Di::getInstance();
        $this->conf();
    }

    static function getInstance()
    {
        if ( !isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function conf()
    {
        $this->di->set('UserRepository', UserRepository::class);
    }
}