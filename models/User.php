<?php

class User extends BaseModel
{
    static function createUser($name, $email, $telephone, $address, $password)
    {
        $hashed_password = Crypto::hash($password);
        $query = "INSERT INTO `user` (`name`, `email`, `telephone`, `address`, `password`) VALUES ('$name', '$email', '$telephone', '$address', '$hashed_password')";
        return BaseModel::insert($query);
    }
    
    static function updateProfileData($name, $email, $telephone, $address)
    {
        $query = "UPDATE `user` SET 
        name = '$name' ,
        -- WHERE isset($name),
        email = '$email',
        --  WHERE isset($email),
        telephone = $telephone,
        --  WHERE isset($telephone),
        address = '$address',
        --  WHERE isset($address)
        ";
        return BaseModel::insert($query);
    }

    static function findUserByEmail($email){
        $query = "select *  from `user` where email= '$email'" ;
        return BaseModel::select($query)[0];
    }

    static function verifyEmail($email){
        $query = "update `user` set email_verified= 1 where email= $email";
        return BaseModel::update($query);
    }
}
