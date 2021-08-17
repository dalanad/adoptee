<?php

class UpdateProfile extends BaseModel{

    static function updateProfileData($name, $email, $telephone, $address){

        $query = "INSERT INTO `user`(name, email, telephone, address) 
        VALUES('$name', '$email', $telephone, '$address')";

        return BaseModel::insert($query);
    }
}

?>