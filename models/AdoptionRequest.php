<?php

class AdoptionRequest extends BaseModel
{
    static function createAdoptionRequest($org_id, $animal_id, $user_id, $has_pets, $petsafety, $children, $childsafety)
    {
        $query = "INSERT INTO `adoption_request` ( org_id, animal_id, user_id, has_pets, petsafety, children, childsafety)
VALUES ($org_id, '$animal_id', '$user_id', $has_pets, '$petsafety', $children, '$childsafety')";
        return BaseModel::insert($query);
    }
}

?>