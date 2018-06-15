<?php

namespace App\Middleware;


use App\Com\Response\FrameWorkCode;
use Conf\Servlet;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class TokenValidationMiddleware
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
            $not_login = Servlet::getInstance()->getConf("NOT_LOGIN");
            $path = $request->getUri()->getPath();
            if ( !in_array($path, $not_login)) {
                $head = $request->getHeader("authorization");
                $token=$head[0];
                if ( !$token) {
                    $response->write(json_encode(FrameWorkCode::ERROR_TOKEN));
                    $response->withHeader('Content-type', 'application/json;charset=utf-8');
                    return $response->end();
                }
                $token = (new Parser())->parse($token);
                $data = new ValidationData();
                if ( !$token->validate($data)) {
                    $response->write(json_encode(FrameWorkCode::ERROR_TOKEN));
                    $response->withHeader('Content-type', 'application/json;charset=utf-8');
                    return $response->end();
                }
            }
        }

    }
}