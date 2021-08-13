<?php

class User extends BaseModel
{
    static function createUser($data)
    {
        $query = "INSERT INTO `user` (`email`, `name`, `password`, `telephone`) VALUES ('". $data["email"] ."', 'blank', '". $data["password"]."', '')";
        return BaseModel::insert($query);
    }
}
