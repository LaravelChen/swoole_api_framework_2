<?php

if ( !function_exists('sign')) {
    function sign($params)
    {
        $sign = new \Lcobucci\JWT\Signer\Hmac\Sha256();
        $token = (new \Lcobucci\JWT\Builder())->setIssuer(\EasySwoole\Config::getInstance()->getConf('SIGN.iss'))
            ->setAudience(\EasySwoole\Config::getInstance()->getConf('SIGN.aud'))
            ->setId($params, true)
            ->setIssuedAt(time())
            ->setExpiration(\EasySwoole\Config::getInstance()->getConf('SIGN.exp'))
            ->sign($sign, \EasySwoole\Config::getInstance()->getConf('SIGN.secret'))
            ->getToken();
        return $token . "";
    }
}

if ( !function_exists('app')) {
    /**
     * 获取Di容器
     *
     * @param  string $abstract
     * @return mixed|\EasySwoole\Core\Component\Di
     */
    function app($abstract = null)
    {
        if (is_null($abstract)) {
            return \EasySwoole\Core\Component\Di::getInstance();
        }

        return \EasySwoole\Core\Component\Di::getInstance()->get($abstract);
    }
}