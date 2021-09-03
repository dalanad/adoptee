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
        $query = "
        SELECT
            a.*,
            afa.*,
            DATEDIFF(CURRENT_DATE, a.dob) / 365 'age',
            o.name 'org_name'
        FROM
            animal_for_adoption afa
        INNER JOIN animal a ON
            a.animal_id = afa.animal_id
        INNER JOIN organization o ON
            o.org_id = afa.org_id    
        ";
        return self::select($query);
    }
}
