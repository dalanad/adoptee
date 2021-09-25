<?php

class Adoptions extends BaseModel
{
    
    public static function searchAnimals()
    {
        $query = "
        SELECT
            a.*,
            afa.*,
            DATEDIFF(CURRENT_DATE, a.dob) / 365 'age',
            o.name 'org_name',
            o.org_id 'org_id'
        FROM
            animal_for_adoption afa
        INNER JOIN animal a ON
            a.animal_id = afa.animal_id
        INNER JOIN organization o ON
            o.org_id = afa.org_id    
        ";
        return self::select($query);
    }

    static function adopteeUpdate($userId, $animalId, $type, $desc, $photo)
    {
        $query = "INSERT INTO routine_updates(user_id, animal_id, type, description, photo, update_date) 
        VALUES('$userId', '$animalId', '$type', '$desc', '$photo', CURRENT_DATE);";
        self::insert($query);
    }
}
