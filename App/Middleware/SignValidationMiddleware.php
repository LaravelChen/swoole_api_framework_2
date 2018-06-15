<?php

namespace App\Middleware;


use App\Com\Response\FrameWorkCode;
use EasySwoole\Config;

class SignValidationMiddleware
{
    protected static $instance;

    public static function getInstance()
    {
        if ( !isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function handle($request, $response)
    {
        $server = $request->getServerParams();
        if ($server['request_method'] !== "OPTIONS") {
            $header = $request->getHeader("sign");
            $sign = $header[0];
            $encrypt = $request->getUri()->getPath() . Config::getInstance()->getConf('VERSION') . Config::getInstance()->getConf('SALT');
            $encrypt = md5($encrypt);
            if ($sign != $encrypt) {
                if (Config::getInstance()->getConf('ENV') == 'dev') {
                    $response->write(json_encode(['code' => 500, 'result' => ['message' => '签名不匹配!', 'sign' => $encrypt], 'msg' => FrameWorkCode::FLAG_NOTICE]));
                } else {
                    $response->write(json_encode(FrameWorkCode::ERROR_SIGN));
                }
                $response->withHeader('Content-type', 'application/json;charset=utf-8');
                return $response->end();
            }
        }
    }
}