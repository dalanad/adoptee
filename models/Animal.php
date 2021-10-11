<?php
class Animal extends BaseModel
{
    public static function getAnimalById($animalId)
    {
        $query = " SELECT a.*, Round(DATEDIFF(CURRENT_DATE, a.dob) / 365) 'age' FROM animal a where animal_id = :animal_id";
        $animals = self::select($query, ['animal_id' => $animalId]);
        if (sizeof($animals) == 0) {
            throw new Exception("Animal with id '$animalId' Not found", 404);
        }
        return $animals[0];
    }
}
