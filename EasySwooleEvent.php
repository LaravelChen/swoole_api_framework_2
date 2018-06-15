<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/1/9
 * Time: 下午1:04
 */

namespace EasySwoole;

use App\Com\DataBase\DataBaseInit;
use App\Com\FrameInit\AutoLoad;
use App\Com\Providers\ModelProvider;
use App\Com\Providers\UserCenterProvider;
use App\Middleware\CORSMiddleware;
use App\Middleware\SignValidationMiddleware;
use App\Middleware\TokenValidationMiddleware;
use \EasySwoole\Core\AbstractInterface\EventInterface;
use \EasySwoole\Core\Swoole\ServerManager;
use \EasySwoole\Core\Swoole\EventRegister;
use \EasySwoole\Core\Http\Request;
use \EasySwoole\Core\Http\Response;

Class EasySwooleEvent implements EventInterface
{

    public static function frameInitialize(): void
    {
        DataBaseInit::getInstance();#使用Laravel数据库Model形式
        ModelProvider::getInstance();#加载依赖注入(主要是加载需要用的Repository)
    }

    public static function mainServerCreate(ServerManager $server, EventRegister $register): void
    {
        // TODO: Implement mainServerCreate() method.
    }

    public static function onRequest(Request $request, Response $response): void
    {
        // TODO: Implement onRequest() method.
        CORSMiddleware::getInstance()->handle($request, $response);  #跨域中间件处理
        SignValidationMiddleware::getInstance()->handle($request, $response);  #签名验证
        TokenValidationMiddleware::getInstance()->handle($request, $response);  #token验证
    }

    public static function afterAction(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}