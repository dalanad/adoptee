<?php

class AdoptionRequest extends BaseModel
{
    static function createAdoptionRequest($animal_id, $org_id, $user_id, $has_pets, $petsafety, $children, $childsafety)
    {
        $query = "INSERT INTO `adoption_request` ( `animal_id`, `user_id`, `org_id`, `request_date`, `has_pets`, `petsafety`, `children`, `childsafety`)
                  VALUES ('$animal_id', '$user_id', $org_id, CURDATE(), $has_pets, '$petsafety', $children, '$childsafety');";
        self::insert($query);
        return self::getUserRequest($animal_id, $user_id);
    }

    public function getPetData($animal_id)
    {
        $query = "SELECT * FROM
        (SELECT `name`,animal.animal_id, `gender`, `dob`, `color`, `description`, `type`, `photo`, DATEDIFF(CURRENT_DATE, animal.dob)/365 'age', `photos`, `dewormed`
        FROM  `animal`, `animal_for_adoption`
        WHERE animal.animal_id = $animal_id 
        AND animal_for_adoption.animal_id = $animal_id) 
        animal_data
        LEFT JOIN
        (SELECT * FROM `animal_vaccines` WHERE animal_vaccines.animal_id = $animal_id) animal_vax
        ON animal_data.animal_id = animal_vax.animal_id";
        return self::select($query);
    }

    public function checkRequestsForPet($animal_id)
    {
        $query = "SELECT `status`
        FROM  `adoption_request`
        WHERE animal_id = $animal_id";
        return  self::select($query);
    }

    static function getUserRequest($animalId, $userId)
    {
        $query = "SELECT * FROM `adoption_request` WHERE animal_id = $animalId AND user_id = $userId";
        return self::select($query);
    }
}
