<?php

class User extends BaseModel
{
    static function matchPasswords($pass1, $pass2){
        if($pass1 == $pass2){
            return true;
        }else{ return false;}
    }

    static function createUser($name, $email, $telephone, $address, $password)
    {
        $hashed_password = Crypto::hash($password);
        $query = "INSERT INTO `user` (`name`, `email`, `telephone`, `address`, `password`) VALUES ('$name', '$email', '$telephone', '$address', '$hashed_password')";
        return BaseModel::insert($query);
    }
    
    static function updateProfileData($name, $email, $telephone, $address)
    {
        $query = "UPDATE `user` SET name = '$name' WHERE isset($name);
        UPDATE `user` SET email = '$email' WHERE isset($email);
        UPDATE `user` SET telephone = $telephone WHERE isset($telephone);
        UPDATE `user` SET address = '$address' WHERE isset($address)";
        return BaseModel::insert($query);
    }

    static function findUserByEmail($email){
        $query = "select *  from `user` where email= '$email'" ;
        return BaseModel::select($query)[0];
    }

    static function verifyEmail($email){
        $query = "update `user` set email_verified = 1 where email= '$email'";
        return BaseModel::update($query);
    }

    static function changePassword($email, $new){
        $hashed_password = Crypto::hash($new);
        $query = "UPDATE user set password= '$hashed_password' WHERE email = '$email'";
        return BaseModel::update($query);
    }

}
