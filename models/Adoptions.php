<?php

class Adoptions extends BaseModel
{

    public static function searchAnimals($filter)
    {
        $query = "SELECT
                    a.*,
                    afa.*,
                    DATEDIFF(CURRENT_DATE, a.dob) / 365 'age',
                    o.name 'org_name',
                    o.org_id 'org_id'
        FROM animal_for_adoption afa, animal  a, organization o
        WHERE a.animal_id = afa.animal_id
        AND o.org_id = afa.org_id      ";

        //filters
        //gender
        $gender = $filter["gender"];
        if($gender !="ANY"){
            $query = $query . " AND a.gender ='$gender' ";
        }

        //age
        $age = $filter["age"];
        if($age != ""){
            $query = $query . " AND DATEDIFF(CURRENT_DATE, a.dob) / 365 <= $age ";
        }

        //type
        $type = $filter['animal_type'];
        if(sizeof($type) > 0){
            $query = $query . " AND a.type IN ('" . implode("','", $type) . "') ";
        }

        //color
        $colors = $filter['color'];
        if(sizeof($colors) > 0){
            $query = $query . " AND JSON_CONTAINS(a.color, '[\"" . implode('","', $colors) . "\"]' )";
        }
        

        //organization
        $organization = $filter['organization'];
        if(sizeof($organization) > 0){
            $query = $query . " AND o.org_id IN ('" . implode("','", $organization) . "') ";
        }

        //sort
        $sort = $filter['sort'];
        $order = $filter['order'];
        if(isset($sort) && $sort != "date-listed"){
            $query = $query . " ORDER BY $sort $order ";
        }

        return self::select($query);
    }

    static function adopteeUpdate($userId, $animalId, $type, $desc, $photo)
    {
        $query = "INSERT INTO routine_updates(user_id, animal_id, type, description, photo, update_date) 
        VALUES('$userId', '$animalId', '$type', '$desc', '$photo', CURRENT_DATE);";
        self::insert($query);
    }
}
