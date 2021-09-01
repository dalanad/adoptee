<?php

class Doctor extends BaseModel
{
    static function createDoctor($email, $reg_no, $address, $credentials, $telephone_fixed, Image $proof_image)
    {
        $query = "INSERT INTO doctor (email, reg_no, address, credentials,telephone_fixed,proof_image) 
                  VALUES (:email, :reg_no, :address, :credentials,:telephone_fixed,:proof_image)";
        $params = [
            "email" => $email,
            "reg_no" => $reg_no,
            "address" => $address,
            "credentials" => $credentials,
            "telephone_fixed" => $telephone_fixed,
            "proof_image" => $proof_image->getURL()
        ];
        return self::insert($query, $params);
    }

    static public function getDoctors()
    {
        return self::select("select * from doctor");
    }

    public static function findByUID($user_id)
    {
        $query = "select *  from `doctor` where user_id= '$user_id'";
        return self::select($query);
    }
}
