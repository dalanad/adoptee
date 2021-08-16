<?php

class UpadateProfile extends BaseModel{

    static function updateProfile($name, $email, $telephone, $address){

        $query = "INSERT INTO `user`(name, email, telephone, address) 
        VALUES('$name', '$email', $telephone, '$address')";

        return BaseModel::insert($query);
    }
}

?>