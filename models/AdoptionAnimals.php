<?php

class AdoptionAnimals extends BaseModel
{
    static function createNewAnimal($org_id, $type, $other, $gender, $dob, $color, $description, $photo)
    {
        $query = " INSERT INTO `animal` (type, other, gender, dob, color) VALUES ('$type', '$other', '$gender', '$dob', '$color')";
        echo($query);
        BaseModel::insert($query);
        $animal_ID = BaseModel::lastInsertId();

        $query = "INSERT INTO `animal_for_adoption` (animal_id, org_id, description)
                  VALUES ('$animal_ID', '$org_id', '$description')";
        return BaseModel::insert($query);
    }

    static function findAnimalsByOrgId($org_id)
    {
        $query = "select name,type,dob,gender,date_listed,status,date_adopted from animal_for_adoption,animal where org_id= $org_id";
        return BaseModel::select($query);
    }

    static function findRequestsByOrgId($org_id)
    {
        $query = "select * from adoption_request where org_id= $org_id";
        return BaseModel::select($query);
    }

    public static function searchAnimals()
    {
        $query = "select * from animal_for_adoption";
        return self::select($query);
    }
}
