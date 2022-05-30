<?php

class AdoptionRequest extends BaseModel
{
    static function createAdoptionRequest($animalId, $orgId, $userId, $hasPets, $petSafety, $children, $childSafety)
    {
        $query = "INSERT INTO `adoption_request` ( `animal_id`, `user_id`, `org_id`, `request_date`, `has_pets`, `petsafety`, `children`, `childsafety`)
                  VALUES (:animal_id, :user_id, :org_id, CURDATE(), :has_pets, :pet_safety, :children, :child_safety);";

        self::insert($query, [
            "animal_id" => $animalId,
            "user_id" => $userId,
            "org_id" => $orgId,
            "has_pets" => $hasPets,
            "pet_safety" => $petSafety,
            "children" => $children,
            "child_safety" => $childSafety
        ]);

        return self::getUserRequest($animalId, $userId);
    }

    public function getPetData($animalId)
    {
        $query = "SELECT * FROM
            (   
                SELECT `name`, animal.animal_id, `gender`, `dob`, `color`, `description`, `type`, `photo`, 
                        DATEDIFF(CURRENT_DATE, animal.dob) / 365 'age', `photos`, `dewormed`
                FROM `animal`, `animal_for_adoption`
                WHERE animal.animal_id = :animal_id AND animal_for_adoption.animal_id = :animal_id
            ) animal_data
            LEFT JOIN
            (
                SELECT * FROM `animal_vaccines`
                WHERE animal_vaccines.animal_id = :animal_id
            ) animal_vax
            ON animal_data.animal_id = animal_vax.animal_id ";

        return self::select($query, ["animal_id" => $animalId]);
    }

    public function checkRequestsForPet($animalId)
    {
        $query = "SELECT `status` FROM  `adoption_request` WHERE animal_id = :animal_id";
        return  self::select($query, ["animal_id" => $animalId]);
    }

    static function getUserRequest($animalId, $userId)
    {
        $query = "SELECT * FROM `adoption_request` WHERE animal_id = :animal_id AND user_id = :user_id";
        return self::select($query, ["animal_id" => $animalId, "user_id" => $userId]);
    }
}
