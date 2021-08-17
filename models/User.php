<?php

class User extends BaseModel
{
    static function createUser($email, $password, $name, $telephone)
    {
        $query = "INSERT INTO `user` (`email`, `name`, `password`, `telephone`) VALUES ('$email', '$name', '$password', '$telephone')";
        return BaseModel::insert($query);
    }
    
    static function updateProfileData($name, $email, $telephone, $address){

        $query = "INSERT INTO `user`(name, email, telephone, address) 
        VALUES('$name', '$email', $telephone, '$address')";

        return BaseModel::insert($query);
    }
}
