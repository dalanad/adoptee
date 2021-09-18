<?php

class AdoptionRequest extends BaseModel
{
    static function createAdoptionRequest( $animal_id, $org_id, $user_id, $has_pets, $petsafety, $children, $childsafety)
    {
        $query = "INSERT INTO `adoption_request` ( animal_id, org_id, user_id, has_pets, petsafety, children, childsafety)
                  VALUES ('$animal_id', $org_id, '$user_id', $has_pets, '$petsafety', $children, '$childsafety')";
        return BaseModel::insert($query);
    }

    public function getPetData($animal_id)
    {
        $query = "SELECT `name`, `gender`, `dob`, `color`, `description`, `type`, `photo`
        FROM  `animal`, `animal_for_adoption` WHERE animal.animal_id = $animal_id
        AND animal_for_adoption.animal_id = $animal_id";
        return BaseModel::select($query);
    }
}

?>