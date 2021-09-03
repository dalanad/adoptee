<?php

class Doctor extends BaseModel
{
    public static function createDoctor($user_id, $reg_no, $credentials, $telephone_fixed, Image $proof_image)
    {
        $query = "INSERT INTO doctor (user_id, reg_no, credentials,telephone_fixed, proof_image) 
                  VALUES (:user_id, :reg_no,  :credentials,:telephone_fixed, :proof_image)";

        $params = [
            "user_id" => $user_id,
            "reg_no" => $reg_no,
            "credentials" => $credentials,
            "telephone_fixed" => $telephone_fixed,
            "proof_image" => $proof_image->getURL()
        ];

        return self::insert($query, $params);
    }

    public static function getDoctors()
    {
        return self::select("select * from doctor");
    }

    public static function findByUID($user_id)
    {
        $query = "select *  from `doctor` where user_id= '$user_id'";
        return self::select($query);
    }
}
