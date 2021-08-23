<?php

class Doctor extends BaseModel
{
    static function createDoctor($email, $reg_no, $address, $credentials)
    {
        $query = "INSERT INTO `doctor` (`email`, `reg_no`, `address`, `credentials`) VALUES ('$email', '$reg_no', '$address', '$credentials')";
        return BaseModel::insert($query);
    }

    static public function getDoctors()
    {
       return BaseModel::select("select * from doctor");
    }
}
