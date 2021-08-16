<?php

class User extends BaseModel
{
    static function createUser($email, $password, $name, $telephone)
    {
        $query = "INSERT INTO `user` (`email`, `name`, `password`, `telephone`) VALUES ('$email', '$name', '$password', '$telephone')";
        return BaseModel::insert($query);
    }
}
