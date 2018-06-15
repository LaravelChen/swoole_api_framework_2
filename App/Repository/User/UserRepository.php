<?php

namespace App\Repository\User;


use App\Model\User;

class UserRepository
{

    /**
     * 用户列表
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function list()
    {
        return User::all();
    }

    /**
     * 获取一个用户通过手机号
     * @param string $phone
     * @return mixed
     */
    public function getOneByPhone(string $phone)
    {
        return User::where('phone', $phone)->first();
    }

    /**
     * 获取一个用户通过id
     * @param int $id
     * @return mixed
     */
    public function getOneById(int $id)
    {
        return User::find($id);
    }
}