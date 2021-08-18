<?php

class AdoptionAnimals extends BaseModel
{
    static function createNewAnimal($org_id, $animal_id, $animal_type, $gender, $age_years, $age_months, $age_weeks, $age_days, $color, $animal_description, $photo)
    {
        $query = "INSERT INTO `animal_for_adoption` (org_id, animal_id, animal_type, gender, age_years, age_months, age_weeks, age_days, color, animal_description, photo)
VALUES ($org_id, '$animal_id', '$animal_type', '$gender', $age_years, $age_months, $age_weeks, $age_days, '$color', '$animal_description', '$photo')";
        return BaseModel::insert($query);
    }

    static function findAnimalsByOrgId($org_id){
        $query = "select * from animal_for_adoption where org_id= $org_id";
        return BaseModel::select($query);
    }
}

?>