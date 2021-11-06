<?php

class OrgManagement extends BaseModel
{
    static function createNewAnimal($org_id, $name, $type, $other, $gender, $dob, $color, $description, $anti_rabies, $dhl, $parvo, $tricat, $anti_rabies_booster, $dhl_booster, $parvo_booster, $tricat_booster, $dewormed, $avatar_photo, $adoptee_photo)
    {
        $org_id = $_SESSION['org_id'];

 /*        if ($type == 'other') {
            $type = $other;
        } */
        $type = ($type == 'other')? $other: $type;
        $color = json_encode($color);

        $query = " INSERT INTO `animal` (name, type, gender, color, dob, photo) VALUES ('$name', '$type', '$gender', '$color', '$dob', '$avatar_photo')";
        echo ($query);
        BaseModel::insert($query);
        $animal_ID = BaseModel::lastInsertId();

        $query = "INSERT INTO `animal_vaccines` (animal_id, anti_rabies, dhl, parvo, tricat, anti_rabies_booster, dhl_booster, parvo_booster, tricat_booster)
                  VALUES ('$animal_ID', '$anti_rabies', '$dhl', '$parvo', '$tricat', '$anti_rabies_booster', '$dhl_booster', '$parvo_booster', '$tricat_booster')";
        echo ($query);
        BaseModel::insert($query);

        $query = "INSERT INTO `animal_for_adoption` (animal_id, org_id, description, date_listed, dewormed, photos)
                  VALUES ('$animal_ID', '$org_id', '$description', curdate(), '$dewormed', '$adoptee_photo')";
        return BaseModel::insert($query);
    }

    static function findAnimalsByOrgId()
    {
        $org_id = $_SESSION['org_id'];
        $query = "SELECT animal.animal_id, name,type, other, FLOOR(DATEDIFF(CURRENT_DATE, animal.dob) / 365) 'age', gender,date_listed,status,date_adopted,description, animal.photo as avatar_photo from animal_for_adoption,animal where org_id= $org_id and animal.animal_id=animal_for_adoption.animal_id";
        return BaseModel::select($query);
    }


    static function editAnimalData($status, $name, $type, $gender, $dob, $description, $photo)
    {

        /*         $query = "INSERT INTO `animal_for_adoption` (photo)
        VALUES ('$photo')";
        echo($query);
        BaseModel::insert($query); */

        $query = "UPDATE `animal_for_adoption` SET status = '$status' WHERE isset($status);
        UPDATE `animal` SET name = '$name' WHERE isset($name);
        UPDATE `animal` SET type = $type WHERE isset($type);
        UPDATE `animal` SET gender = '$gender' WHERE isset($gender);
        UPDATE `animal` SET dob = '$dob' WHERE isset($dob);
        UPDATE `animal_for_adoption` SET description = '$description' WHERE isset($description)";

        return BaseModel::insert($query);
    }

    static function findRequestsByOrgId($org_id)
    {
        $query = "SELECT 
        animal.name as animal_name, 
        animal.type, 
        user.name as user_name,
        user.address as address,
        user.email as email,
        user.telephone as contact,
        request_date,
        status,
        has_pets,
        petsafety,
        children,
        childsafety,
        animal.animal_id,
        animal.photo,
        request_date
        from adoption_request
        INNER JOIN animal ON
            animal.animal_id = adoption_request.animal_id
        INNER JOIN user ON
            user.user_id = adoption_request.user_id
        WHERE org_id = '$_SESSION[org_id]'";
        return BaseModel::select($query);
    }

    static function accept_adoption_request($animal_id)
    {
        $query = "UPDATE `adoption_request` SET status = 'ADOPTED' WHERE animal_id='$animal_id';
        UPDATE `animal_for_adoption` SET date_adopted = curdate() WHERE animal_id='$animal_id'";

        return BaseModel::insert($query);
    }

    static function reject_adoption_request($animal_id)
    {
        $query = "UPDATE `adoption_request` SET status = 'REJECTED' WHERE animal_id='$animal_id'";

        return BaseModel::insert($query);
    }

    static function findReportedCases()
    {
        $query = "SELECT type, description, contact_number,location, st_y(location_coordinates) as longi, st_x(location_coordinates) as lat, status, photos, time_reported from report_rescue";
        return BaseModel::select($query);
    }

    static function rescue_animal($report_id, $type)
    {
        $org_id = $_SESSION['org_id'];

        $query = " INSERT INTO `animal` (type) VALUES ('$type')";
        echo ($query);
        BaseModel::insert($query);
        $animal_ID = BaseModel::lastInsertId();

        $query = "INSERT INTO `rescued_animal` (animal_id, report_id, org_id, rescued_date)
        VALUES ('$animal_ID', '$report_id', '$org_id', curdate())";
        echo ($query);
        BaseModel::insert($query);

        $query = "UPDATE `report_rescue` SET org_id = '$org_id' status = 'RESCUED' WHERE report_id='$report_id'";
        echo ($query);
        return BaseModel::insert($query);
    }

    static function findRescuedAnimalsByOrgId()
    {
        $query = "SELECT * from report_rescue";
        return BaseModel::select($query);
    }

    static function add_rescue_update($report_id, $description, $photos)
    {
        $report_id = $_SESSION[$report_id];

        $query = "UPDATE `report_rescue` SET description = '$description' WHERE report_id='$report_id';
        UPDATE `report_rescue` SET photos = '$photos' WHERE report_id='$report_id'";
        return BaseModel::insert($query);
        
    }

    static function add_new_event($org_id, $heading, $description, $photos)
    {
        $query = "INSERT INTO `org_content` (org_id, created_time, heading, description, photos)
        VALUES ('$org_id', CURRENT_TIMESTAMP, '$heading', '$description', '$photos')";

        return BaseModel::insert($query);
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
