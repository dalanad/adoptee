<?php

class User extends BaseModel
{
    static function createUser($name, $email, $telephone, $address, $password)
    {
        $query = "INSERT INTO `user` (`name`, `email`, `telephone`, `address`, `password`) VALUES ('$name', '$email', '$telephone', '$address', '$password')";
        return BaseModel::insert($query);
    }
    
    static function updateProfileData($name, $email, $telephone, $address)
    {
        $query = "UPDATE `user` SET 
        name = '$name' WHERE isset($name),
        email = '$email' WHERE isset($email),
        telephone = $telephone WHERE isset($telephone),
        address = '$address' WHERE isset($address)";
        return BaseModel::insert($query);
    }
}
