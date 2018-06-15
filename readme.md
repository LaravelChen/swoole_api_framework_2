## 基于EasySwoole搭建的api框架

![image](https://github.com/LaravelChen/swoole_api_framework_2.x/raw/master/image/screen.png)


> 为何要使用EasySwoole？EasySwoole 是一款基于Swoole Server 开发的常驻内存型的分布式PHP框架，专为API而生，摆脱传统PHP运行模式在进程唤起和文件加载上带来的性能损失。EasySwoole 高度封装了 Swoole Server 而依旧维持 Swoole Server 原有特性，支持同时混合监听HTTP、自定义TCP、UDP协议，让开发者以最低的学习成本和精力编写出多进程，可异步，高可用的应用服务。

-  具体的EasySwoole的内容可以参考官网:https://www.easyswoole.com/

-  如果你很想用Laravel或者Lumen的话也有很好的而选择(使用如下两个进行composer安装即可，亲测，效果很好...):

**laravel-swoole** ：https://github.com/swooletw/laravel-swoole

**laravel-s** ：https://github.com/hhxsv5/laravel-s

### 1.启动做了什么事？

#### 1.1 引入ORM和加载依赖注入

初始化时,将Laravel的ORM集成进来，同时使用EasySwoole本身实现的Di机制，进行加载依赖注入.
如果你想要使用TP或者其他的ORM，可以参考：https://www.easyswoole.com/Manual/2.x/Cn/_book/Database/think_orm.html

```
DataBaseInit::getInstance();#使用Laravel数据库Model形式
ModelProvider::getInstance();#加载依赖注入(主要是加载需要用的Repository)
```


#### 1.2 中间件

在Reuqest全局事件中，添加中间件，进行http的请求拦截，从而实现跨域，签名，token验证等，这里可以自行添加中间件.

```
CORSMiddleware::getInstance()->handle($request, $response);  #跨域中间件处理
SignValidationMiddleware::getInstance()->handle($request, $response);  #签名验证
TokenValidationMiddleware::getInstance()->handle($request, $response);  #token验证
```

### 2.启动项目

```
php easyswoole start
```
postman中请求 http://127.0.0.1:9501/
```
{
    "code": 200,
    "result": "Hello EasySwoole",
    "msg": "success"
}
```

### 3.postman的请求测试路由

https://www.getpostman.com/collections/a791f9c5fbe5137b3bef