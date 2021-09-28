<?php

class OrgManagement extends BaseModel
{
    static function createNewAnimal($org_id, $name, $type, $other, $gender, $dob, $color, $description, $avatar_photo, $adoptee_photo)
    {
        $query = " INSERT INTO `animal` (name, type, gender, dob, color, photo) VALUES ('$name', '$type', '$gender', '$dob', '$color', '$avatar_photo')";
        echo($query);
        BaseModel::insert($query);
        $animal_ID = BaseModel::lastInsertId();

        $query = "INSERT INTO `animal_for_adoption` (animal_id, org_id, description, photos)
                  VALUES ('$animal_ID', '$org_id', '$description', '$adoptee_photo')";
        return BaseModel::insert($query);

        if ($type == 'other') {
            $type = $other;
        }
        return $type;
    }

    static function findAnimalsByOrgId()
    {
        $org_id=$_SESSION['org_id'];
        $query = "SELECT animal.animal_id, name,type,dob,gender,date_listed,status,date_adopted,description from animal_for_adoption,animal where org_id= $org_id and animal.animal_id=animal_for_adoption.animal_id";
        return BaseModel::select($query);
    }

    
    static function editAnimalData($status, $name, $type, $gender, $dob, $color, $description, $photo)
    {
        
        $query = "INSERT INTO `animal_for_adoption` (photo)
        VALUES ('$photo')";
        echo($query);
        BaseModel::insert($query);

        $query = "UPDATE `animal_for_adoption` SET status = '$status' WHERE isset($status);
        UPDATE `animal` SET name = '$name' WHERE isset($name);
        UPDATE `animal` SET type = $type WHERE isset($type);
        UPDATE `animal` SET gender = '$gender' WHERE isset($gender);
        UPDATE `animal` SET dob = '$dob' WHERE isset($dob);
        UPDATE `animal` SET color = '$color' WHERE isset($color);
        UPDATE `animal_for_adoption` SET description = '$description' WHERE isset($description)";

        return BaseModel::insert($query);
    }

    static function findRequestsByOrgId($org_id)
    {
        $query = "SELECT 
        animal.name as animal_name, 
        animal.type, 
        user.name,
        request_date,
        status,
        has_pets,
        petsafety,
        children,
        childsafety,
        animal.animal_id

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
        $query = "UPDATE `adoption_request` SET status = 'ADOPTED', status ='ADOPTED' WHERE animal_id='$animal_id';
        UPDATE `animal_for_adoption` SET date_adopted = curdate() WHERE animal_id='$animal_id'";

        return BaseModel::insert($query);
    }

    static function reject_adoption_request($animal_id)
    {
        $query = "UPDATE `adoption_request` SET status = 'REJECTED' WHERE animal_id='$animal_id'";

        return BaseModel::insert($query);
    }
    
    static function findReportedCases(){
        $query = "SELECT type, description, contact_number,location, status, photo, time_reported,org_response from report_rescue";
        return BaseModel::select($query);
    }

    static function findRescuedAnimalsByOrgId(){
        $query = "SELECT * from report_rescue";
        return BaseModel::select($query);
    }

    static function updateRescueReportStatus($report_id)
    {
        $query = "UPDATE `report_rescue` SET status='ACCEPTED' WHERE report_id=$report_id;
        UPDATE `report_rescue` SET org_response='ACCEPTED' WHERE report_id=$report_id;
        UPDATE `report_rescue` SET org_id = $_SESSION('org_id') WHERE report_id=$report_id";
        return BaseModel::update($query);
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
