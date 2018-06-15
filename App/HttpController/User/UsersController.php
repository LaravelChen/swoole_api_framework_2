<?php

namespace App\HttpController\User;


use App\Com\Response\FrameWorkCode;
use App\HttpController\IndexController;
use EasySwoole\Core\Component\Logger;

/**
 * Class UsersController
 * @package App\HttpController\User
 */
class UsersController extends IndexController
{
    /**
     * 返回Hello EasySwoole文本信息
     * @return bool
     */
    public function index()
    {
        return $this->success("Hello EasySwoole");
    }

    /**
     * 获取用户信息列表(不需要登录)get请求
     * @return bool
     */
    public function userList()
    {
        $users = app('UserRepository')->list();

        return $this->success($users);
    }

    /**
     * 获取用户信息（需要登录）post请求
     * @return bool
     */
    public function getOne()
    {
        $user = app('UserRepository')->getOneById(80);

        return $this->success($user);
    }

    /**
     * 登录接口(参数:email,password,phone)
     * @return bool
     */
    public function login()
    {
        $params = $this->requestData();

        $rule = [
            'email' => 'required|email',
            'phone' => 'required|regex:"^\d{11}$"',
            'password' => 'required|min:3|max:15',
        ];
        $valid = $this->com_validate($params, $rule);
        if ( !$valid['is_valid']) {
            Logger::getInstance()->console($valid['errors']);
            return $this->warn(FrameWorkCode::PARAMETER_ERROR);
        }
        $phone = $params['phone'];
        $user = app('UserRepository')->getOneByPhone($phone);
        if ( !is_null($user) && password_verify($params['password'], $user['password'])) {
            $user['token'] = sign($params['phone']);
            return $this->success($user);
        }

        return $this->warn(FrameWorkCode::NOT_FOUND_USER);
    }
}