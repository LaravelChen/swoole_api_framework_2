<?php

namespace Conf;


use EasySwoole\Core\Component\Spl\SplArray;

class Servlet
{
    private static $instance;
    protected $conf;

    function __construct()
    {
        $conf = $this->conf();
        $this->conf = new SplArray($conf);
    }

    /**
     * @return static
     */
    static function getInstance()
    {
        if ( !isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * @param $keyPath
     * @return array|mixed|null
     */
    function getConf($keyPath)
    {
        return $this->conf->get($keyPath);
    }

    /*
    * 在server启动以后，无法动态的去添加，修改配置信息（进程数据独立）
    */
    /**
     * @param $keyPath
     * @param $data
     */
    function setConf($keyPath, $data)
    {
        $this->conf->set($keyPath, $data);
    }

    /**
     * 设置不用登录的路由
     * @return array
     */
    function conf()
    {
        return [
            "NOT_LOGIN" => [
                '/',
                '/login',
                '/list',
            ],
        ];
    }

}